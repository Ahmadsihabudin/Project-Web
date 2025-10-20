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
    Route::get('/profile', [App\Http\Controllers\Student\ExamController::class, 'information'])->name('student.profile');

    // Exam API Routes for students
    Route::get('/exam/data', [App\Http\Controllers\Student\ExamController::class, 'index'])->name('student.exam.data');
    Route::get('/exam/available', [App\Http\Controllers\Student\ExamController::class, 'index'])->name('student.exam.available');
    Route::get('/exam/{id}/info', [App\Http\Controllers\Student\ExamController::class, 'showExamInfo'])->name('student.exam.info');
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
