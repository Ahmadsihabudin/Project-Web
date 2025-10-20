<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SesiUjian;
use App\Models\Peserta;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Menampilkan daftar ujian untuk peserta berdasarkan batch mereka
     */
    public function index()
    {
        try {
            // Cek apakah user sudah login via session
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                \Log::error('User not authenticated via session');
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            \Log::info('User authenticated via session:', ['user_id' => $userId, 'user_type' => $userType]);

            // Jika user_type adalah 'peserta', langsung ambil dari tabel peserta
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
                if (!$peserta) {
                    \Log::error('Peserta not found in database:', ['peserta_id' => $userId]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Data peserta tidak ditemukan'
                    ], 404);
                }
            } else {
                // Untuk admin, ambil data user dari database
                $user = \App\Models\User::find($userId);
                if (!$user) {
                    \Log::error('User not found in database:', ['user_id' => $userId]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Data user tidak ditemukan'
                    ], 404);
                }

                // Ambil data peserta yang sedang login
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                \Log::error('Peserta not found for email:', ['email' => $user->email]);
                return response()->json([
                    'success' => false,
                    'message' => 'Data peserta tidak ditemukan'
                ], 404);
            }

            // Ambil batch peserta
            $batchPeserta = $peserta->batch;

            if (!$batchPeserta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Peserta belum memiliki batch'
                ], 404);
            }

            // Cari batch ID berdasarkan nama batch
            $batch = \App\Models\Batch::where('nama_batch', $batchPeserta)->first();
            if (!$batch) {
                \Log::error('Batch not found:', ['batch_name' => $batchPeserta]);
                return response()->json([
                    'success' => false,
                    'message' => 'Batch tidak ditemukan'
                ], 404);
            }

            \Log::info('Found batch:', ['batch_id' => $batch->id_batch, 'batch_name' => $batch->nama_batch]);

            // Ambil sesi ujian berdasarkan batch peserta
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])
                ->where('id_batch', $batch->id_batch)
                ->where('status', 'aktif')
                ->select('id_sesi', 'id_ujian', 'id_batch', 'mata_pelajaran', 'deskripsi', 'tanggal_mulai', 'jam_mulai', 'jam_selesai', 'tanggal_selesai', 'durasi_menit', 'status', 'created_at', 'updated_at')
                ->orderBy('tanggal_mulai', 'desc')
                ->orderBy('jam_mulai', 'desc')
                ->get();

            \Log::info('Found sesi ujian:', ['count' => $sesiUjian->count()]);

            // Transform data untuk frontend
            $transformedSesiUjian = $sesiUjian->map(function ($sesiUjianItem) {
                // Format waktu untuk display
                $waktuMulai = null;
                $waktuSelesai = null;

                // Format tanggal dan jam dengan benar
                if ($sesiUjianItem->tanggal_mulai && $sesiUjianItem->jam_mulai) {
                    $tanggalMulaiFormatted = date('Y-m-d', strtotime($sesiUjianItem->tanggal_mulai));
                    $jamMulaiFormatted = date('H:i:s', strtotime($sesiUjianItem->jam_mulai));
                    $waktuMulai = $tanggalMulaiFormatted . ' ' . $jamMulaiFormatted;
                } else if ($sesiUjianItem->tanggal_mulai) {
                    $waktuMulai = date('Y-m-d', strtotime($sesiUjianItem->tanggal_mulai));
                }

                if ($sesiUjianItem->tanggal_selesai && $sesiUjianItem->jam_selesai) {
                    $tanggalSelesaiFormatted = date('Y-m-d', strtotime($sesiUjianItem->tanggal_selesai));
                    $jamSelesaiFormatted = date('H:i:s', strtotime($sesiUjianItem->jam_selesai));
                    $waktuSelesai = $tanggalSelesaiFormatted . ' ' . $jamSelesaiFormatted;
                } else if ($sesiUjianItem->tanggal_selesai) {
                    $waktuSelesai = date('Y-m-d', strtotime($sesiUjianItem->tanggal_selesai));
                }

                // Cek status ujian berdasarkan waktu
                $now = now();
                $tanggalMulai = $sesiUjianItem->tanggal_mulai . ' ' . $sesiUjianItem->jam_mulai;
                $tanggalSelesai = $sesiUjianItem->tanggal_selesai . ' ' . $sesiUjianItem->jam_selesai;

                $statusUjian = 'belum_dimulai';
                if ($now >= $tanggalMulai && $now <= $tanggalSelesai) {
                    $statusUjian = 'sedang_berlangsung';
                } else if ($now > $tanggalSelesai) {
                    $statusUjian = 'selesai';
                }

                return [
                    'id' => $sesiUjianItem->id_sesi,
                    'nama_ujian' => $sesiUjianItem->ujian ? $sesiUjianItem->ujian->nama_ujian : 'Ujian ' . $sesiUjianItem->mata_pelajaran,
                    'mata_pelajaran' => $sesiUjianItem->mata_pelajaran,
                    'deskripsi' => $sesiUjianItem->deskripsi ?? '',
                    'tanggal_mulai' => $sesiUjianItem->tanggal_mulai ? date('Y-m-d', strtotime($sesiUjianItem->tanggal_mulai)) : null,
                    'tanggal_selesai' => $sesiUjianItem->tanggal_selesai ? date('Y-m-d', strtotime($sesiUjianItem->tanggal_selesai)) : null,
                    'jam_mulai' => $sesiUjianItem->jam_mulai ? date('H:i:s', strtotime($sesiUjianItem->jam_mulai)) : null,
                    'jam_selesai' => $sesiUjianItem->jam_selesai ? date('H:i:s', strtotime($sesiUjianItem->jam_selesai)) : null,
                    'waktu_mulai' => $waktuMulai,
                    'waktu_selesai' => $waktuSelesai,
                    'durasi_menit' => $sesiUjianItem->durasi_menit,
                    'status' => $sesiUjianItem->status,
                    'status_ujian' => $statusUjian,
                    'id_batch' => $sesiUjianItem->id_batch,
                    'created_at' => $sesiUjianItem->created_at,
                    'updated_at' => $sesiUjianItem->updated_at
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $transformedSesiUjian,
                'peserta' => [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                    'email' => $peserta->email,
                    'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                    'batch' => $batchPeserta
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error loading student exams: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat data ujian'
            ], 500);
        }
    }

    /**
     * Menampilkan halaman informasi siswa
     */
    public function information()
    {
        return view('students.information');
    }

    /**
     * Menampilkan halaman informasi ujian
     */
    public function showExamInfo($id)
    {
        try {
            // Cek apakah user sudah login via session
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }

            // Ambil data peserta
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return redirect('/student/dashboard')->with('error', 'Data peserta tidak ditemukan');
            }

            // Ambil sesi ujian
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/dashboard')->with('error', 'Ujian tidak ditemukan');
            }

            // Cek apakah ujian untuk batch peserta
            $batch = \App\Models\Batch::where('nama_batch', $peserta->batch)->first();
            if (!$batch || $sesiUjian->id_batch != $batch->id_batch) {
                return redirect('/student/dashboard')->with('error', 'Anda tidak memiliki akses ke ujian ini');
            }

            return view('students.exam-info', compact('sesiUjian', 'peserta'));
        } catch (\Exception $e) {
            \Log::error('Error showing exam info: ' . $e->getMessage());
            return redirect('/student/dashboard')->with('error', 'Terjadi kesalahan saat memuat informasi ujian');
        }
    }

    /**
     * Menampilkan halaman peringatan ujian
     */
    public function showExamWarning($id)
    {
        try {
            // Cek apakah user sudah login via session
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }

            // Ambil data peserta
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return redirect('/student/dashboard')->with('error', 'Data peserta tidak ditemukan');
            }

            // Ambil sesi ujian
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/dashboard')->with('error', 'Ujian tidak ditemukan');
            }

            // Cek apakah ujian untuk batch peserta
            $batch = \App\Models\Batch::where('nama_batch', $peserta->batch)->first();
            if (!$batch || $sesiUjian->id_batch != $batch->id_batch) {
                return redirect('/student/dashboard')->with('error', 'Anda tidak memiliki akses ke ujian ini');
            }

            // Ambil soal untuk menampilkan jumlah soal
            $soal = \App\Models\Soal::where('mata_pelajaran', $sesiUjian->mata_pelajaran)
                ->where('status', 'aktif')
                ->get();

            return view('students.exam-warning', compact('sesiUjian', 'peserta', 'soal'));
        } catch (\Exception $e) {
            \Log::error('Error showing exam warning: ' . $e->getMessage());
            return redirect('/student/dashboard')->with('error', 'Terjadi kesalahan saat memuat peringatan ujian');
        }
    }

    /**
     * Menampilkan halaman ujian
     */
    public function showExam($id)
    {
        try {
            // Cek apakah user sudah login via session
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }

            // Ambil data peserta
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return redirect('/student/dashboard')->with('error', 'Data peserta tidak ditemukan');
            }

            // Ambil sesi ujian
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/dashboard')->with('error', 'Ujian tidak ditemukan');
            }

            // Cek apakah ujian untuk batch peserta
            $batch = \App\Models\Batch::where('nama_batch', $peserta->batch)->first();
            if (!$batch || $sesiUjian->id_batch != $batch->id_batch) {
                return redirect('/student/dashboard')->with('error', 'Anda tidak memiliki akses ke ujian ini');
            }

            // Cek status ujian
            $now = now();
            $tanggalMulai = $sesiUjian->tanggal_mulai . ' ' . $sesiUjian->jam_mulai;
            $tanggalSelesai = $sesiUjian->tanggal_selesai . ' ' . $sesiUjian->jam_selesai;

            if ($now < $tanggalMulai) {
                return redirect('/student/dashboard')->with('error', 'Ujian belum dimulai');
            }

            if ($now > $tanggalSelesai) {
                return redirect('/student/dashboard')->with('error', 'Ujian sudah selesai');
            }

            // Ambil soal berdasarkan mata pelajaran
            $soal = \App\Models\Soal::where('mata_pelajaran', $sesiUjian->mata_pelajaran)
                ->where('status', 'aktif')
                ->inRandomOrder()
                ->get();

            if ($soal->isEmpty()) {
                return redirect('/student/dashboard')->with('error', 'Tidak ada soal tersedia untuk mata pelajaran ini');
            }

            return view('students.exam', compact('sesiUjian', 'soal', 'peserta'));
        } catch (\Exception $e) {
            \Log::error('Error showing exam: ' . $e->getMessage());
            return redirect('/student/dashboard')->with('error', 'Terjadi kesalahan saat memuat ujian');
        }
    }

    /**
     * Submit jawaban ujian
     */
    public function submitExam(Request $request, $id)
    {
        try {
            // Cek apakah user sudah login via session
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            // Ambil data peserta
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data peserta tidak ditemukan'
                ], 404);
            }

            // Ambil sesi ujian
            $sesiUjian = SesiUjian::find($id);
            if (!$sesiUjian) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ujian tidak ditemukan'
                ], 404);
            }

            // Validasi jawaban
            $validator = \Validator::make($request->all(), [
                'jawaban' => 'required|array',
                'jawaban.*' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jawaban tidak valid',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Simpan jawaban (implementasi sesuai kebutuhan)
            // TODO: Implementasi penyimpanan jawaban ke database

            return response()->json([
                'success' => true,
                'message' => 'Jawaban berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error submitting exam: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan jawaban'
            ], 500);
        }
    }
}
