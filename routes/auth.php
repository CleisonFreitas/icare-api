<?php

use App\Http\Controllers\Administrador\AutenticacaoController;
use Illuminate\Support\Facades\Route;

Route::prefix('administrador')->group(function () {
    Route::post('login', [AutenticacaoController::class, 'login']);
    Route::post('gerar-pin', [AutenticacaoController::class, 'gerarPin']);
    Route::post('validar-pin', [AutenticacaoController::class, 'validarPin']);
    Route::post('alterar-senha', [AutenticacaoController::class, 'alterarSenha']);

    Route::middleware('auth:administrador')->group(function ($router) {
        $router->get('me', [AutenticacaoController::class, 'me']);
        $router->post('logout', [AutenticacaoController::class, 'logout']);
    });
});
