<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use APP\Http\Controllers\API\ComunidadesController;
use APP\Http\Controllers\API\EscuelasController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::prefix('users')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
        Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');    
    });
    
    Route::prefix('comunidades')->group(function () {
        Route::get('/',[ ComunidadesController::class, 'getAll'])->name('comunidades.getAll');
        Route::get('/{id}',[ ComunidadesController::class, 'get'])->name('comunidades.get');
        Route::post('/', [ComunidadesController::class, 'post'])->name('comunidades.post');
        Route::delete('/{id}', [ComunidadesController::class, 'delete'])->name('comunidades.delete');
        Route::put('/{id}', [ComunidadesController::class, 'put'])->name('comunidades.put');
    });

    Route::prefix('escuelas')->group(function () {
        Route::get('/',[ EscuelasController::class, 'getAll'])->name('escuelas.getAll');
        Route::get('/{id}',[ EscuelasController::class, 'get'])->name('escuelas.get');
        Route::post('/', [EscuelasController::class, 'post'])->name('escuelas.post');
        Route::delete('/{id}', [EscuelasController::class, 'delete'])->name('escuelas.delete');
        Route::put('/{id}', [EscuelasController::class, 'put'])->name('escuelas.put');
        Route::get('/{comunidad}',[ EscuelasController::class, 'escuelas.getByComunidad']);
    });

});