<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrador\LoginRequest;
use App\Http\Requests\Administrador\GerarPinRequest;
use App\Http\Requests\Administrador\ValidarPinRequest;
use App\Http\Requests\Administrador\AlterarSenhaRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Administrador\LoginService;
use App\Services\Administrador\LogoutService;
use App\Services\Administrador\MeService;
use App\Services\Administrador\GerarPinService;
use App\Services\Administrador\ValidarPinService;
use App\Services\Administrador\AlterarSenhaService;

class AutenticacaoController extends Controller
{
    public function __construct(
        private readonly LoginService $loginService,
        private readonly LogoutService $logoutService,
        private readonly MeService $meService,
        private readonly GerarPinService $gerarPinService,
        private readonly ValidarPinService $validarPinService,
        private readonly AlterarSenhaService $alterarSenhaService
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $payload = $this->loginService->execute($data);
        return response()->json($payload);
    }

    public function logout(Request $request): JsonResponse
    {
        $authDados = $this->logoutService->execute($request);
        return response()->json($authDados->toArray());
    }

    public function me(Request $request): JsonResponse
    {
        $payload = $this->meService->execute($request);
        return response()->json($payload);
    }

    public function gerarPin(GerarPinRequest $request): JsonResponse
    {
        $email = $request->validated()['email'];
        $this->gerarPinService->execute($email);
        return response()->json();
    }

    public function validarPin(ValidarPinRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->validarPinService->execute($data['email'], $data['pin']);
        return response()->json(['message' => 'PIN válido.']);
    }

    public function alterarSenha(AlterarSenhaRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->alterarSenhaService->execute($data['email'], $data['pin'], $data['senha']);
        return response()->json(['message' => 'Senha alterada com sucesso.']);
    }
}
