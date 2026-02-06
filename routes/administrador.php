<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Pet\PetController;
use App\Http\Controllers\Servico\EstoqueController;
use App\Http\Controllers\Servico\VacinaController;
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

    $router->get('estoque', [EstoqueController::class, 'index']);
    $router->post('estoque', [EstoqueController::class, 'store']);
    $router->get('estoque/{id}', [EstoqueController::class, 'show']);
    $router->put('estoque/{id}', [EstoqueController::class, 'update']);
    $router->delete('estoque/{id}', [EstoqueController::class, 'destroy']);

    $router->get('vacina', [VacinaController::class, 'index']);
    $router->post('vacina', [VacinaController::class, 'store']);
    $router->get('vacina/{id}', [VacinaController::class, 'show']);
    $router->put('vacina/{id}', [VacinaController::class, 'update']);
    $router->delete('vacina/{id}', [VacinaController::class, 'destroy']);
});