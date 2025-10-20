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

// Temporary debug route without auth
Route::get('/debug/users', function () {
    return response()->json([
        'users_count' => App\Models\User::count(),
        'users' => App\Models\User::all(['id', 'nama', 'email', 'role']),
        'session_data' => session()->all()
    ]);
});

// Debug session route
Route::get('/debug/session', function () {
    return response()->json([
        'session' => session()->all(),
        'user_type' => session('user_type'),
        'user_id' => session('user_id'),
        'user_name' => session('user_name'),
        'user_email' => session('user_email'),
        'session_id' => session()->getId(),
        'session_status' => session()->status()
    ]);
});

// Debug reports route
Route::get('/debug/reports', function () {
    return view('admin.reports.index');
});


// Debug reports with session simulation
Route::get('/debug/reports-staff', function () {
    // Simulate staff session
    session([
        'user_id' => 2,
        'user_type' => 'staff',
        'user_name' => 'Staff Test',
        'user_email' => 'staff@test.com',
    ]);

    return view('admin.reports.index');
});

// Debug participants API
Route::get('/debug/participants', function () {
    $controller = new App\Http\Controllers\ParticipantController();
    return $controller->index();
});

// Debug dashboard API
Route::get('/debug/dashboard', function () {
    $controller = new App\Http\Controllers\DashboardController();
    return $controller->getStats();
});

// Debug login test
Route::post('/debug/login-test', function (Request $request) {
    $user = App\Models\User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Simulate login
        session([
            'user_id' => $user->id,
            'user_type' => $user->role,
            'user_name' => $user->nama,
            'user_email' => $user->email,
        ]);

        return response()->json([
            'success' => true,
            'user' => $user,
            'session' => session()->all()
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid credentials']);
});


// Test login and redirect to reports
Route::post('/debug/login-staff', function (Request $request) {
    $user = App\Models\User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Simulate login
        session([
            'user_id' => $user->id,
            'user_type' => $user->role,
            'user_name' => $user->nama,
            'user_email' => $user->email,
        ]);

        return redirect('/admin/reports');
    }

    return response()->json(['success' => false, 'message' => 'Invalid credentials']);
});


// Admin Routes (Protected)
Route::prefix('admin')->middleware(['custom.auth'])->group(function () {
    // Redirect /admin to /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/users', 'admin.users.index')->name('admin.users.index');
    Route::view('/users/create', 'admin.users.create')->name('admin.users.create');
    Route::view('/users/{id}/edit', 'admin.users.edit')->name('admin.users.edit');

    Route::view('/questions', 'admin.questions.index')->name('admin.questions.index');
    Route::view('/questions/create', 'admin.questions.create')->name('admin.questions.create');
    Route::view('/questions/{id}/edit', 'admin.questions.edit')->name('admin.questions.edit');
    Route::get('/questions/import/template', function () {
        return response()->download(public_path('sample_import_peserta.csv'));
    })->name('admin.questions.import.template');
    Route::post('/questions/import', function () {
        return redirect()->back()->with('success', 'Import berhasil');
    })->name('admin.questions.import');

    Route::view('/participants', 'admin.participants.index')->name('admin.participants.index');
    Route::view('/participants/create', 'admin.participants.create')->name('admin.participants.create');
    Route::view('/participants/{id}/edit', 'admin.participants.edit')->name('admin.participants.edit');
    Route::get('/participants/import/template', function () {
        return response()->download(public_path('sample_import_peserta.csv'));
    })->name('admin.participants.import.template');
    Route::post('/participants/import', function () {
        return redirect()->back()->with('success', 'Import berhasil');
    })->name('admin.participants.import');

    Route::view('/reports', 'admin.reports.index')->name('admin.reports.index');
    Route::view('/reports/create', 'admin.reports.create')->name('admin.reports.create');
    Route::view('/reports/{id}/edit', 'admin.reports.edit')->name('admin.reports.edit');

    // Sesi Ujian (Admin)
    Route::view('/sesi-ujian', 'admin.sesi-ujian.index')->name('admin.sesi-ujian.index');
    Route::view('/sesi-ujian/create', 'admin.sesi-ujian.create')->name('admin.sesi-ujian.create');
    Route::view('/sesi-ujian/{id}/edit', 'admin.sesi-ujian.edit')->name('admin.sesi-ujian.edit');
    // Sesi Ujian API (dummy handlers for now)
    Route::get('/sesi-ujian/stats', function () {
        $total = App\Models\SesiUjian::count();
        $aktif = App\Models\SesiUjian::where('status', 'aktif')->count();
        $selesai = App\Models\SesiUjian::where('status', 'selesai')->count();
        return response()->json([
            'success' => true,
            'data' => compact('total', 'aktif', 'selesai'),
        ]);
    })->name('admin.sesi-ujian.stats');
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
    Route::put('/sesi-ujian/{id}', function ($id, Request $request) {
        try {
            $sesiUjian = App\Models\SesiUjian::findOrFail($id);

            // Parse datetime-local input
            $tanggalMulai = $request->tanggal_mulai;
            $tanggalSelesai = $request->tanggal_selesai;

            // Split datetime-local into date and time parts
            $tanggalMulaiParts = explode('T', $tanggalMulai);
            $tanggalSelesaiParts = explode('T', $tanggalSelesai);

            $sesiUjian->update([
                'id_batch' => $request->id_batch,
                'mata_pelajaran' => $request->mata_pelajaran,
                'deskripsi' => $request->deskripsi,
                'tanggal_mulai' => $tanggalMulaiParts[0], // YYYY-MM-DD
                'jam_mulai' => $tanggalMulaiParts[1] . ':00', // HH:MM:SS
                'tanggal_selesai' => $tanggalSelesaiParts[0], // YYYY-MM-DD
                'jam_selesai' => $tanggalSelesaiParts[1] . ':00', // HH:MM:SS
                'durasi_menit' => $request->durasi_menit,
                'status' => 'aktif'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sesi ujian berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui sesi ujian: ' . $e->getMessage()
            ], 500);
        }
    })->name('admin.sesi-ujian.update');

    Route::delete('/sesi-ujian/{id}', function ($id) {
        return response()->json([
            'success' => true,
        ]);
    })->name('admin.sesi-ujian.destroy');

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
            'tanggal_mulai' => $sesi->tanggal_mulai ? $sesi->tanggal_mulai->format('Y-m-d') : null,
            'jam_mulai' => $sesi->jam_mulai,
            'tanggal_selesai' => $sesi->tanggal_selesai ? $sesi->tanggal_selesai->format('Y-m-d') : null,
            'jam_selesai' => $sesi->jam_selesai,
            'durasi_menit' => $sesi->durasi_menit,
            'status' => $sesi->status,
        ];
        return response()->json(['success' => true, 'data' => $payload]);
    })->name('admin.sesi-ujian.show');

    Route::view('/settings', 'admin.settings.index')->name('admin.settings.index');
    Route::view('/settings/create', 'admin.settings.create')->name('admin.settings.create');
    Route::view('/settings/{id}/edit', 'admin.settings.edit')->name('admin.settings.edit');

    // Settings API routes
    Route::get('/settings/stats', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'total' => 0,
                'active' => 0,
                'encrypted' => 0,
                'public' => 0
            ]
        ]);
    })->name('admin.settings.stats');

    Route::get('/settings/data', function () {
        return response()->json([
            'success' => true,
            'data' => []
        ]);
    })->name('admin.settings.data');

    // Legacy redirect for /admin/exams
    Route::get('/exams', function () {
        return redirect()->route('admin.users.index');
    });

    // User Management API Routes
    Route::get('/users/data', [App\Http\Controllers\UserController::class, 'data'])->name('admin.users.data');

    // Debug route
    Route::get('/users/debug', function () {
        return response()->json([
            'session' => session()->all(),
            'users_count' => App\Models\User::count(),
            'users' => App\Models\User::all(['id', 'nama', 'email', 'role'])
        ]);
    });
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');

    // Participant Management API Routes
    Route::get('/participants/data', [App\Http\Controllers\ParticipantController::class, 'data'])->name('admin.participants.data');
    Route::post('/participants', [App\Http\Controllers\ParticipantController::class, 'store'])->name('admin.participants.store');
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
        return redirect()->route('admin.settings.index');
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

