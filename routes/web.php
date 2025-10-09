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
    return view('exam.reports');
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

    return view('exam.reports');
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
    Route::view('/dashboard', 'exam.admin-dashboard')->name('admin.dashboard');
    Route::view('/users', 'exam.users')->name('admin.users.index');
    Route::view('/questions', 'exam.questions')->name('admin.questions.index');
    Route::view('/participants', 'exam.participants')->name('admin.participants.index');
    Route::view('/reports', 'exam.reports')->name('admin.reports.index');
    Route::view('/settings', 'exam.settings')->name('admin.settings.index');

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
});

// Candidate Routes (Protected)
Route::prefix('candidate')->middleware(['custom.auth'])->group(function () {
    Route::view('/dashboard', 'exam.candidate')->name('candidate.dashboard');
    Route::view('/exam', 'exam.student-exam')->name('candidate.exam.index');
    Route::view('/profile', 'exam.candidate')->name('candidate.profile');

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
