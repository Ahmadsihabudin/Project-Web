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
        // Rate limiting: max 5 attempts per minute per IP
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

        // Support both email and username login
        $user = User::where('email', $request->email)
            ->orWhere('name', $request->email)
            ->first();

        if (!$user || !SecurityHelper::verifyPasswordFlexible($request->password, $user->password)) {
            RateLimiter::hit($key, 60);

            // Update login attempts
            $user?->increment('login_attempts');
            if ($user && $user->login_attempts >= 5) {
                $user->update([
                    'locked_until' => Carbon::now()->addMinutes(SecurityHelper::getLockDuration($user->login_attempts))
                ]);
            }

            // Log failed attempt
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

        // Check if account is locked
        if (SecurityHelper::isAccountLocked($user->login_attempts, $user->locked_until)) {
            return response()->json([
                'success' => false,
                'message' => 'Akun terkunci karena terlalu banyak percobaan login.'
            ], 423);
        }

        // Reset login attempts on successful login
        $user->update([
            'login_attempts' => 0,
            'locked_until' => null,
            'last_login_at' => Carbon::now()
        ]);

        // Clear rate limiter
        RateLimiter::clear($key);

        // Log successful login
        ActivityLog::create([
            'user_type' => 'admin',
            'user_id' => $user->id,
            'action' => 'login_success',
            'description' => 'Successful admin login',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
        ]);

        // Generate session token
        $sessionToken = SecurityHelper::generateSessionToken();
        $user->update(['remember_token' => $sessionToken]);

        // Store in session
        session([
            'user_id' => $user->id,
            'user_type' => $user->role, // Use actual role from database
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
        // Rate limiting: max 3 attempts per minute per IP
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

        $peserta = Peserta::where('kode_peserta', $request->kode_peserta)->first();

        if (!$peserta || !SecurityHelper::verifyPasswordFlexible($request->kode_akses, $peserta->kode_akses)) {
            RateLimiter::hit($key, 60);

            // Update login attempts
            $peserta?->increment('login_attempts');
            if ($peserta && $peserta->login_attempts >= 5) {
                $peserta->update([
                    'locked_until' => Carbon::now()->addMinutes(SecurityHelper::getLockDuration($peserta->login_attempts))
                ]);
            }

            // Log failed attempt
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
                'message' => 'Kode peserta atau password salah.'
            ], 401);
        }

        // Check if account is locked
        if (SecurityHelper::isAccountLocked($peserta->login_attempts, $peserta->locked_until)) {
            return response()->json([
                'success' => false,
                'message' => 'Akun terkunci karena terlalu banyak percobaan login.'
            ], 423);
        }

        // Reset login attempts on successful login
        $peserta->update([
            'login_attempts' => 0,
            'locked_until' => null,
            'last_login_at' => Carbon::now()
        ]);

        // Clear rate limiter
        RateLimiter::clear($key);

        // Log successful login
        ActivityLog::create([
            'user_type' => 'peserta',
            'user_id' => $peserta->id_peserta,
            'action' => 'login_success',
            'description' => 'Successful peserta login',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
        ]);

        // Generate session token
        $sessionToken = SecurityHelper::generateSessionToken();
        $peserta->update(['remember_token' => $sessionToken]);

        // Store in session
        session([
            'user_id' => $peserta->id_peserta,
            'user_type' => 'peserta',
            'user_name' => $peserta->nama_peserta,
            'user_code' => $peserta->kode_peserta,
            'session_token' => $sessionToken
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'peserta' => $peserta,
            'session_token' => $sessionToken
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $userType = session('user_type', $request->input('user_type', 'unknown'));
        $userId = session('user_id', $request->input('user_id', 0));

        // Log logout only if we have valid user data
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

        // Clear session
        session()->flush();

        // Check if request expects JSON (AJAX)
        if ($request->expectsJson() || $request->header('Content-Type') === 'application/json') {
            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil'
            ]);
        }

        // For form submissions, redirect to login page
        $redirectTo = $request->input('redirect_to', '/');
        return redirect($redirectTo)->with('success', 'Logout berhasil');
    }
}
