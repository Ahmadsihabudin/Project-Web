<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SesiUjian;
use App\Models\Peserta;
use App\Models\Batch;
use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\Laporan;
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
                    'batch' => $batchPeserta,
                    'asal_smk' => $peserta->asal_smk ?? 'N/A',
                    'jurusan' => $peserta->jurusan ?? 'N/A'
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
        $initialPeserta = null;
        try {
            $userId = session('user_id');
            $userType = session('user_type');
            if ($userId && $userType === 'peserta') {
                $peserta = \App\Models\Peserta::find($userId);
                if ($peserta) {
                    // Check if peserta has already completed exam in the current batch
                    $hasCompletedExamInCurrentBatch = \App\Models\Laporan::where('id_peserta', $peserta->id_peserta)
                        ->where('batch_saat_ujian', $peserta->batch)
                        ->exists();
                    if ($hasCompletedExamInCurrentBatch) {
                        return redirect()->route('student.selesai')->with('info', 'Anda sudah menyelesaikan ujian di batch ini');
                    }
                    
                    $initialPeserta = [
                        'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                        'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                        'batch' => $peserta->batch ?? 'N/A',
                        'email' => $peserta->email ?? 'N/A',
                        'asal_smk' => $peserta->asal_smk ?? 'N/A',
                        'jurusan' => $peserta->jurusan ?? 'N/A',
                    ];

                    // Cek apakah ada sesi ujian untuk batch peserta
                    $batchPeserta = $peserta->batch;
                    if ($batchPeserta) {
                        // Cari batch ID berdasarkan nama batch
                        $batch = \App\Models\Batch::where('nama_batch', $batchPeserta)->first();
                        if ($batch) {
                            // Cek apakah ada sesi ujian aktif untuk batch ini (real-time check)
                            $now = now();
                            
                            // Debug log untuk melihat data
                            \Log::info('Checking exam sessions for batch:', [
                                'batch_id' => $batch->id_batch,
                                'batch_name' => $batchPeserta,
                                'current_time' => $now->format('Y-m-d H:i:s')
                            ]);
                            
                            // Query yang lebih sederhana untuk mengecek sesi ujian aktif
                            // Cek semua sesi ujian aktif untuk batch ini (tidak perlu cek waktu untuk sementara)
                            $sesiUjianCount = SesiUjian::where('id_batch', $batch->id_batch)
                                ->where('status', 'aktif')
                                ->count();
                                
                            // Debug: ambil detail sesi ujian
                            $sesiUjianDetails = SesiUjian::where('id_batch', $batch->id_batch)
                                ->where('status', 'aktif')
                                ->get(['id_sesi', 'tanggal_mulai', 'tanggal_selesai', 'jam_mulai', 'jam_selesai']);
                                
                            \Log::info('Sesi ujian details:', [
                                'details' => $sesiUjianDetails->toArray()
                            ]);
                            
                            \Log::info('Exam sessions found:', [
                                'count' => $sesiUjianCount,
                                'batch_id' => $batch->id_batch
                            ]);

                            // Log hasil pengecekan sesi ujian
                            if ($sesiUjianCount == 0) {
                                \Log::info('No active exam sessions found for batch:', [
                                    'batch_id' => $batch->id_batch,
                                    'batch_name' => $batchPeserta
                                ]);
                            } else {
                                \Log::info('Active exam sessions found:', [
                                    'count' => $sesiUjianCount,
                                    'batch_id' => $batch->id_batch
                                ]);
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            // ignore and render without initial data
        }

        return view('students.information', compact('initialPeserta'));
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

            // Check if peserta has already completed exam in the current batch
            $hasCompletedExamInCurrentBatch = \App\Models\Laporan::where('id_peserta', $peserta->id_peserta)
                ->where('batch_saat_ujian', $peserta->batch)
                ->exists();
            if ($hasCompletedExamInCurrentBatch) {
                return redirect()->route('student.selesai')->with('info', 'Anda sudah menyelesaikan ujian di batch ini');
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
            // Split mata pelajaran dan ambil soal dari semua mata pelajaran
            $mataPelajaranArray = explode(', ', $sesiUjian->mata_pelajaran);
            $soal = \App\Models\Soal::whereIn('mata_pelajaran', $mataPelajaranArray)
                ->get();

            return view('students.exam-warning', compact('sesiUjian', 'peserta', 'soal'));
        } catch (\Exception $e) {
            \Log::error('Error showing exam warning: ' . $e->getMessage());
            return redirect('/student/dashboard')->with('error', 'Terjadi kesalahan saat memuat peringatan ujian');
        }
    }

    /**
     * Memulai ujian (redirect ke halaman ujian)
     */
    public function startExam($id)
    {
        \Log::info('startExam method called:', ['exam_id' => $id]);
        
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

            // Check if peserta has already completed exam in the current batch
            $hasCompletedExamInCurrentBatch = Laporan::where('id_peserta', $peserta->id_peserta)
                ->where('batch_saat_ujian', $peserta->batch)
                ->exists();
            if ($hasCompletedExamInCurrentBatch) {
                return redirect()->route('student.selesai')->with('info', 'Anda sudah menyelesaikan ujian di batch ini');
            }

            // Ambil sesi ujian
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/dashboard')->with('error', 'Ujian tidak ditemukan');
            }

            // Pastikan relasi ujian ada, jika tidak buat dummy
            if (!$sesiUjian->ujian) {
                $sesiUjian->ujian = (object) [
                    'nama_ujian' => 'Ujian ' . $sesiUjian->mata_pelajaran
                ];
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

            \Log::info('Exam time check:', [
                'current_time' => $now->format('Y-m-d H:i:s'),
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'current_less_than_start' => $now < $tanggalMulai,
                'current_greater_than_end' => $now > $tanggalSelesai
            ]);

            if ($now < $tanggalMulai) {
                \Log::info('Redirecting to peserta-wrong: Ujian belum dimulai');
                return redirect('/student/peserta-wrong')->with('error', 'Ujian belum dimulai');
            }

            if ($now > $tanggalSelesai) {
                \Log::info('Redirecting to peserta-wrong: Ujian sudah selesai');
                return redirect('/student/peserta-wrong')->with('error', 'Ujian sudah selesai');
            }

            // Ambil soal berdasarkan mata pelajaran
            // Split mata pelajaran dan ambil soal dari semua mata pelajaran
            $mataPelajaranArray = explode(', ', $sesiUjian->mata_pelajaran);
            $soal = \App\Models\Soal::whereIn('mata_pelajaran', $mataPelajaranArray)
                ->inRandomOrder()
                ->get();

            \Log::info('Soal check:', [
                'mata_pelajaran_array' => $mataPelajaranArray,
                'soal_count' => $soal->count(),
                'soal_empty' => $soal->isEmpty()
            ]);

            if ($soal->isEmpty()) {
                \Log::info('Redirecting to peserta-wrong: Tidak ada soal tersedia');
                return redirect('/student/peserta-wrong')->with('error', 'Tidak ada soal tersedia untuk mata pelajaran ini');
            }

            return view('students.exam', compact('sesiUjian', 'soal', 'peserta'));
        } catch (\Exception $e) {
            \Log::error('Error starting exam: ' . $e->getMessage());
            return redirect('/student/peserta-wrong')->with('error', 'Terjadi kesalahan saat memulai ujian');
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
            // Split mata pelajaran dan ambil soal dari semua mata pelajaran
            $mataPelajaranArray = explode(', ', $sesiUjian->mata_pelajaran);
            $soal = \App\Models\Soal::whereIn('mata_pelajaran', $mataPelajaranArray)
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

            // Debug logging
            \Log::info('Exam submission request:', [
                'user_id' => $userId,
                'user_type' => $userType,
                'exam_id' => $id,
                'request_data' => $request->all(),
                'jawaban_data' => $request->jawaban ?? 'NOT_SET'
            ]);

            // Validasi jawaban
            $validator = \Validator::make($request->all(), [
                'jawaban' => 'required|array',
                'jawaban.*' => 'required|string'
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed:', [
                    'errors' => $validator->errors(),
                    'request_data' => $request->all()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Jawaban tidak valid',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Ambil soal untuk perhitungan skor
            $mataPelajaranArray = explode(', ', $sesiUjian->mata_pelajaran);
            $soal = \App\Models\Soal::whereIn('mata_pelajaran', $mataPelajaranArray)->get();
            
            // Hitung skor
            $totalQuestions = $soal->count();
            $correctAnswers = 0;
            $jawabanData = $request->jawaban;
            
            // Simpan jawaban individual dan hitung yang benar
            foreach ($soal as $soalItem) {
                $soalId = $soalItem->id_soal;
                $jawabanPeserta = $jawabanData[$soalId] ?? null;
                
                if ($jawabanPeserta) {
                    // Handle different question types
                    if ($soalItem->tipe_soal === 'pilihan_ganda') {
                        // Multiple choice - case insensitive match
                        $isCorrect = strtolower(trim($soalItem->jawaban_benar)) === strtolower(trim($jawabanPeserta));
                        $nilaiEssay = null;
                    } else {
                        // Essay - calculate score based on keyword similarity
                        $nilaiEssay = $this->calculateEssayScore($jawabanPeserta, $soalItem->jawaban_benar, $soalItem->poin);
                        $isCorrect = $nilaiEssay >= ($soalItem->poin * 0.8); // 80% threshold for "correct"
                    }
                    
                    if ($isCorrect) {
                        $correctAnswers++;
                    }
                    
                    // Simpan jawaban individual
                    \App\Models\Jawaban::create([
                        'id_peserta' => $peserta->id_peserta,
                        'id_soal' => $soalId,
                        'jawaban_dipilih' => $jawabanPeserta,
                        'status' => $isCorrect ? 'benar' : 'salah',
                        'nilai_essay' => $nilaiEssay
                    ]);
                }
            }
            
            // Hitung skor
            $totalScore = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
            
            // Hitung waktu pengerjaan (dalam menit) - gunakan waktu aktual dari frontend
            $waktuPengerjaan = $request->input('waktu_pengerjaan', $sesiUjian->durasi_menit);
            
            \Log::info('Waktu pengerjaan calculated:', [
                'waktu_pengerjaan_from_frontend' => $request->input('waktu_pengerjaan'),
                'durasi_sesi' => $sesiUjian->durasi_menit,
                'final_waktu_pengerjaan' => $waktuPengerjaan
            ]);
            
            // Simpan ke tabel laporan
            $laporan = \App\Models\Laporan::create([
                'id_peserta' => $peserta->id_peserta,
                'batch_saat_ujian' => $peserta->batch, // Simpan batch saat ujian dilakukan
                'total_score' => round($totalScore, 2),
                'jumlah_benar' => $correctAnswers,
                'jumlah_salah' => $totalQuestions - $correctAnswers,
                'waktu_pengerjaan' => $waktuPengerjaan,
                'status_submit' => 'manual'
            ]);
            
            \Log::info('Laporan created:', [
                'id_laporan' => $laporan->id_laporan,
                'id_peserta' => $peserta->id_peserta,
                'total_score' => $totalScore,
                'correct_answers' => $correctAnswers,
                'total_questions' => $totalQuestions
            ]);
            
            // Log aktivitas
            \App\Models\ActivityLog::create([
                'user_type' => 'peserta',
                'user_id' => $peserta->id_peserta,
                'action' => 'submit_exam',
                'description' => "Menyelesaikan ujian: {$sesiUjian->ujian->nama_ujian} (Skor: {$totalScore}%)",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'metadata' => \App\Helpers\SecurityHelper::getDeviceInfo($request->userAgent())
            ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Ujian berhasil diselesaikan',
                    'redirect_url' => route('student.selesai'),
                    'data' => [
                        'total_score' => round($totalScore, 2),
                        'correct_answers' => $correctAnswers,
                        'total_questions' => $totalQuestions
                    ]
                ]);
        } catch (\Exception $e) {
            \Log::error('Error submitting exam: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan jawaban'
            ], 500);
        }
    }

    /**
     * Calculate essay score based on keyword similarity
     */
    private function calculateEssayScore($jawabanPeserta, $jawabanBenar, $poinMaksimal)
    {
        // Konversi ke lowercase untuk perbandingan
        $jawabanPeserta = strtolower(trim($jawabanPeserta));
        $jawabanBenar = strtolower(trim($jawabanBenar));
        
        // Jika jawaban kosong
        if (empty($jawabanPeserta)) {
            return 0;
        }
        
        // Jika jawaban identik (exact match)
        if ($jawabanPeserta === $jawabanBenar) {
            return $poinMaksimal;
        }
        
        // Hitung kemiripan kata kunci
        $kataKunciBenar = $this->extractKeywords($jawabanBenar);
        $kataKunciPeserta = $this->extractKeywords($jawabanPeserta);
        
        if (empty($kataKunciBenar)) {
            return 0;
        }
        
        $kataSama = 0;
        foreach ($kataKunciBenar as $kata) {
            if (in_array($kata, $kataKunciPeserta)) {
                $kataSama++;
            }
        }
        
        $persentaseKataSama = $kataSama / count($kataKunciBenar);
        
        // Hitung skor berdasarkan persentase kata kunci yang sama
        $skor = round($persentaseKataSama * $poinMaksimal, 1);
        
        // Minimum skor 0, maksimum sesuai poin
        $skor = max(0, min($skor, $poinMaksimal));
        
        return $skor;
    }
    
    /**
     * Extract keywords from text
     */
    private function extractKeywords($text)
    {
        // Hapus tanda baca dan konversi ke lowercase
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text);
        $text = strtolower($text);
        
        // Split menjadi kata-kata
        $words = preg_split('/\s+/', $text);
        
        // Filter kata yang lebih dari 3 karakter dan bukan stop words
        $stopWords = ['yang', 'dan', 'atau', 'dari', 'dengan', 'untuk', 'pada', 'adalah', 'adalah', 'ini', 'itu', 'dia', 'mereka', 'kita', 'kami', 'saya', 'anda'];
        
        $keywords = array_filter($words, function($word) use ($stopWords) {
            return strlen($word) > 3 && !in_array($word, $stopWords);
        });
        
        // Return unique keywords
        return array_values(array_unique($keywords));
    }

    /**
     * Show peserta selesai page
     */
    public function pesertaSelesai()
    {
        try {
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
            }

            // Get peserta data
            $peserta = Peserta::find($userId);
            if (!$peserta) {
                return redirect()->route('login')->with('error', 'Data peserta tidak ditemukan');
            }

            // Get latest laporan for this peserta
            $laporan = Laporan::where('id_peserta', $userId)
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$laporan) {
                // If no laporan found, redirect to information page
                return redirect()->route('student.information')->with('info', 'Anda belum menyelesaikan ujian');
            }

            // Get total soal count from jawaban
            $totalSoal = Jawaban::where('id_peserta', $userId)->count();

            return view('students.peserta-selesai', compact('peserta', 'laporan', 'totalSoal'));
        } catch (\Exception $e) {
            \Log::error('Error in pesertaSelesai: ' . $e->getMessage());
            return redirect()->route('student.information')->with('error', 'Terjadi kesalahan saat memuat halaman');
        }
    }
}
