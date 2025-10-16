<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UniversalApiController;

// ============================================================
// ROTAS UNIVERSAIS — DETECTA O MÓDULO DIRETO DA URL
// ============================================================

Route::prefix('{module}')->name('api.')->group(function () {

    // LISTAGEM / VISUALIZAÇÃO
    Route::get('/', [UniversalApiController::class, 'index'])->name('index');
    Route::get('/show/{id_module}', [UniversalApiController::class, 'show'])->name('show');
    Route::get('/deleted/{id_module}', [UniversalApiController::class, 'deleted'])->name('deleted');

    // CRIAÇÃO
    Route::get('/create', [UniversalApiController::class, 'create'])->name('create');
    Route::post('/', [UniversalApiController::class, 'store'])->name('store');

    // EDIÇÃO / ATUALIZAÇÃO
    Route::get('/edit/{id_module}', [UniversalApiController::class, 'edit'])->name('edit');
    Route::put('/{id_module}', [UniversalApiController::class, 'update'])->name('update');

    // EXCLUSÃO / RESTAURAÇÃO
    Route::delete('/{id_module}', [UniversalApiController::class, 'destroy'])->name('destroy');
    Route::post('/restore/{id_module}', [UniversalApiController::class, 'restore'])->name('restore');
    Route::delete('/force/{id_module}', [UniversalApiController::class, 'destroyForce'])->name('destroy_force');
});

// ============================================================
// 🔚 API FALLBACK — handles unknown or invalid API routes
// ============================================================
Route::fallback(function () {
    return response()->json([
        'code'    => 404,
        'status'  => 'error',
        'message' => 'API route not found or HTTP method not allowed.',
        'hint'    => 'Check the URL path or HTTP verb (GET, POST, PUT, DELETE).',
        'about'   => 'Powered by ' . config('app.url'),
    ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
});
