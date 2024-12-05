<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComunidadesController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\RolesControllers;

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
        Route::get('/',[ ComunidadesController::class, 'getAll'])->name('getAll');
        Route::get('/{id}',[ ComunidadesController::class, 'get'])->name('get');
        Route::post('/', [ComunidadesController::class, 'post'])->name('post');
        Route::delete('/{id}', [ComunidadesController::class, 'delete'])->name('delete');
        Route::put('/{id}', [ComunidadesController::class, 'put'])->name('put');
    });

    Route::prefix('escuelas')->group(function () {
        Route::get('/',[ EscuelaController::class, 'getAll'])->name('getAll');
        Route::get('/{id}',[ EscuelaController::class, 'get'])->name('get');
        Route::post('/', [EscuelaController::class, 'post'])->name('post');
        Route::delete('/{id}', [EscuelaController::class, 'delete'])->name('delete');
        Route::put('/{id}', [EscuelaController::class, 'put'])->name('put');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/',[ RolesController::class, 'getAll'])->name('getAll');
    });
});