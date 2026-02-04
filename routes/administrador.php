<?php

use App\Http\Controllers\Cliente\ClienteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:administrador')->group(function ($router) {
    $router->get('cliente', [ClienteController::class, 'index']);
    $router->post('cliente', [ClienteController::class, 'store']);
    $router->get('cliente/{id}', [ClienteController::class, 'show']);
    $router->put('cliente/{id}', [ClienteController::class, 'update']);
    $router->delete('cliente/{id}', [ClienteController::class, 'destroy']);
});