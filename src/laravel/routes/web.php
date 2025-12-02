<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\StudentAssessmentController;
use App\Http\Controllers\CorrectQuestionsController;
use App\Http\Controllers\RecordAssessmentsController;
use App\Http\Controllers\Auth\LoginAcademicController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::redirect('/', '/auth-academic');

// Página de login acadêmico (view)
Route::get('/auth-academic', function () {
    return view('auth-academic.login-academic');
})->name('auth-academic');

// Login acadêmico (POST)
Route::post('/auth-academic', [LoginAcademicController::class, 'login'])
    ->name('auth-academic.login');

// Dashboard (pós-login)
Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

// Route::resource('record-assessments', RecordAssessmentsController::class);
Route::resource('record-assessments', RecordAssessmentsController::class)
    ->middleware('auth');

  Route::get('results', [ResultsController::class, 'index'])
    ->middleware('auth');
    
  Route::get('correct-questions', [CorrectQuestionsController::class, 'index'])
    ->middleware('auth');

Auth::routes();

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


// Agendamentos do aluno
Route::prefix('scheduling')->middleware('auth')->group(function () {

    Route::get('/', [SchedulingController::class, 'index'])
        ->name('scheduling.index');


    Route::get('/create/{assessment}', [SchedulingController::class, 'create'])
        ->name('scheduling.create');

    Route::post('/store', [SchedulingController::class, 'store'])
        ->name('scheduling.store');
});

// Módulo de Avaliações para Alunos
Route::prefix('student/assessments')->middleware('auth')->name('student.assessments.')->group(function () {
    Route::get('/', [StudentAssessmentController::class, 'index'])->name('index');
    Route::get('/schedule/{assessment}', [StudentAssessmentController::class, 'schedule'])->name('schedule');
    Route::post('/store', [StudentAssessmentController::class, 'store'])->name('store');
    Route::delete('/cancel/{scheduling}', [StudentAssessmentController::class, 'cancel'])->name('cancel');
});
