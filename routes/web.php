<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SecureAuthController;

Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::post('/admin/login', [SecureAuthController::class, 'adminLogin'])->name('auth.admin.login');
    Route::post('/peserta/login', [SecureAuthController::class, 'pesertaLogin'])->name('auth.peserta.login');
    Route::post('/logout', [SecureAuthController::class, 'logout'])->name('auth.logout');
});

// Define login route for auth middleware
Route::get('/login', function () {
    return redirect('/');
})->name('login');

// Exam Routes (Protected)
Route::middleware(['custom.auth'])->group(function () {
    Route::view('/exam', 'exam.admin-dashboard')->name('exam.index');
    Route::view('/exam/candidate', 'exam.candidate-new')->name('exam.candidate');
    Route::view('/exam/exam', 'exam.exam')->name('exam.exam');
    Route::view('/exam/participants', 'exam.participants')->name('exam.participants');
    Route::view('/exam/proctoring', 'exam.proctoring')->name('exam.proctoring');
    Route::view('/exam/questions', 'exam.questions')->name('exam.questions');
    Route::view('/exam/reports', 'exam.reports')->name('exam.reports');
    Route::view('/exam/settings', 'exam.settings')->name('exam.settings');
});
