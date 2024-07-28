<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\AuthorizedController;
use App\Http\Controllers\API\ProductosController;
use App\Http\Controllers\API\CategoriaController;

    Route::post('upload', [FileController::class, 'upload'])->middleware([
        'auth:api', 'scopes:basic-user,client-admin'
    ]);

    Route::get('retrieve/{id}/', [FileController::class, 'retrieve'])->middleware([
        'auth:api', 'scopes:basic-user,client-admin'
    ]);

    Route::post('eliminate', [FileController::class, 'delete'])->middleware([
        'auth:api', 'scopes:basic-user,client-admin'
    ]);

    Route::post('located', [FileController::class, 'file_located'])->middleware([
        'auth:api', 'scopes:basic-user,client-admin'
    ]);

    Route::apiResource('/producto', ProductosController::class)
        ->middleware(['auth:api', 'scopes:basic-user,client-admin']);

    Route::apiResource('/categorias', CategoriaController::class)
        ->middleware(['auth:api', 'scopes:basic-user,client-admin']);

    Route::get('categorias-list', [CategoriaController::class, 'list'])
        ->middleware(['auth:api', 'scopes:basic-user,client-admin']);

    Route::get('productos-list', [ProductosController::class, 'list'])
        ->middleware(['auth:api', 'scopes:basic-user,client-admin']);

    Route::get('precios/{id}/', [ProductosController::class, 'precios'])
        ->middleware(['auth:api', 'scopes:basic-user,client-admin']);

    require __DIR__ . '/api-authentication.php';