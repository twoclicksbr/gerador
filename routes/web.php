<?php

use Illuminate\Support\Str;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\Site\PlanController;
use App\Http\Controllers\Site\RegisterController;
use Illuminate\Http\Request;
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

Route::prefix('admin')->middleware(['verify.web', 'only.master.front'])->group(function () {

    Route::get('/overview', function () {
        return view('admin.overview');
    })->name('admin.overview');

    Route::get('/{module}', function (Request $request, $module) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->index($request, $module);
    })->name('admin.module.index');

    Route::get('/{module}/create', function (Request $request, $module) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->create($request, $module);
    })->name('admin.module.create');

    Route::post('/{module}', function (Request $request, $module) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->store($request, $module);
    })->name('admin.module.store');

    Route::get('/{module}/{id}/edit', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->edit($request, $module, $id);
    })->name('admin.module.edit');

    Route::put('/{module}/{id}', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->update($request, $module, $id);
    })->name('admin.module.update');

    Route::delete('/{module}/{id}', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->destroy($request, $module, $id);
    })->name('admin.module.destroy');

    Route::post('/{module}/{id}/restore', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->restore($request, $module, $id);
    })->name('admin.module.restore');
});


Route::prefix('panel')->middleware(['verify.web'])->group(function () {

    Route::get('/overview', function () {
        return view('panel.overview');
    })->name('panel.overview');

    Route::get('/{module}', function (Request $request, $module) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->index($request, $module);
    })->name('panel.module.index');

    Route::get('/{module}/create', function (Request $request, $module) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->create($request, $module);
    })->name('panel.module.create');

    Route::post('/{module}', function (Request $request, $module) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->store($request, $module);
    })->name('panel.module.store');

    Route::get('/{module}/{id}/edit', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->edit($request, $module, $id);
    })->name('panel.module.edit');

    Route::put('/{module}/{id}', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->update($request, $module, $id);
    })->name('panel.module.update');

    Route::delete('/{module}/{id}', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->destroy($request, $module, $id);
    })->name('panel.module.destroy');

    Route::post('/{module}/{id}/restore', function (Request $request, $module, $id) {
        $controller = 'App\\Http\\Controllers\\Front\\' . Str::studly($module) . 'Controller';
        if (!class_exists($controller)) abort(404);
        return app($controller)->restore($request, $module, $id);
    })->name('panel.module.restore');
});
