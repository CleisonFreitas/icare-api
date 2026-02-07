<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrador\LoginRequest;
use App\Http\Requests\Administrador\GerarPinRequest;
use App\Http\Requests\Administrador\ValidarPinRequest;
use App\Http\Requests\Administrador\AlterarSenhaRequest;
use App\Mail\PinRecuperacaoMail;
use App\Models\Usuario\Usuario;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Administrador\LoginService;
use App\Services\Administrador\LogoutService;
use App\Services\Administrador\MeService;
use App\Services\Administrador\GerarPinService;
use App\Services\Administrador\ValidarPinService;
use App\Services\Administrador\AlterarSenhaService;

class AutenticacaoController extends Controller
{
    private LoginService $loginService;
    private LogoutService $logoutService;
    private MeService $meService;
    private GerarPinService $gerarPinService;
    private ValidarPinService $validarPinService;
    private AlterarSenhaService $alterarSenhaService;

    public function __construct(
        LoginService $loginService,
        LogoutService $logoutService,
        MeService $meService,
        GerarPinService $gerarPinService,
        ValidarPinService $validarPinService,
        AlterarSenhaService $alterarSenhaService
    ) {
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
        $this->meService = $meService;
        $this->gerarPinService = $gerarPinService;
        $this->validarPinService = $validarPinService;
        $this->alterarSenhaService = $alterarSenhaService;
    }
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $payload = $this->loginService->execute($data);
            return response()->json($payload);
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $this->logoutService->execute($request);
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }

    public function me(Request $request)
    {
        try {
            $payload = $this->meService->execute($request);
            return response()->json($payload);
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: Response::HTTP_UNAUTHORIZED);
        }
    }

    public function gerarPin(GerarPinRequest $request): JsonResponse
    {
        $email = $request->validated()['email'];
        $this->gerarPinService->execute($email);
        return response()->json(['message' => 'Se o e-mail existir, um PIN foi enviado.']);
    }

    public function validarPin(ValidarPinRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $this->validarPinService->execute($data['email'], $data['pin']);
            return response()->json(['message' => 'PIN válido.']);
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: Response::HTTP_BAD_REQUEST);
        }
    }

    public function alterarSenha(AlterarSenhaRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $this->alterarSenhaService->execute($data['email'], $data['pin'], $data['senha']);
            return response()->json(['message' => 'Senha alterada com sucesso.']);
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: Response::HTTP_BAD_REQUEST);
        }
    }
}
