<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exam', function () {
    return view('exam.index');
});

Route::get('/exam/candidate', function () {
    return view('exam.candidate');
});

Route::get('exam/exam', function () {
    return view('exam.exam');
});

Route::get('exam/participants', function () {
    return view('exam.participants');
});

Route::get('exam/proctoring', function () {
    return view('exam.proctoring');
});

Route::get('exam/questions', function () {
    return view('exam.questions');
});

Route::get('exam/reports', function () {
    return view('exam.reports');
});

Route::get('exam/settings', function () {
    return view('exam.settings');
});


/*Route::view('/exam', 'exam.index')->name('exam.index');
Route::view('/exam/candidate', 'exam.candidate')->name('exam.candidate');
Route::view('/exam/exam', 'exam.exam')->name('exam.exam');
Route::view('/exam/participants', 'exam.participants')->name('exam.participants');
Route::view('/exam/proctoring', 'exam.proctoring')->name('exam.proctoring');
Route::view('/exam/questions', 'exam.questions')->name('exam.questions');
Route::view('/exam/reports', 'exam.reports')->name('exam.reports');
Route::view('/exam/settings', 'exam.settings')->name('exam.settings');
*/ 