// Student Routes (Protected)
Route::prefix('student')->middleware(['custom.auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\ExamController::class, 'information'])->name('student.dashboard');
    Route::view('/exam', 'student.exam')->name('student.exam.index');
    Route::get('/information', [App\Http\Controllers\Student\ExamController::class, 'information'])->name('student.information');
    Route::get('/peserta-wrong', function () {
        return view('students.peserta-wrong');
    })->name('student.peserta-wrong');
    Route::get('/profile', [App\Http\Controllers\Student\ExamController::class, 'information'])->name('student.profile');

    // Exam API Routes for students
    Route::get('/exam/data', [App\Http\Controllers\Student\ExamController::class, 'index'])->name('student.exam.data');
    Route::get('/exam/available', [App\Http\Controllers\Student\ExamController::class, 'index'])->name('student.exam.available');
    Route::get('/exam/{id}/data', function ($id) {
        $sesi = App\Models\SesiUjian::with(['ujian', 'batch'])->findOrFail($id);
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
    })->name('student.exam.data.single');
    Route::get('/exam/{id}/info', [App\Http\Controllers\Student\ExamController::class, 'showExamInfo'])->name('student.exam.info');
    Route::get('/exam/{id}/info-warning', function ($id) {
        return view('students.exam-info-warning', ['examId' => $id]);
    })->name('student.exam.info-warning');
    Route::get('/exam/{id}/questions-composition', function ($id) {
        try {
            // Get session info first
            $sesi = \App\Models\SesiUjian::find($id);
            if (!$sesi || !$sesi->batch) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi ujian tidak ditemukan'
                ], 404);
            }

            // Get soal data for this batch
            $soal = \App\Models\Soal::where('batch', $sesi->batch->nama_batch)->get();

            // Count by type
            $pilihanGanda = $soal->where('tipe_soal', 'pilihan_ganda')->count();
            $essay = $soal->where('tipe_soal', 'essay')->count();
            $trueFalse = $soal->where('tipe_soal', 'true_false')->count();
            $total = $soal->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'pilihan_ganda' => $pilihanGanda,
                    'essay' => $essay,
                    'true_false' => $trueFalse,
                    'total' => $total
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat komposisi soal: ' . $e->getMessage()
            ], 500);
        }
    })->name('student.exam.questions-composition');
    Route::get('/exam/{id}/warning', [App\Http\Controllers\Student\ExamController::class, 'showExamWarning'])->name('student.exam.warning');
    Route::get('/exam/{id}', [App\Http\Controllers\Student\ExamController::class, 'showExam'])->name('student.exam.show');
    Route::post('/exam/{id}/submit', [App\Http\Controllers\Student\ExamController::class, 'submitExam'])->name('student.exam.submit');
});

// Redirect candidate dashboard to student information
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/candidate/dashboard', function () {
        return redirect()->route('student.information');
    });
});
