<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/exam', 'exam.index')->name('exam.index');
Route::view('/exam/candidate', 'exam.candidate')->name('exam.candidate');
Route::view('/exam/exam', 'exam.exam')->name('exam.exam');
Route::view('/exam/participants', 'exam.participants')->name('exam.participants');
Route::view('/exam/proctoring', 'exam.proctoring')->name('exam.proctoring');
Route::view('/exam/questions', 'exam.questions')->name('exam.questions');
Route::view('/exam/reports', 'exam.reports')->name('exam.reports');
Route::view('/exam/settings', 'exam.settings')->name('exam.settings');
