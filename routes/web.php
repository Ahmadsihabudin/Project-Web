<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\SecureAuthController;

Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::post('/admin/login', [SecureAuthController::class, 'adminLogin'])->name('auth.admin.login');
    Route::post('/peserta/login', [SecureAuthController::class, 'pesertaLogin'])->name('auth.peserta.login');
    Route::post('/logout', [SecureAuthController::class, 'logout'])->name('auth.logout');
    Route::get('/logout', [SecureAuthController::class, 'logout'])->name('auth.logout.get');
});

// Define login route for auth middleware
Route::get('/login', function () {
    return redirect('/');
})->name('login');

// Debug routes removed for production security















// Admin Routes (Protected)
Route::prefix('admin')->middleware(['custom.auth'])->group(function () {
    // Redirect /admin to /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/users', 'admin.users.index')->name('admin.users.index');
    Route::view('/users/create', 'admin.users.create')->name('admin.users.create');

    // User Management API Routes (must be before parameterized routes)
    Route::get('/users/data', [App\Http\Controllers\UserController::class, 'data'])->name('admin.users.data');
    Route::get('/users/stats', [App\Http\Controllers\UserController::class, 'stats'])->name('admin.users.stats');

    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');

    Route::view('/questions', 'admin.questions.index')->name('admin.questions.index');
    Route::view('/questions/create', 'admin.questions.create')->name('admin.questions.create');
    Route::view('/questions/{id}/edit', 'admin.questions.edit')->name('admin.questions.edit');
    Route::get('/questions/import/template', [App\Http\Controllers\QuestionImportController::class, 'downloadTemplate'])->name('admin.questions.import.template');
    Route::post('/questions/import', [App\Http\Controllers\QuestionImportController::class, 'import'])->name('admin.questions.import');

    Route::view('/participants', 'admin.participants.index')->name('admin.participants.index');
    Route::view('/participants/create', 'admin.participants.create')->name('admin.participants.create');
    Route::view('/participants/{id}/edit', 'admin.participants.edit')->name('admin.participants.edit');
    Route::get('/participants/import/template', [App\Http\Controllers\ParticipantController::class, 'downloadTemplate'])->name('admin.participants.import.template');
    Route::post('/participants/import', [App\Http\Controllers\ParticipantController::class, 'import'])->name('admin.participants.import');

    Route::view('/reports', 'admin.reports.index')->name('admin.reports.index');
    Route::view('/reports/create', 'admin.reports.create')->name('admin.reports.create');
    Route::view('/reports/{id}/edit', 'admin.reports.edit')->name('admin.reports.edit');
    Route::get('/reports/data', [App\Http\Controllers\ReportController::class, 'data'])->name('admin.reports.data');
    Route::get('/reports/stats', [App\Http\Controllers\ReportController::class, 'stats'])->name('admin.reports.stats');
    Route::post('/reports/bulk-delete', [App\Http\Controllers\ReportController::class, 'bulkDelete'])->name('admin.reports.bulk-delete');

    // Sesi Ujian (Admin)
    Route::view('/sesi-ujian', 'admin.sesi-ujian.index')->name('admin.sesi-ujian.index');
    Route::view('/sesi-ujian/create', 'admin.sesi-ujian.create')->name('admin.sesi-ujian.create');
    Route::view('/sesi-ujian/{id}/edit', 'admin.sesi-ujian.edit')->name('admin.sesi-ujian.edit');

    // Sesi Ujian CRUD routes
    Route::post('/sesi-ujian', [App\Http\Controllers\SesiUjianController::class, 'store'])->name('admin.sesi-ujian.store');
    // Sesi Ujian API routes
    Route::get('/sesi-ujian/stats', [App\Http\Controllers\SesiUjianController::class, 'stats'])->name('admin.sesi-ujian.stats');
    Route::get('/sesi-ujian/data', function () {
        $rows = App\Models\SesiUjian::with(['ujian', 'batch'])
            ->orderBy('tanggal_mulai', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();
        $data = $rows->map(function ($r) {
            return [
                'id' => $r->id_sesi,
                'nama_ujian' => optional($r->ujian)->nama_ujian ?? ($r->mata_pelajaran ?: 'Ujian'),
                // Both batch (string) and batch_name (for frontend) for compatibility
                'batch' => optional($r->batch)->nama_batch ?? optional(App\Models\Batch::find($r->id_batch))->nama_batch ?? (string) $r->id_batch,
                'batch_name' => optional($r->batch)->nama_batch ?? optional(App\Models\Batch::find($r->id_batch))->nama_batch ?? (string) $r->id_batch,
                'deskripsi' => $r->deskripsi,
                'tanggal_mulai' => $r->tanggal_mulai,
                'jam_mulai' => $r->jam_mulai,
                'tanggal_selesai' => $r->tanggal_selesai,
                'jam_selesai' => $r->jam_selesai,
                'durasi_menit' => $r->durasi_menit,
                'status' => $r->status,
                'created_at' => $r->created_at,
            ];
        });
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    })->name('admin.sesi-ujian.data');
    Route::put('/sesi-ujian/{id}', [App\Http\Controllers\SesiUjianController::class, 'update'])->name('admin.sesi-ujian.update');

    Route::delete('/sesi-ujian/{id}', [App\Http\Controllers\SesiUjianController::class, 'destroy'])->name('admin.sesi-ujian.destroy');

    // Form helpers: mata pelajaran dan daftar batch untuk create/edit sesi ujian
    Route::get('/sesi-ujian/mata-pelajaran', function () {
        // Ambil distinct mata pelajaran dari tabel soal
        $mapel = App\Models\Soal::select('mata_pelajaran')
            ->whereNotNull('mata_pelajaran')
            ->distinct()
            ->orderBy('mata_pelajaran')
            ->pluck('mata_pelajaran');
        return response()->json(['success' => true, 'data' => $mapel]);
    })->name('admin.sesi-ujian.mata-pelajaran');

    // Calculate total duration based on batch and mata pelajaran
    Route::post('/sesi-ujian/calculate-duration', function (Request $request) {
        try {
            $idBatch = $request->input('id_batch');
            $mataPelajaran = $request->input('mata_pelajaran', []);
            
            if (!$idBatch || empty($mataPelajaran)) {
                return response()->json([
                    'success' => true,
                    'total_duration' => 0,
                    'total_soal' => 0
                ]);
            }
            
            // Get batch name
            $batch = App\Models\Batch::find($idBatch);
            if (!$batch) {
                return response()->json([
                    'success' => true,
                    'total_duration' => 0,
                    'total_soal' => 0
                ]);
            }
            
            // Query soal berdasarkan batch dan mata pelajaran
            $soalQuery = App\Models\Soal::whereRaw('LOWER(TRIM(batch)) = ?', [strtolower(trim($batch->nama_batch))]);
            
            if (is_array($mataPelajaran) && !empty($mataPelajaran)) {
                $soalQuery->where(function ($query) use ($mataPelajaran) {
                    $first = true;
                    foreach ($mataPelajaran as $mp) {
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
            
            // Calculate total duration
            $totalDuration = 0;
            $totalSoal = $soal->count();
            
            foreach ($soal as $s) {
                if ($s->durasi_soal) {
                    $totalDuration += $s->durasi_soal;
                }
            }
            
            return response()->json([
                'success' => true,
                'total_duration' => $totalDuration,
                'total_soal' => $totalSoal
            ]);
        } catch (\Exception $e) {
            \Log::error('Error calculating duration: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghitung durasi: ' . $e->getMessage()
            ], 500);
        }
    })->name('admin.sesi-ujian.calculate-duration');

    // Update all sesi ujian duration
    Route::post('/sesi-ujian/update-all-duration', function () {
        try {
            $result = App\Http\Controllers\SesiUjianController::updateAllDurasiSesiUjian();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal update durasi: ' . $e->getMessage()
            ], 500);
        }
    })->name('admin.sesi-ujian.update-all-duration');

    Route::get('/participants/batches', function () {
        $batches = App\Models\Batch::orderBy('nama_batch')->get(['id_batch', 'nama_batch']);
        return response()->json(['success' => true, 'data' => $batches]);
    })->name('admin.participants.batches');

    // Data sesi ujian detail
    Route::get('/sesi-ujian/{id}/data', function ($id) {
        $sesi = App\Models\SesiUjian::with(['ujian', 'batch'])->findOrFail($id);
        $payload = [
            'id_sesi' => $sesi->id_sesi,
            'id_batch' => $sesi->id_batch,
            'batch_name' => optional($sesi->batch)->nama_batch,
            'mata_pelajaran' => $sesi->mata_pelajaran,
            'deskripsi' => $sesi->deskripsi,
            'tanggal_mulai' => $sesi->tanggal_mulai ? date('Y-m-d', strtotime($sesi->tanggal_mulai)) : null,
            'jam_mulai' => $sesi->jam_mulai,
            'tanggal_selesai' => $sesi->tanggal_selesai ? date('Y-m-d', strtotime($sesi->tanggal_selesai)) : null,
            'jam_selesai' => $sesi->jam_selesai,
            'durasi_menit' => $sesi->durasi_menit,
            'status' => $sesi->status,
            'hide_nomor_urut' => (bool)$sesi->hide_nomor_urut,
            'hide_poin' => (bool)$sesi->hide_poin,
            'hide_mata_pelajaran' => (bool)$sesi->hide_mata_pelajaran,
        ];
        return response()->json(['success' => true, 'data' => $payload]);
    })->name('admin.sesi-ujian.show');

    Route::view('/settings/info-ujian', 'admin.settings.info-ujian.index')->name('admin.settings.info-ujian.index');
    Route::view('/settings/backup', 'admin.settings.backup.index')->name('admin.settings.backup.index');
    Route::view('/settings/logo', 'admin.settings.logo.index')->name('admin.settings.logo.index');

    // Backup API routes - Specific routes must come before parameterized routes
    Route::post('/settings/backup/create', [App\Http\Controllers\SettingController::class, 'createBackup'])->name('admin.settings.backup.create');
    Route::get('/settings/backup/list', [App\Http\Controllers\SettingController::class, 'listBackups'])->name('admin.settings.backup.list');
    Route::get('/settings/backup/download/{filename}', [App\Http\Controllers\SettingController::class, 'downloadBackup'])->name('admin.settings.backup.download');
    Route::delete('/settings/backup/delete/{filename}', [App\Http\Controllers\SettingController::class, 'deleteBackup'])->name('admin.settings.backup.delete');

    // Settings API routes - Specific routes must come before parameterized routes
    Route::get('/settings/stats', [App\Http\Controllers\SettingController::class, 'stats'])->name('admin.settings.stats');
    Route::get('/settings/data', [App\Http\Controllers\SettingController::class, 'data'])->name('admin.settings.data');
    Route::match(['get', 'post'], '/settings/api/info-ujian', [App\Http\Controllers\SettingController::class, 'infoUjian'])->name('admin.settings.api.info-ujian');
    Route::match(['get', 'post', 'put'], '/settings/api/logo', [App\Http\Controllers\SettingController::class, 'logo'])->name('admin.settings.api.logo');
    Route::post('/settings/api/logo/reset', [App\Http\Controllers\SettingController::class, 'resetLogo'])->name('admin.settings.api.logo.reset');
    Route::post('/settings', [App\Http\Controllers\SettingController::class, 'store'])->name('admin.settings.store');
    Route::get('/settings/{id}', [App\Http\Controllers\SettingController::class, 'show'])->name('admin.settings.show');
    Route::put('/settings/{id}', [App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');
    Route::delete('/settings/{id}', [App\Http\Controllers\SettingController::class, 'destroy'])->name('admin.settings.destroy');

    // Legacy redirect for /admin/exams
    Route::get('/exams', function () {
        return redirect()->route('admin.users.index');
    });


    // Debug route removed for production security
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');

    // Participant Management API Routes
    Route::get('/participants/data', [App\Http\Controllers\ParticipantController::class, 'data'])->name('admin.participants.data');
    Route::get('/participants/stats', [App\Http\Controllers\ParticipantController::class, 'stats'])->name('admin.participants.stats');
    Route::post('/participants', [App\Http\Controllers\ParticipantController::class, 'store'])->name('admin.participants.store');
    Route::get('/participants/template', [App\Http\Controllers\ParticipantController::class, 'downloadTemplate'])->name('admin.participants.template');
    Route::get('/participants/clear-test-data', [App\Http\Controllers\ParticipantController::class, 'clearTestData'])->name('admin.participants.clear-test-data');
    Route::get('/participants/{id}', [App\Http\Controllers\ParticipantController::class, 'show'])->name('admin.participants.show');
    Route::put('/participants/{id}', [App\Http\Controllers\ParticipantController::class, 'update'])->name('admin.participants.update');
    Route::delete('/participants/{id}', [App\Http\Controllers\ParticipantController::class, 'destroy'])->name('admin.participants.destroy');

    // Dashboard API Routes
    Route::get('/dashboard/data', [App\Http\Controllers\DashboardController::class, 'getStats'])->name('admin.dashboard.data');

    // Question Management API Routes
    Route::get('/questions/data', [App\Http\Controllers\QuestionController::class, 'data'])->name('admin.questions.data');
    Route::get('/questions/stats', [App\Http\Controllers\QuestionController::class, 'getStats'])->name('admin.questions.stats');
    Route::post('/questions', [App\Http\Controllers\QuestionController::class, 'store'])->name('admin.questions.store');
    Route::get('/questions/{id}', [App\Http\Controllers\QuestionController::class, 'show'])->name('admin.questions.show');
    Route::put('/questions/{id}', [App\Http\Controllers\QuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('/questions/{id}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('admin.questions.destroy');
});

// Candidate Routes (Protected)
Route::prefix('candidate')->middleware(['custom.auth'])->group(function () {
    Route::view('/dashboard', 'student.dashboard')->name('candidate.dashboard');
    Route::view('/exam', 'student.exam')->name('candidate.exam.index');
    Route::view('/profile', 'student.dashboard')->name('candidate.profile');

    // Exam API Routes for students
    Route::get('/exam/data', [App\Http\Controllers\ExamController::class, 'getExamData'])->name('candidate.exam.data');
    Route::get('/exam/available', [App\Http\Controllers\ExamController::class, 'getAvailableExams'])->name('candidate.exam.available');
    Route::post('/exam/{id}/start', [App\Http\Controllers\ExamController::class, 'startExam'])->name('candidate.exam.start');
    Route::post('/exam/{id}/submit', [App\Http\Controllers\ExamController::class, 'submitExam'])->name('candidate.exam.submit');
});

// Legacy Routes (Redirect to new structure)
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/exam', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/exam/candidate', function () {
        return redirect()->route('candidate.dashboard');
    });
    Route::get('/exam/exam', function () {
        return redirect()->route('admin.users.index');
    });
    Route::get('/exam/participants', function () {
        return redirect()->route('admin.participants.index');
    });
    Route::get('/exam/questions', function () {
        return redirect()->route('admin.questions.index');
    });
    Route::get('/exam/reports', function () {
        return redirect()->route('admin.reports.index');
    });
    Route::get('/exam/settings', function () {
        return redirect()->route('admin.settings.info-ujian.index');
    });
});

// Batch Management API Routes
Route::get('/admin/batches', [App\Http\Controllers\BatchController::class, 'getAll'])->name('admin.batches.all');
Route::post('/admin/batches', [App\Http\Controllers\BatchController::class, 'store'])->name('admin.batches.store');
Route::put('/admin/batches/{id}', [App\Http\Controllers\BatchController::class, 'update'])->name('admin.batches.update');
Route::delete('/admin/batches/{id}', [App\Http\Controllers\BatchController::class, 'destroy'])->name('admin.batches.destroy');

// Participant Batch Routes
Route::get('/admin/participants/batches', [App\Http\Controllers\ParticipantController::class, 'getBatches'])->name('admin.participants.batches');

// Question Batch Routes
Route::get('/admin/questions/batches', [App\Http\Controllers\QuestionController::class, 'getBatches'])->name('admin.questions.batches');

// Public page for participants without access
Route::get('/student/peserta-wrong', function () {
    $pesertaData = session('peserta_wrong_data', null);
    return view('students.peserta-wrong', ['pesertaData' => $pesertaData]);
})->name('student.peserta-wrong');

// API endpoint untuk mendapatkan data peserta yang ditolak login
Route::get('/student/peserta-wrong/data', function () {
    $pesertaData = session('peserta_wrong_data');

    \Log::info('Peserta-wrong data requested', [
        'session_id' => session()->getId(),
        'has_data' => !empty($pesertaData),
        'data' => $pesertaData
    ]);

    if ($pesertaData) {
        return response()->json([
            'success' => true,
            'peserta' => $pesertaData
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Data peserta tidak tersedia'
    ], 404);
})->name('student.peserta-wrong.data');

// Student Routes (Protected)
Route::prefix('student')->middleware(['custom.auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\ExamController::class, 'information'])->name('student.dashboard');
    Route::view('/exam', 'student.exam')->name('student.exam.index');
    Route::get('/information', [App\Http\Controllers\Student\ExamController::class, 'information'])->name('student.information');
    Route::get('/profile', [App\Http\Controllers\Student\ExamController::class, 'information'])->name('student.profile');

    // Exam API Routes for students
    Route::get('/exam/data', [App\Http\Controllers\Student\ExamController::class, 'index'])->name('student.exam.data');
    Route::get('/exam/available', [App\Http\Controllers\Student\ExamController::class, 'index'])->name('student.exam.available');
    Route::get('/exam/ping', function () {
        return response()->json(['status' => 'ok', 'timestamp' => now()->toIso8601String()]);
    })->name('student.exam.ping');
    Route::get('/exam/{id}/data', function ($id) {
        try {
            $sesi = App\Models\SesiUjian::with(['ujian', 'batch'])->find($id);

            if (!$sesi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi ujian tidak ditemukan',
                    'error' => 'EXAM_NOT_FOUND'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $sesi->id_sesi,
                    'mata_pelajaran' => $sesi->mata_pelajaran,
                    'deskripsi' => $sesi->deskripsi,
                    'tanggal_mulai' => $sesi->tanggal_mulai,
                    'jam_mulai' => $sesi->jam_mulai,
                    'tanggal_selesai' => $sesi->tanggal_selesai,
                    'jam_selesai' => $sesi->jam_selesai,
                    'durasi_menit' => $sesi->durasi_menit,
                    'status' => $sesi->status,
                    'batch_name' => optional($sesi->batch)->nama_batch,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat data ujian',
                'error' => $e->getMessage()
            ], 500);
        }
    })->name('student.exam.data.single');
    Route::get('/exam/{id}/start', [App\Http\Controllers\Student\ExamController::class, 'startExam'])->name('student.exam.start');
    Route::get('/exam/{id}/info', [App\Http\Controllers\Student\ExamController::class, 'showExamInfo'])->name('student.exam.info');
    Route::get('/exam/{id}/info-warning', [App\Http\Controllers\Student\ExamController::class, 'showExamInfoWarning'])->name('student.exam.info-warning');
    Route::get('/exam/{id}/warning', [App\Http\Controllers\Student\ExamController::class, 'showExamWarning'])->name('student.exam.warning');
    Route::get('/exam/{id}/show', [App\Http\Controllers\Student\ExamController::class, 'showExam'])->name('student.exam.show');
    Route::post('/exam/{id}/submit', [App\Http\Controllers\Student\ExamController::class, 'submitExam'])->name('student.exam.submit');
    Route::get('/selesai', [App\Http\Controllers\Student\ExamController::class, 'pesertaSelesai'])->name('student.selesai');
});

// Redirect candidate dashboard to student information
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/candidate/dashboard', function () {
        return redirect()->route('student.information');
    });
});
