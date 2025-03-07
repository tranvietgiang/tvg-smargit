<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/**
 * layout main
 */
Route::get('/ds', [LoginController::class, 'listUser'])->name('listUser');

/**
 * Check vai trò để login
 */
Route::get('/role/{page}', [LoginController::class, 'index'])
    ->where('page', 'login|register|forgot')
    ->name('index');

/**
 * group các handler login lại
 */
Route::prefix('/login')->group(function () {
    Route::post('/check', [LoginController::class, 'login'])->name('check');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/delete/{id}', [LoginController::class, 'destroy'])->name('destroy');
    Route::post('/forgot', [LoginController::class, 'forgot'])->name('forgot');
    Route::get('/forgot_form', [LoginController::class, 'forgot_form'])->name('forgot_form');
    Route::get('/update_pw', [LoginController::class, 'update_pw'])->name('update_pw');
});