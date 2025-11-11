<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::redirect('/', '/auth-academic');
Route::get('/', [HomeController::class, 'index'],)
    ->name('home')
    ->middleware('auth');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/auth-academic', function () {
    return view('auth-academic.login');
})->name('auth-academic');