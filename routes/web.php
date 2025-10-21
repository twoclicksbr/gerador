<?php

use App\Http\Controllers\Site\PlanController;
use App\Http\Controllers\Site\RegisterController;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');
Route::get('/check-cpf-cnpj', [RegisterController::class, 'checkCpfCnpj'])->name('check.cpfcnpj');

Route::get('/login', function () {
    return view('login');
})->name('login');
