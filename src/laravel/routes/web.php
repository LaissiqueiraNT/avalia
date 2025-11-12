<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginAcademicController;


Route::redirect('/', '/auth-academic');

Route::get('/', [HomeController::class, 'index'],)
    ->name('home')
    ->middleware('auth');

Route::get('/auth-academic', function () {
    return view('auth-academic.login');
})->name('auth-academic');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/auth-academic', [LoginAcademicController::class, 'login'])->name('auth-academic.login');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

