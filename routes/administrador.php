<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Pet\PetController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:administrador')->group(function ($router) {
    $router->get('cliente', [ClienteController::class, 'index']);
    $router->post('cliente', [ClienteController::class, 'store']);
    $router->get('cliente/{id}', [ClienteController::class, 'show']);
    $router->put('cliente/{id}', [ClienteController::class, 'update']);
    $router->delete('cliente/{id}', [ClienteController::class, 'destroy']);

    $router->get('pet', [PetController::class, 'index']);
    $router->post('cliente/{cliente}/pet', [PetController::class, 'store']);
    $router->get('pet/{id}', [PetController::class, 'show']);
    $router->put('pet/{id}', [PetController::class, 'update']);
    $router->delete('pet/{id}', [PetController::class, 'destroy']);
});