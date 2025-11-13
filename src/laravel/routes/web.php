<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
