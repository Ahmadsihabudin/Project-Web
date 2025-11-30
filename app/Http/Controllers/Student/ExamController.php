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
use Carbon\Carbon;

class ExamController extends Controller
{
    /**
     * Menampilkan daftar ujian untuk peserta berdasarkan batch mereka
     */
    public function index()
    {
        try {
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                \Log::error('User not authenticated via session');
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

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
                $user = \App\Models\User::find($userId);
                if (!$user) {
                    \Log::error('User not found in database:', ['user_id' => $userId]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Data user tidak ditemukan'
                    ], 404);
                }
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                \Log::error('Peserta not found for email:', ['email' => $user->email]);
                return response()->json([
                    'success' => false,
                    'message' => 'Data peserta tidak ditemukan'
                ], 404);
            }
            $batchPeserta = $peserta->batch;

            if (!$batchPeserta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Peserta belum memiliki batch'
                ], 404);
            }
            $batch = \App\Models\Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower(trim($batchPeserta))])->first();
            if (!$batch) {
                \Log::error('Batch not found:', ['batch_name' => $batchPeserta]);
                return response()->json([
                    'success' => false,
                    'message' => 'Batch tidak ditemukan'
                ], 404);
            }



            $currentDate = now()->toDateString();
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])
                ->where('id_batch', $batch->id_batch)
                ->where('status', 'aktif')
                ->where('tanggal_mulai', '<=', $currentDate)
                ->where('tanggal_selesai', '>=', $currentDate)
                ->select('id_sesi', 'id_ujian', 'id_batch', 'mata_pelajaran', 'deskripsi', 'tanggal_mulai', 'jam_mulai', 'jam_selesai', 'tanggal_selesai', 'durasi_menit', 'status')
                ->orderBy('tanggal_mulai', 'desc')
                ->orderBy('jam_mulai', 'desc')
                ->get();

            $transformedSesiUjian = $sesiUjian->map(function ($sesiUjianItem) {
                $examId = $sesiUjianItem->id ?? $sesiUjianItem->id_sesi ?? $sesiUjianItem->exam_id ?? $sesiUjianItem->idUjian ?? null;
                if (!$examId && $sesiUjianItem->getAttribute('id_sesi')) {
                    $examId = $sesiUjianItem->getAttribute('id_sesi');
                }

                $waktuMulai = null;
                $waktuSelesai = null;
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
                    'id' => $examId,
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
                    'info_warning_url' => $examId ? url("/student/exam/{$examId}/info-warning") : null,
                    'start_url' => $examId ? url("/student/exam/{$examId}/start") : null
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
        $userId = session('user_id');
        $userType = session('user_type');
        if (!$userId || $userType !== 'peserta') {
            return redirect()->route('auth.peserta.login')
                ->with('error', 'Silakan login terlebih dahulu sebagai peserta.');
        }

        try {
            $peserta = \App\Models\Peserta::find($userId);

            if (!$peserta) {
                \Log::warning('Peserta not found:', ['user_id' => $userId]);
                return redirect()->route('auth.peserta.login')
                    ->with('error', 'Data peserta tidak ditemukan. Silakan login kembali.');
            }



            $redirectFromSelesai = session('redirect_from_selesai', false);
            if ($redirectFromSelesai) {

                session()->forget('redirect_from_selesai');
                \Log::info('Redirect from selesai detected, showing information page without redirect');
            } else {

                $hasCompletedExam = \App\Models\Laporan::where('id_peserta', $peserta->id_peserta)->exists();
                if ($hasCompletedExam) {
                    return redirect()->route('student.selesai')->with('info', 'Anda sudah menyelesaikan ujian.');
                }
            }
            $batchPeserta = $peserta->batch;
            if (!$batchPeserta || trim($batchPeserta) === '') {
                \Log::info('Peserta has no batch assigned - redirecting to peserta-wrong:', [
                    'peserta_id' => $peserta->id_peserta,
                    'peserta_name' => $peserta->nama ?? $peserta->nama_peserta,
                    'kode_peserta' => $peserta->kode_peserta
                ]);


                session([
                    'peserta_wrong_data' => [
                        'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                        'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                        'batch' => 'Belum ditentukan',
                        'email' => $peserta->email ?? 'N/A'
                    ]
                ]);

                return redirect()->route('student.peserta-wrong');
            }
            $batch = \App\Models\Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower(trim($batchPeserta))])->first();
            if (!$batch) {
                \Log::warning('Batch not found in database - redirecting to peserta-wrong:', ['batch_name' => $batchPeserta]);

                session([
                    'peserta_wrong_data' => [
                        'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                        'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                        'batch' => $peserta->batch ?? 'N/A',
                        'email' => $peserta->email ?? 'N/A'
                    ]
                ]);

                return redirect()->route('student.peserta-wrong');
            }

            $currentDateTime = now();
            $maxTimestamp = PHP_INT_MAX;


            $sesiUjianAktif = SesiUjian::where('id_batch', $batch->id_batch)
                ->where('status', 'aktif')
                ->get(['id_sesi', 'id_batch', 'mata_pelajaran', 'tanggal_mulai', 'jam_mulai', 'tanggal_selesai', 'jam_selesai'])
                ->map(function ($sesi) use ($currentDateTime, $maxTimestamp) {

                    $startDateTime = null;
                    $endDateTime = null;

                    if ($sesi->tanggal_mulai && $sesi->jam_mulai) {
                        $startDateTime = Carbon::parse($sesi->tanggal_mulai . ' ' . $sesi->jam_mulai);
                    }

                    if ($sesi->tanggal_selesai && $sesi->jam_selesai) {
                        $endDateTime = Carbon::parse($sesi->tanggal_selesai . ' ' . $sesi->jam_selesai);
                    }

                    $sesi->start_datetime = $startDateTime;
                    $sesi->end_datetime = $endDateTime;


                    if ($startDateTime && $endDateTime) {
                        if ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
                            $sesi->priority = 1;
                            $sesi->sort_key = 0;
                        } elseif ($currentDateTime < $startDateTime) {
                            $sesi->priority = 2;

                            $sesi->sort_key = $maxTimestamp - $startDateTime->timestamp;
                        } else {
                            $sesi->priority = 3;
                            $sesi->sort_key = -$startDateTime->timestamp;
                        }
                    } else {
                        $sesi->priority = 3;
                    }

                    return $sesi;
                })
                ->sortBy([
                    ['priority', 'asc'],
                    ['sort_key', 'asc']
                ])
                ->values();

            if ($sesiUjianAktif->count() == 0) {
                \Log::info('No active exams for batch - redirecting to peserta-wrong:', [
                    'batch_id' => $batch->id_batch,
                    'batch_name' => $batch->nama_batch,
                    'peserta_id' => $peserta->id_peserta
                ]);


                session([
                    'peserta_wrong_data' => [
                        'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                        'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                        'batch' => $peserta->batch ?? 'N/A',
                        'email' => $peserta->email ?? 'N/A'
                    ]
                ]);

                return redirect()->route('student.peserta-wrong');
            }


            $validSesiUjian = $sesiUjianAktif->filter(function ($sesi) use ($currentDateTime) {
                if ($sesi->end_datetime) {
                    return $currentDateTime <= $sesi->end_datetime;
                }
                return true;
            });

            if ($validSesiUjian->count() == 0) {
                \Log::info('No valid exam sessions for batch (all ended) - redirecting to peserta-wrong:', [
                    'batch_id' => $batch->id_batch,
                    'batch_name' => $batch->nama_batch,
                    'peserta_id' => $peserta->id_peserta
                ]);


                session([
                    'peserta_wrong_data' => [
                        'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                        'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                        'batch' => $peserta->batch ?? 'N/A',
                        'email' => $peserta->email ?? 'N/A'
                    ]
                ]);

                return redirect()->route('student.peserta-wrong');
            }


            $firstActiveExam = $validSesiUjian->first();

            \Log::info('Selected exam session:', [
                'exam_id' => $firstActiveExam->id_sesi,
                'mata_pelajaran' => $firstActiveExam->mata_pelajaran,
                'tanggal_mulai' => $firstActiveExam->tanggal_mulai,
                'jam_mulai' => $firstActiveExam->jam_mulai,
                'tanggal_selesai' => $firstActiveExam->tanggal_selesai,
                'jam_selesai' => $firstActiveExam->jam_selesai,
                'priority' => $firstActiveExam->priority,
                'total_active_sessions' => $validSesiUjian->count(),
                'all_sessions' => $validSesiUjian->map(function ($s) {
                    return [
                        'id' => $s->id_sesi,
                        'mata_pelajaran' => $s->mata_pelajaran,
                        'tanggal_mulai' => $s->tanggal_mulai,
                        'jam_mulai' => $s->jam_mulai,
                        'priority' => $s->priority
                    ];
                })->toArray()
            ]);
            $initialExamId = $firstActiveExam ? $firstActiveExam->id_sesi : null;

            // Mengarahkan ke halaman verifikasi terlebih dahulu
            $nextUrl = $initialExamId ? route('student.exam.verify', $initialExamId) : null;

            \Log::info('Setting initialExamId and initialExamInfoUrl:', [
                'initialExamId' => $initialExamId,
                'nextUrl' => $nextUrl,
                'first_exam_data' => $firstActiveExam ? [
                    'id_sesi' => $firstActiveExam->id_sesi,
                    'mata_pelajaran' => $firstActiveExam->mata_pelajaran,
                    'id_batch' => $firstActiveExam->id_batch,
                    'tanggal_mulai' => $firstActiveExam->tanggal_mulai,
                    'jam_mulai' => $firstActiveExam->jam_mulai
                ] : null
            ]);

            $initialPeserta = [
                'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                'batch' => $peserta->batch ?? 'N/A',
                'email' => $peserta->email ?? 'N/A',
                'asal_smk' => $peserta->asal_smk ?? 'N/A',
                'jurusan' => $peserta->jurusan ?? 'N/A',
            ];
        } catch (\Throwable $e) {
            \Log::error('Error in ExamController@information:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            $peserta = \App\Models\Peserta::find($userId);
            if ($peserta) {
                $initialPeserta = [
                    'nama' => $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta',
                    'kode_peserta' => $peserta->kode_peserta ?? 'N/A',
                    'batch' => $peserta->batch ?? 'N/A',
                    'email' => $peserta->email ?? 'N/A',
                    'asal_smk' => $peserta->asal_smk ?? 'N/A',
                    'jurusan' => $peserta->jurusan ?? 'N/A',
                ];
            }
            return view('students.information', [
                'initialPeserta' => $initialPeserta,
                'initialExamId' => null, // Nama variabel diubah untuk konsistensi
                'nextUrl' => null
            ])->with('error', 'Terjadi kesalahan saat memuat data. Silakan refresh halaman atau hubungi administrator.');
        }
        return view('students.information', compact('initialPeserta', 'initialExamId', 'nextUrl'));
    }

    /**
     * Menampilkan halaman informasi ujian
     */
    public function showExamInfo($id)
    {
        try {
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return redirect('/student/dashboard')->with('error', 'Data peserta tidak ditemukan');
            }
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/dashboard')->with('error', 'Ujian tidak ditemukan');
            }
            $batchPesertaName = trim($peserta->batch);
            $batch = \App\Models\Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower($batchPesertaName)])->first();

            if (!$batch) {
                \Log::warning('Batch not found for peserta in showExamInfo:', [
                    'peserta_id' => $peserta->id_peserta,
                    'batch_name' => $batchPesertaName
                ]);
                return redirect()->route('student.information')->with('error', 'Batch Anda tidak ditemukan dalam sistem.');
            }
            if ($sesiUjian->id_batch != $batch->id_batch) {
                \Log::warning('Access denied - batch mismatch:', [
                    'peserta_id' => $peserta->id_peserta,
                    'peserta_batch_id' => $batch->id_batch,
                    'peserta_batch_name' => $batch->nama_batch,
                    'sesi_ujian_id' => $sesiUjian->id_sesi,
                    'sesi_ujian_batch_id' => $sesiUjian->id_batch,
                    'sesi_ujian_batch_name' => $sesiUjian->batch ? $sesiUjian->batch->nama_batch : 'N/A'
                ]);
                return redirect()->route('student.information')->with('error', 'Anda tidak memiliki akses ke ujian ini.');
            }

            return view('students.exam-info', compact('sesiUjian', 'peserta'));
        } catch (\Exception $e) {
            \Log::error('Error showing exam info: ' . $e->getMessage());
            return redirect('/student/dashboard')->with('error', 'Terjadi kesalahan saat memuat informasi ujian');
        }
    }

    /**
     * Menampilkan halaman peringatan ujian dengan komposisi soal
     */
    public function showExamInfoWarning($id)
    {
        try {
            $userId = session('user_id');
            $userType = session('user_type');

            \Log::info('showExamInfoWarning called:', [
                'exam_id' => $id,
                'user_id' => $userId,
                'user_type' => $userType
            ]);

            // PENJAGA: Pastikan peserta sudah melewati verifikasi wajah untuk ujian ini.
            if (!session('is_face_verified_for_exam_' . $id)) {
                \Log::warning('Access to info-warning denied. Face not verified.', ['exam_id' => $id, 'user_id' => $userId]);
                // Arahkan kembali ke halaman verifikasi jika belum terverifikasi.
                return redirect()->route('student.exam.verify', ['id' => $id])->with('error', 'Anda harus melakukan verifikasi wajah terlebih dahulu.');
            }

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }

            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', optional($user)->email)->first();
            }

            if (!$peserta) {
                \Log::error('Peserta not found in showExamInfoWarning', ['user_id' => $userId]);
                return redirect('/student/information')->with('error', 'Data peserta tidak ditemukan');
            }

            \Log::info('Peserta found:', [
                'peserta_id' => $peserta->id_peserta,
                'batch' => $peserta->batch
            ]);

            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                \Log::error('Sesi ujian not found', ['exam_id' => $id]);
                return redirect('/student/information')->with('error', 'Sesi ujian tidak ditemukan.');
            }

            \Log::info('Sesi ujian found:', [
                'sesi_id' => $sesiUjian->id_sesi,
                'id_batch' => $sesiUjian->id_batch,
                'mata_pelajaran' => $sesiUjian->mata_pelajaran,
                'has_ujian' => $sesiUjian->ujian ? 'yes' : 'no'
            ]);

            $batchPesertaName = trim($peserta->batch);
            $batch = Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower($batchPesertaName)])->first();

            if (!$batch) {
                \Log::error('Batch not found for peserta', [
                    'batch_name' => $batchPesertaName
                ]);
                return redirect()->route('student.information')->with('error', 'Batch Anda tidak ditemukan dalam sistem.');
            }

            if ($sesiUjian->id_batch != $batch->id_batch) {
                \Log::warning('Batch mismatch', [
                    'peserta_batch_id' => $batch->id_batch,
                    'sesi_batch_id' => $sesiUjian->id_batch
                ]);
                return redirect()->route('student.information')->with('error', 'Anda tidak memiliki akses ke ujian ini.');
            }




            $batchSesiUjian = $sesiUjian->batch ? $sesiUjian->batch->nama_batch : null;
            if (!$batchSesiUjian && $sesiUjian->id_batch) {

                $batchModel = \App\Models\Batch::find($sesiUjian->id_batch);
                $batchSesiUjian = $batchModel ? $batchModel->nama_batch : $batchPesertaName;
            } else {
                $batchSesiUjian = $batchPesertaName;
            }

            $batchSesiUjianName = trim($batchSesiUjian);

            $mataPelajaranRaw = trim($sesiUjian->mata_pelajaran ?? '');
            $mataPelajaranList = [];

            if (!empty($mataPelajaranRaw)) {
                $mataPelajaranList = array_filter(
                    array_map('trim', explode(',', $mataPelajaranRaw)),
                    function ($item) {
                        return !empty($item);
                    }
                );
                $mataPelajaranList = array_map('strtolower', $mataPelajaranList);
            }

            \Log::info('Starting question composition calculation:', [
                'batch_peserta' => $batchPesertaName,
                'batch_sesi_ujian' => $batchSesiUjianName,
                'batch_normalized' => strtolower($batchSesiUjianName),
                'mata_pelajaran_raw' => $mataPelajaranRaw,
                'mata_pelajaran_list' => $mataPelajaranList
            ]);


            if (empty($mataPelajaranList)) {
                \Log::warning('No mata pelajaran found for composition calculation');
                $composition = [
                    'pilihan_ganda' => 0,
                    'true_false' => 0,
                    'total' => 0
                ];
            } else {

                $batchNormalized = strtolower(trim($batchSesiUjianName));

                $allBatches = Soal::select('batch')->distinct()->get()->pluck('batch')->toArray();

                \Log::info('Batch matching debug:', [
                    'target_batch_peserta' => $batchPesertaName,
                    'target_batch_sesi' => $batchSesiUjianName,
                    'target_batch_normalized' => $batchNormalized,
                    'all_batches_in_soal' => $allBatches,
                    'all_batches_normalized' => array_map(function ($b) {
                        return strtolower(trim($b ?? ''));
                    }, $allBatches)
                ]);

                $soalQuery = Soal::whereRaw('LOWER(TRIM(batch)) = ?', [$batchNormalized]);


                if (!empty($mataPelajaranList)) {
                    $soalQuery->where(function ($query) use ($mataPelajaranList) {
                        $first = true;
                        foreach ($mataPelajaranList as $mp) {
                            $mpNormalized = strtolower(trim($mp));
                            if ($first) {
                                $query->whereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                                $first = false;
                            } else {
                                $query->orWhereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                            }
                        }
                    });
                }

                $soal = $soalQuery->get();

                $allSoalInBatch = Soal::whereRaw('LOWER(TRIM(batch)) = ?', [$batchNormalized])->get();

                \Log::info('Query result:', [
                    'query_sql' => $soalQuery->toSql(),
                    'query_bindings' => $soalQuery->getBindings(),
                    'soal_count' => $soal->count(),
                    'soal_ids' => $soal->pluck('id_soal')->toArray(),
                    'soal_details' => $soal->map(function ($s) {
                        return [
                            'id_soal' => $s->id_soal,
                            'batch' => $s->batch,
                            'mata_pelajaran' => $s->mata_pelajaran,
                            'tipe_soal' => $s->tipe_soal,
                            'pertanyaan_preview' => mb_substr($s->pertanyaan ?? '', 0, 50)
                        ];
                    })->toArray(),
                    'debug_all_soal_in_batch_count' => $allSoalInBatch->count(),
                    'debug_all_soal_in_batch' => $allSoalInBatch->map(function ($s) use ($mataPelajaranList) {
                        return [
                            'id_soal' => $s->id_soal,
                            'batch' => $s->batch,
                            'mata_pelajaran' => $s->mata_pelajaran,
                            'tipe_soal' => $s->tipe_soal,
                            'mata_pelajaran_normalized' => strtolower(trim($s->mata_pelajaran ?? '')),
                            'matches_mata_pelajaran' => in_array(strtolower(trim($s->mata_pelajaran ?? '')), $mataPelajaranList),
                            'mata_pelajaran_list_for_matching' => $mataPelajaranList
                        ];
                    })->toArray()
                ]);

                $pilihanGanda = 0;
                $trueFalse = 0;

                foreach ($soal as $s) {
                    $tipe = strtolower(trim($s->tipe_soal ?? ''));
                    if ($tipe === 'pilihan_ganda') {
                        $pilihanGanda++;
                    } elseif (in_array($tipe, ['benar_salah', 'true_false'])) {
                        $trueFalse++;
                    }
                }

                $composition = [
                    'pilihan_ganda' => $pilihanGanda,
                    'true_false' => $trueFalse,
                    'total' => $pilihanGanda + $trueFalse
                ];

                \Log::info('Question composition calculated:', [
                    'batch' => $batchPesertaName,
                    'batch_normalized' => $batchNormalized,
                    'mata_pelajaran' => $mataPelajaranRaw,
                    'mata_pelajaran_list' => $mataPelajaranList,
                    'total_soal' => $soal->count(),
                    'composition' => $composition,
                    'pilihan_ganda_count' => $pilihanGanda,
                    'true_false_count' => $trueFalse,
                    'missing_mata_pelajaran' => array_values(array_diff(
                        $mataPelajaranList,
                        $soal->map(function ($s) {
                            return strtolower(trim($s->mata_pelajaran ?? ''));
                        })->unique()->toArray()
                    ))
                ]);
            }

            $now = Carbon::now();
            $startDateTime = null;
            $endDateTime = null;

            if ($sesiUjian->tanggal_mulai) {
                if (strlen($sesiUjian->tanggal_mulai) > 10) {
                    $dateOnly = substr($sesiUjian->tanggal_mulai, 0, 10);
                    $timeOnly = $sesiUjian->jam_mulai ? date('H:i:s', strtotime($sesiUjian->jam_mulai)) : '00:00:00';
                    $startDateTime = Carbon::parse($dateOnly . ' ' . $timeOnly);
                } else {
                    $startDateTime = Carbon::parse($sesiUjian->tanggal_mulai . ' ' . ($sesiUjian->jam_mulai ?? '00:00:00'));
                }
            }

            if ($sesiUjian->tanggal_selesai) {
                if (strlen($sesiUjian->tanggal_selesai) > 10) {
                    $dateOnly = substr($sesiUjian->tanggal_selesai, 0, 10);
                    $timeOnly = $sesiUjian->jam_selesai ? date('H:i:s', strtotime($sesiUjian->jam_selesai)) : '23:59:59';
                    $endDateTime = Carbon::parse($dateOnly . ' ' . $timeOnly);
                } else {
                    $endDateTime = Carbon::parse($sesiUjian->tanggal_selesai . ' ' . ($sesiUjian->jam_selesai ?? '23:59:59'));
                }
            }

            $statusLabel = 'Siap Dimulai';
            if ($startDateTime && $now->lt($startDateTime)) {
                $statusLabel = 'Belum Dimulai';
            } elseif ($endDateTime && $now->gt($endDateTime)) {
                $statusLabel = 'Sudah Selesai';
            } elseif ($startDateTime && $endDateTime && $now->between($startDateTime, $endDateTime)) {
                $statusLabel = 'Sedang Berlangsung';
            }

            // Get info ujian from settings
            $warningKeys = [
                'warning_waktu' => 'exam.warning.waktu',
                'warning_integritas' => 'exam.warning.integritas',
                'warning_navigasi' => 'exam.warning.navigasi',
                'warning_konfirmasi' => 'exam.warning.konfirmasi'
            ];

            $defaults = [
                'warning_waktu' => 'Waktu Terbatas: Ujian memiliki batas waktu yang ketat. Pastikan koneksi internet stabil dan tidak ada gangguan.',
                'warning_integritas' => 'Integritas Ujian: Dilarang keras melakukan kecurangan, membuka tab lain, atau menggunakan bantuan eksternal.',
                'warning_navigasi' => 'Navigasi Terbatas: Setelah memulai ujian, Anda tidak dapat kembali ke halaman sebelumnya atau mengubah jawaban yang sudah dikirim.',
                'warning_konfirmasi' => 'Konfirmasi Jawaban: Pastikan semua jawaban sudah benar sebelum mengirim. Tidak ada kesempatan untuk mengubah setelah submit.'
            ];

            $warnings = [];
            foreach ($warningKeys as $key => $settingKey) {
                $setting = \App\Models\Setting::where('key', $settingKey)->first();
                $warnings[$key] = $setting ? $setting->value : $defaults[$key];
            }

            \Log::info('Rendering exam-info-warning view', [
                'status' => $statusLabel,
                'composition' => $composition,
                'composition_total' => $composition['total'] ?? 0,
                'composition_pilihan_ganda' => $composition['pilihan_ganda'] ?? 0,
                'composition_true_false' => $composition['true_false'] ?? 0
            ]);

            return view('students.exam-info-warning', [
                'exam' => $sesiUjian,
                'participant' => $peserta,
                'composition' => $composition,
                'statusLabel' => $statusLabel,
                'startDateTime' => $startDateTime,
                'endDateTime' => $endDateTime,
                'canStart' => true,
                'warnings' => $warnings,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error loading exam info warning: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect('/student/information')->with('error', 'Terjadi kesalahan saat memuat informasi ujian: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman peringatan ujian
     */
    public function showExamWarning($id)
    {
        try {
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return redirect('/student/information')->with('error', 'Data peserta tidak ditemukan');
            }
            $hasCompletedExam = \App\Models\Laporan::where('id_peserta', $peserta->id_peserta)->exists();
            if ($hasCompletedExam) {
                return redirect()->route('student.selesai')->with('info', 'Anda sudah menyelesaikan ujian.');
            }
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/information')->with('error', 'Ujian tidak ditemukan');
            }
            $batchPesertaName = trim($peserta->batch);
            $batch = \App\Models\Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower($batchPesertaName)])->first();

            if (!$batch) {
                \Log::warning('Batch not found for peserta in showExamWarning:', [
                    'peserta_id' => $peserta->id_peserta,
                    'batch_name' => $batchPesertaName
                ]);
                return redirect('/student/information')->with('error', 'Batch Anda tidak ditemukan dalam sistem.');
            }
            if ($sesiUjian->id_batch != $batch->id_batch) {
                \Log::warning('Access denied - batch mismatch:', [
                    'peserta_id' => $peserta->id_peserta,
                    'peserta_batch_id' => $batch->id_batch,
                    'peserta_batch_name' => $batch->nama_batch,
                    'sesi_ujian_id' => $sesiUjian->id_sesi,
                    'sesi_ujian_batch_id' => $sesiUjian->id_batch,
                    'sesi_ujian_batch_name' => $sesiUjian->batch ? $sesiUjian->batch->nama_batch : 'N/A'
                ]);
                return redirect('/student/information')->with('error', 'Anda tidak memiliki akses ke ujian ini.');
            }
            $mataPelajaranArray = explode(', ', $sesiUjian->mata_pelajaran);
            $soal = \App\Models\Soal::whereIn('mata_pelajaran', $mataPelajaranArray)
                ->get();

            return view('students.exam-warning', compact('sesiUjian', 'peserta', 'soal'));
        } catch (\Exception $e) {
            \Log::error('Error showing exam warning: ' . $e->getMessage());
            return redirect('/student/information')->with('error', 'Terjadi kesalahan saat memuat peringatan ujian');
        }
    }

    /**
     * Memulai ujian (redirect ke halaman ujian)
     */
    public function startExam($id)
    {
        \Log::info('startExam method called:', ['exam_id' => $id]);

        try {
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }

            // PENJAGA: Pastikan peserta sudah melewati verifikasi wajah untuk ujian ini.
            if (!session('is_face_verified_for_exam_' . $id)) {
                \Log::warning('Access to startExam denied. Face not verified.', ['exam_id' => $id, 'user_id' => $userId]);
                // Arahkan kembali ke halaman verifikasi jika belum terverifikasi.
                return redirect()->route('student.exam.verify', ['id' => $id])->with('error', 'Anda harus melakukan verifikasi wajah terlebih dahulu.');
            }

            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return redirect('/student/information')->with('error', 'Data peserta tidak ditemukan');
            }

            $hasCompletedExam = Laporan::where('id_peserta', $peserta->id_peserta)->exists();
            if ($hasCompletedExam) {
                return redirect()->route('student.selesai')->with('info', 'Anda sudah menyelesaikan ujian.');
            }

            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/information')->with('error', 'Ujian tidak ditemukan');
            }

            $batchPesertaName = trim($peserta->batch);
            $batch = \App\Models\Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower($batchPesertaName)])->first();

            if (!$batch || $sesiUjian->id_batch != $batch->id_batch) {
                \Log::warning('Access denied - batch mismatch in startExam:', [
                    'peserta_id' => $peserta->id_peserta,
                    'peserta_batch' => $batchPesertaName,
                    'sesi_batch_id' => $sesiUjian->id_batch
                ]);
                return redirect('/student/information')->with('error', 'Anda tidak memiliki akses ke ujian ini.');
            }

            if (!$sesiUjian->ujian) {
                $sesiUjian->ujian = (object) [
                    'nama_ujian' => 'Ujian ' . $sesiUjian->mata_pelajaran
                ];
            }



            $batchPesertaName = trim($peserta->batch);
            $batchNormalized = strtolower(trim($batchPesertaName));

            $mataPelajaranRaw = trim($sesiUjian->mata_pelajaran ?? '');
            $mataPelajaranList = [];

            if (!empty($mataPelajaranRaw)) {
                $mataPelajaranList = array_filter(
                    array_map('trim', explode(',', $mataPelajaranRaw)),
                    function ($item) {
                        return !empty($item);
                    }
                );
                $mataPelajaranList = array_map('strtolower', $mataPelajaranList);
            }

            \Log::info('Starting soal query for startExam:', [
                'batch' => $batchPesertaName,
                'batch_normalized' => $batchNormalized,
                'mata_pelajaran_raw' => $mataPelajaranRaw,
                'mata_pelajaran_list' => $mataPelajaranList
            ]);

            $soalQuery = Soal::whereRaw('LOWER(TRIM(batch)) = ?', [$batchNormalized]);

            if (!empty($mataPelajaranList)) {
                $soalQuery->where(function ($query) use ($mataPelajaranList) {
                    $first = true;
                    foreach ($mataPelajaranList as $mp) {
                        $mpNormalized = strtolower(trim($mp));
                        if ($first) {
                            $query->whereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                            $first = false;
                        } else {
                            $query->orWhereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                        }
                    }
                });
            } else {
                $soalQuery->whereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [strtolower(trim($mataPelajaranRaw))]);
            }

            $soal = $soalQuery->inRandomOrder()->get();

            \Log::info('Soal retrieved for startExam:', [
                'batch' => $batchPesertaName,
                'batch_normalized' => $batchNormalized,
                'mata_pelajaran_raw' => $mataPelajaranRaw,
                'mata_pelajaran_list' => $mataPelajaranList,
                'query_sql' => $soalQuery->toSql(),
                'query_bindings' => $soalQuery->getBindings(),
                'count' => $soal->count(),
                'soal_ids' => $soal->pluck('id_soal')->toArray(),
                'soal_details' => $soal->map(function ($s) {
                    return [
                        'id_soal' => $s->id_soal,
                        'batch' => $s->batch,
                        'mata_pelajaran' => $s->mata_pelajaran,
                        'tipe_soal' => $s->tipe_soal
                    ];
                })->toArray()
            ]);

            if ($soal->isEmpty()) {
                \Log::warning('Soal kosong untuk sesi ujian', [
                    'sesi_ujian_id' => $sesiUjian->id_sesi,
                    'mata_pelajaran_raw' => $mataPelajaranRaw,
                    'mata_pelajaran_list' => $mataPelajaranList,
                    'batch' => $batchPesertaName,
                    'batch_normalized' => $batchNormalized
                ]);
                return redirect('/student/information')->with('error', 'Tidak ada soal tersedia untuk ujian ini');
            }

            return view('students.exam', compact('sesiUjian', 'soal', 'peserta'));
        } catch (\Exception $e) {
            \Log::error('Error starting exam: ' . $e->getMessage());
            return redirect('/student/information')->with('error', 'Terjadi kesalahan saat memulai ujian');
        }
    }

    /**
     * Menampilkan halaman ujian
     */
    public function showExam($id)
    {
        try {
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect('/auth/peserta/login')->with('error', 'Silakan login terlebih dahulu');
            }
            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                return redirect('/student/dashboard')->with('error', 'Data peserta tidak ditemukan');
            }
            $sesiUjian = SesiUjian::with(['ujian', 'batch'])->find($id);
            if (!$sesiUjian) {
                return redirect('/student/dashboard')->with('error', 'Ujian tidak ditemukan');
            }
            $batchPesertaName = trim($peserta->batch);
            $batch = \App\Models\Batch::whereRaw('LOWER(nama_batch) = ?', [strtolower($batchPesertaName)])->first();

            if (!$batch) {
                \Log::warning('Batch not found for peserta in showExam:', [
                    'peserta_id' => $peserta->id_peserta,
                    'batch_name' => $batchPesertaName
                ]);
                return redirect()->route('student.information')->with('error', 'Batch Anda tidak ditemukan dalam sistem.');
            }
            if ($sesiUjian->id_batch != $batch->id_batch) {
                \Log::warning('Access denied - batch mismatch:', [
                    'peserta_id' => $peserta->id_peserta,
                    'peserta_batch_id' => $batch->id_batch,
                    'peserta_batch_name' => $batch->nama_batch,
                    'sesi_ujian_id' => $sesiUjian->id_sesi,
                    'sesi_ujian_batch_id' => $sesiUjian->id_batch,
                    'sesi_ujian_batch_name' => $sesiUjian->batch ? $sesiUjian->batch->nama_batch : 'N/A'
                ]);
                return redirect()->route('student.information')->with('error', 'Anda tidak memiliki akses ke ujian ini.');
            }
            $now = now();
            $tanggalMulai = $sesiUjian->tanggal_mulai . ' ' . $sesiUjian->jam_mulai;
            $tanggalSelesai = $sesiUjian->tanggal_selesai . ' ' . $sesiUjian->jam_selesai;

            if ($now < $tanggalMulai) {
                return redirect()->route('student.information')->with('error', 'Ujian belum dimulai');
            }

            if ($now > $tanggalSelesai) {
                return redirect()->route('student.information')->with('error', 'Ujian sudah selesai');
            }

            $soal = \App\Models\Soal::whereRaw('LOWER(batch) = ?', [strtolower(trim($batchPesertaName))])
                ->whereRaw('LOWER(mata_pelajaran) = ?', [strtolower(trim($sesiUjian->mata_pelajaran))])
                ->inRandomOrder()
                ->get();

            if ($soal->isEmpty()) {
                return redirect()->route('student.information')->with('error', 'Tidak ada soal tersedia untuk mata pelajaran ini');
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
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }
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
            $sesiUjian = SesiUjian::find($id);
            if (!$sesiUjian) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ujian tidak ditemukan'
                ], 404);
            }
            \Log::info('Exam submission request:', [
                'user_id' => $userId,
                'user_type' => $userType,
                'exam_id' => $id,
                'request_data' => $request->all(),
                'jawaban_data' => $request->jawaban ?? 'NOT_SET'
            ]);
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
            $mataPelajaranArray = explode(', ', $sesiUjian->mata_pelajaran);
            $soal = \App\Models\Soal::whereIn('mata_pelajaran', $mataPelajaranArray)->get();
            $totalQuestions = $soal->count();
            $correctAnswers = 0;
            $totalPoints = 0;
            $maxPoints = 0;
            $jawabanData = $request->jawaban;

            foreach ($soal as $soalItem) {
                $soalId = $soalItem->id_soal;
                $jawabanPeserta = $jawabanData[$soalId] ?? null;

                // Hitung poin maksimal untuk soal ini
                $poinBenarSoal = $soalItem->poin_benar ?? $soalItem->poin;
                $maxPoints += $poinBenarSoal;

                if ($jawabanPeserta) {
                    if ($soalItem->tipe_soal === 'pilihan_ganda') {
                        $isCorrect = strtolower(trim($soalItem->jawaban_benar)) === strtolower(trim($jawabanPeserta));
                    } elseif (in_array($soalItem->tipe_soal, ['benar_salah', 'true_false'])) {
                        $isCorrect = strtolower(trim($soalItem->jawaban_benar)) === strtolower(trim($jawabanPeserta));
                    } else {
                        $isCorrect = false;
                    }

                    // Hitung poin berdasarkan jenis penilaian
                    if ($isCorrect) {
                        $correctAnswers++;
                        $poinBenar = $soalItem->poin_benar ?? $soalItem->poin;
                        $totalPoints += $poinBenar;
                    } else {
                        // Jika salah, kurangi poin jika jenis_penilaian = pengurangan_poin
                        $poinSalah = $soalItem->poin_salah ?? 0;
                        $totalPoints += $poinSalah; // poinSalah sudah negatif jika pengurangan
                    }

                    \App\Models\Jawaban::create([
                        'id_peserta' => $peserta->id_peserta,
                        'id_soal' => $soalId,
                        'jawaban_dipilih' => $jawabanPeserta,
                        'status' => $isCorrect ? 'benar' : 'salah'
                    ]);
                } else {
                    // Jika tidak dijawab, tidak dapat poin (atau kurangi jika pengurangan)
                    $poinSalah = $soalItem->poin_salah ?? 0;
                    if ($soalItem->jenis_penilaian === 'pengurangan_poin') {
                        $totalPoints += $poinSalah; // Kurangi poin jika tidak dijawab
                    }
                }
            }

            // Hitung skor dalam persentase (bisa minus jika pengurangan poin)
            $totalScore = $maxPoints > 0 ? ($totalPoints / $maxPoints) * 100 : 0;
            $waktuPengerjaan = $request->input('waktu_pengerjaan', $sesiUjian->durasi_menit);

            \Log::info('Waktu pengerjaan calculated:', [
                'waktu_pengerjaan_from_frontend' => $request->input('waktu_pengerjaan'),
                'durasi_sesi' => $sesiUjian->durasi_menit,
                'final_waktu_pengerjaan' => $waktuPengerjaan
            ]);
            $laporan = \App\Models\Laporan::create([
                'id_peserta' => $peserta->id_peserta,
                'total_score' => round($totalScore, 2),
                'jumlah_benar' => $correctAnswers,
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
     * Show peserta selesai page
     */
    public function pesertaSelesai()
    {
        try {
            $userId = session('user_id');
            $userType = session('user_type');

            if (!$userId || !$userType) {
                return redirect()->route('auth.peserta.login')->with('error', 'Silakan login terlebih dahulu');
            }

            if ($userType === 'peserta') {
                $peserta = Peserta::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
                $peserta = Peserta::where('email', $user->email)->first();
            }

            if (!$peserta) {
                \Log::warning('Peserta not found in pesertaSelesai:', ['user_id' => $userId, 'user_type' => $userType]);
                return redirect()->route('auth.peserta.login')->with('error', 'Data peserta tidak ditemukan');
            }

            $laporan = Laporan::where('id_peserta', $peserta->id_peserta)
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$laporan) {
                \Log::info('No laporan found in pesertaSelesai, redirecting to information:', [
                    'peserta_id' => $peserta->id_peserta,
                    'user_id' => $userId
                ]);


                session(['redirect_from_selesai' => true]);

                return redirect()->route('student.information')->with('info', 'Anda belum menyelesaikan ujian. Silakan selesaikan ujian terlebih dahulu.');
            }

            $totalSoal = Jawaban::where('id_peserta', $peserta->id_peserta)->count();

            \Log::info('Peserta selesai page loaded successfully:', [
                'peserta_id' => $peserta->id_peserta,
                'laporan_id' => $laporan->id_laporan ?? null,
                'total_soal' => $totalSoal
            ]);

            return view('students.peserta-selesai', compact('peserta', 'laporan', 'totalSoal'));
        } catch (\Exception $e) {
            \Log::error('Error in pesertaSelesai: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            try {
                $userId = session('user_id');
                $peserta = Peserta::find($userId);
                if ($peserta) {
                    $laporan = (object) [
                        'id_laporan' => null,
                        'total_score' => 0,
                        'jumlah_benar' => 0,
                        'waktu_pengerjaan' => 0,
                        'status_submit' => 'error'
                    ];

                    $totalSoal = 0;
                    return view('students.peserta-selesai', compact('peserta', 'laporan', 'totalSoal'))
                        ->with('error', 'Terjadi kesalahan saat memuat halaman');
                }
            } catch (\Exception $e2) {

                return redirect()->route('auth.peserta.login')->with('error', 'Terjadi kesalahan saat memuat halaman');
            }
        }
    }

    /**
     * Menampilkan halaman verifikasi wajah sebelum ujian.
     */
    public function showVerificationPage(Request $request, $id)
    {
        try {
            $userId = session('user_id');
            $peserta = Peserta::find($userId);
            $sesiUjian = SesiUjian::find($id);

            if (!$peserta || !$sesiUjian) {
                return redirect()->route('student.information')->with('error', 'Data peserta atau sesi ujian tidak ditemukan.');
            }

            // Pastikan peserta memiliki foto untuk perbandingan
            if (empty($peserta->foto)) {
                return redirect()->route('student.information')->with('error', 'Foto profil Anda tidak ditemukan. Silakan hubungi administrator.');
            }

            // Tandai bahwa verifikasi diperlukan untuk sesi ini
            session(['needs_verification_for_exam_' . $id => true]);

            return view('students.verify', [
                'peserta' => $peserta,
                'sesiUjian' => $sesiUjian,
                'id_sesi' => $id
            ]);
        } catch (\Exception $e) {
            \Log::error('Error showing verification page: ' . $e->getMessage());
            return redirect()->route('student.information')->with('error', 'Gagal memuat halaman verifikasi.');
        }
    }

    /**
     * Menangani callback setelah verifikasi wajah berhasil.
     */
    public function handleVerificationSuccess(Request $request)
    {
        $id_sesi = $request->input('id_sesi');

        // Simpan status verifikasi ke dalam session
        session(['is_face_verified_for_exam_' . $id_sesi => true]);
        session()->forget('needs_verification_for_exam_' . $id_sesi);

        return response()->json(['success' => true, 'message' => 'Verifikasi berhasil dicatat.']);
    }
}
