<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\User;
use App\Models\ActivityLog;
use App\Helpers\SecurityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SecureAuthController extends Controller
{
    /**
     * Login untuk Admin
     */
    public function adminLogin(Request $request)
    {
        $key = 'admin_login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            ], 429);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            RateLimiter::hit($key, 60);
            return response()->json([
                'success' => false,
                'message' => 'Username dan password harus diisi dengan benar.'
            ], 400);
        }
        $user = User::where('email', $request->email)
            ->orWhere('name', $request->email)
            ->first();

        if (!$user || !SecurityHelper::verifyPasswordFlexible($request->password, $user->password)) {
            RateLimiter::hit($key, 60);
            $user?->increment('login_attempts');
            if ($user && $user->login_attempts >= 5) {
                $user->update([
                    'locked_until' => Carbon::now()->addMinutes(SecurityHelper::getLockDuration($user->login_attempts))
                ]);
            }
            ActivityLog::create([
                'user_type' => 'admin',
                'user_id' => $user?->id ?? 0,
                'action' => 'login_failed',
                'description' => 'Failed login attempt',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.'
            ], 401);
        }
        if (SecurityHelper::isAccountLocked($user->login_attempts, $user->locked_until)) {
            return response()->json([
                'success' => false,
                'message' => 'Akun terkunci karena terlalu banyak percobaan login.'
            ], 423);
        }
        if ($user->is_logged_in && $user->current_session_id && $user->current_session_id !== session()->getId()) {
            $isStale = $user->last_activity_at && Carbon::parse($user->last_activity_at)->lt(Carbon::now()->subMinutes(10));

            if ($isStale || $request->boolean('force_login')) {
                \Log::warning('Overriding previous admin session due to stale or forced login', [
                    'user_id' => $user->id,
                    'current_session_id' => $user->current_session_id,
                    'new_session_id' => session()->getId(),
                    'is_stale' => $isStale,
                    'force_login' => $request->boolean('force_login')
                ]);
            } else {
                \Log::info('Login attempt blocked - user already logged in', [
                    'user_id' => $user->id,
                    'current_session_id' => $user->current_session_id,
                    'new_session_id' => session()->getId()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Akun sedang digunakan di browser lain. Silakan logout terlebih dahulu atau tunggu beberapa saat.'
                ], 409);
            }
        }
        $user->update([
            'login_attempts' => 0,
            'locked_until' => null,
            'last_login_at' => Carbon::now(),
            'current_session_id' => session()->getId(),
            'is_logged_in' => true,
            'last_activity_at' => Carbon::now()
        ]);
        RateLimiter::clear($key);
        ActivityLog::create([
            'user_type' => 'admin',
            'user_id' => $user->id,
            'action' => 'login_success',
            'description' => 'Successful admin login',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
        ]);
        $sessionToken = SecurityHelper::generateSessionToken();
        $user->update(['remember_token' => $sessionToken]);
        session([
            'user_id' => $user->id,
            'user_type' => $user->role,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'session_token' => $sessionToken
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => $user,
            'session_token' => $sessionToken
        ]);
    }

    /**
     * Login untuk Peserta
     */
    public function pesertaLogin(Request $request)
    {
        $key = 'peserta_login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            ], 429);
        }

        $validator = Validator::make($request->all(), [
            'kode_peserta' => 'required|string',
            'kode_akses' => 'required|string'
        ]);

        if ($validator->fails()) {
            RateLimiter::hit($key, 60);
            return response()->json([
                'success' => false,
                'message' => 'Kode peserta dan kode akses harus diisi.'
            ], 400);
        }

        $inputKodePeserta = trim((string) $request->kode_peserta);
        $inputAccess = trim((string) $request->kode_akses);

        $normalizedKode = strtolower(str_replace(' ', '', $inputKodePeserta));
        $peserta = Peserta::whereRaw("REPLACE(LOWER(kode_peserta), ' ', '') = ?", [$normalizedKode])->first();
        $isValidAccess = false;
        if ($peserta) {
            if (!is_null($peserta->kode_akses) && $peserta->kode_akses !== '' && $peserta->kode_akses === $inputAccess) {
                $isValidAccess = true;
            }
            elseif (!is_null($peserta->kode_akses) && $peserta->kode_akses !== '' && SecurityHelper::verifyPasswordFlexible($inputAccess, (string) $peserta->kode_akses)) {
                $isValidAccess = true;
            }
            elseif (!is_null($peserta->password_hash) && $peserta->password_hash !== '' && SecurityHelper::verifyPasswordFlexible($inputAccess, (string) $peserta->password_hash)) {
                $isValidAccess = true;
            }

            \Log::info('Peserta login debug', [
                'kode_peserta' => $inputKodePeserta,
                'input_akses_len' => strlen($inputAccess),
                'db_kode_akses' => $peserta->kode_akses,
                'db_kode_akses_len' => strlen($peserta->kode_akses ?? ''),
                'plain_match' => ($peserta->kode_akses === $inputAccess),
                'is_valid' => $isValidAccess,
            ]);
        } else {
            \Log::warning('Peserta not found', ['kode_peserta' => $inputKodePeserta]);
        }

        if (!$peserta || !$isValidAccess) {
            RateLimiter::hit($key, 60);
            $peserta?->increment('login_attempts');
            if ($peserta && $peserta->login_attempts >= 5) {
                $peserta->update([
                    'locked_until' => Carbon::now()->addMinutes(SecurityHelper::getLockDuration($peserta->login_attempts))
                ]);
            }
            ActivityLog::create([
                'user_type' => 'peserta',
                'user_id' => $peserta?->id_peserta ?? 0,
                'action' => 'login_failed',
                'description' => 'Failed peserta login attempt',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
            ]);

            return response()->json([
                'success' => false,
                'error' => 'INVALID_CREDENTIALS',
                'message' => 'Kode peserta atau kode akses salah.'
            ], 401);
        }
        if (SecurityHelper::isAccountLocked($peserta->login_attempts, $peserta->locked_until)) {
            return response()->json([
                'success' => false,
                'message' => 'Akun terkunci karena terlalu banyak percobaan login.'
            ], 423);
        }
        if ($peserta->is_logged_in && $peserta->current_session_id && $peserta->current_session_id !== session()->getId()) {
            $isStale = $peserta->last_activity_at && Carbon::parse($peserta->last_activity_at)->lt(Carbon::now()->subMinutes(10));

            if ($isStale || $request->boolean('force_login')) {
                \Log::warning('Overriding previous peserta session due to stale or forced login', [
                    'peserta_id' => $peserta->id_peserta,
                    'current_session_id' => $peserta->current_session_id,
                    'new_session_id' => session()->getId(),
                    'is_stale' => $isStale,
                    'force_login' => $request->boolean('force_login')
                ]);
            } else {
                \Log::info('Login attempt blocked - peserta already logged in', [
                    'peserta_id' => $peserta->id_peserta,
                    'current_session_id' => $peserta->current_session_id,
                    'new_session_id' => session()->getId()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Akun sedang digunakan di browser lain. Silakan logout terlebih dahulu atau tunggu beberapa saat.'
                ], 409);
            }
        }
      
        $batchPeserta = $peserta->batch;
        if (!$batchPeserta || trim($batchPeserta) === '') {
            
            session([
                'peserta_wrong_data' => [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama,
                    'kode_peserta' => $peserta->kode_peserta,
                    'batch' => 'Tidak ada batch',
                    'email' => $peserta->email
                ]
            ]);

            return response()->json([
                'success' => false,
                'wrong_batch' => true,
                'error' => 'NO_ACTIVE_SESSION',
                'redirect' => '/student/peserta-wrong',
                'message' => 'Anda belum terdaftar dalam batch manapun.',
                'peserta' => [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama,
                    'kode_peserta' => $peserta->kode_peserta,
                    'batch' => 'Tidak ada batch',
                    'email' => $peserta->email
                ]
            ]);
        }
        $batch = \App\Models\Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower(trim($batchPeserta))])->first();
        if (!$batch) {
         
            session([
                'peserta_wrong_data' => [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama,
                    'kode_peserta' => $peserta->kode_peserta,
                    'batch' => $peserta->batch,
                    'email' => $peserta->email
                ]
            ]);

            return response()->json([
                'success' => false,
                'wrong_batch' => true,
                'error' => 'NO_ACTIVE_SESSION',
                'redirect' => '/student/peserta-wrong',
                'message' => 'Batch tidak ditemukan. Mohon kontak admin.',
                'peserta' => [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama,
                    'kode_peserta' => $peserta->kode_peserta,
                    'batch' => $peserta->batch,
                    'email' => $peserta->email
                ]
            ]);
        }
        $now = now();
        $currentDate = $now->toDateString();

     
        $sesiUjianAktif = \App\Models\SesiUjian::where('id_batch', $batch->id_batch)
            ->where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $currentDate)
            ->where('tanggal_selesai', '>=', $currentDate)
            ->exists();

        \Log::info('Login check for batch', [
            'batch_name' => $batch->nama_batch,
            'batch_id' => $batch->id_batch,
            'current_date' => $currentDate,
            'has_active_session' => $sesiUjianAktif
        ]);

        if (!$sesiUjianAktif) {
         
            session([
                'peserta_wrong_data' => [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama,
                    'kode_peserta' => $peserta->kode_peserta,
                    'batch' => $peserta->batch,
                    'email' => $peserta->email
                ]
            ]);

            return response()->json([
                'success' => false,
                'wrong_batch' => true,
                'error' => 'NO_ACTIVE_SESSION',
                'redirect' => '/student/peserta-wrong',
                'message' => 'Tidak ada sesi ujian aktif untuk batch Anda saat ini.',
                'peserta' => [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama,
                    'kode_peserta' => $peserta->kode_peserta,
                    'batch' => $peserta->batch,
                    'email' => $peserta->email
                ]
            ]);
        }
        $peserta->update([
            'login_attempts' => 0,
            'locked_until' => null,
            'last_login_at' => Carbon::now(),
            'current_session_id' => session()->getId(),
            'is_logged_in' => true,
            'last_activity_at' => Carbon::now()
        ]);
        RateLimiter::clear($key);
        ActivityLog::create([
            'user_type' => 'peserta',
            'user_id' => $peserta->id_peserta,
            'action' => 'login_success',
            'description' => 'Successful peserta login',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
        ]);
        $sessionToken = SecurityHelper::generateSessionToken();
        $peserta->update(['remember_token' => $sessionToken]);
        session([
            'user_id' => $peserta->id_peserta,
            'user_type' => 'peserta',
            'user_name' => $peserta->nama_peserta,
            'user_code' => $peserta->kode_peserta,
            'session_token' => $sessionToken
        ]);

       
        $hasCompletedExam = \App\Models\Laporan::where('id_peserta', $peserta->id_peserta)->exists();

        \Log::info('Peserta login - checking exam completion status:', [
            'peserta_id' => $peserta->id_peserta,
            'has_completed_exam' => $hasCompletedExam
        ]);

        $redirectUrl = $hasCompletedExam ? '/student/selesai' : '/student/information';

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'redirect' => $redirectUrl,
            'peserta' => $peserta,
            'session_token' => $sessionToken,
            'has_completed_exam' => $hasCompletedExam
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $userType = session('user_type', $request->input('user_type', 'unknown'));
        $userId = session('user_id', $request->input('user_id', 0));
        if ($userType === 'admin' || $userType === 'staff' || $userType === 'supervisor') {
            User::where('id', $userId)->update([
                'is_logged_in' => false,
                'current_session_id' => null,
                'last_activity_at' => Carbon::now()
            ]);
        } elseif ($userType === 'peserta') {
            Peserta::where('id_peserta', $userId)->update([
                'is_logged_in' => false,
                'current_session_id' => null,
                'last_activity_at' => Carbon::now()
            ]);
        }
        if ($userType && $userType !== 'unknown' && $userId && $userId > 0) {
            ActivityLog::create([
                'user_type' => $userType,
                'user_id' => $userId,
                'action' => 'logout',
                'description' => 'User logout',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
            ]);
        }
        session()->flush();
        if ($request->expectsJson() || $request->header('Content-Type') === 'application/json') {
            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil'
            ]);
        }
        $redirectTo = $request->input('redirect_to', '/');
        return redirect($redirectTo)->with('success', 'Logout berhasil');
    }
}
