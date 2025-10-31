<?php

use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\Site\PlanController;
use App\Http\Controllers\Site\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/plans', [PlanController::class, 'index'])->name('plans');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/register/confirm-email', [RegisterController::class, 'confirmEmail'])->name('register.confirm');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register/confirm-email', [RegisterController::class, 'confirmEmail'])->name('register.confirm');
Route::post('/emails/confirm', [RegisterController::class, 'verifyEmail'])->name('confirm.email');

Route::get('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');
Route::get('/check-cpf-cnpj', [RegisterController::class, 'checkCpfCnpj'])->name('check.cpfcnpj');
