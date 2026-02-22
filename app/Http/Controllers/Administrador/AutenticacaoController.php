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
use OpenApi\Attributes as OA;

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

    #[OA\Post(
        path: "/api/v1/administrador/login",
        summary: "Login do administrador",
        tags: ["Autenticação"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/LoginRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Login realizado com sucesso",
                content: new OA\JsonContent(ref: "#/components/schemas/LoginResponse")
            ),
            new OA\Response(
                response: 403,
                description: "Credenciais inválidas"
            ),
            new OA\Response(
                response: 422,
                description: "Erro de validação",
                content: new OA\JsonContent(ref: "#/components/schemas/ValidationError")
            )
        ]
    )]
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $payload = $this->loginService->execute($data);
        return response()->json($payload);
    }

    #[OA\Post(
        path: "/api/v1/administrador/logout",
        summary: "Logout do administrador",
        description: "Remove o token atual do usuário autenticado",
        tags: ["Autenticação"],
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Logout realizado com sucesso",
                content: new OA\JsonContent(ref: "#/components/schemas/LogoutResponse")
            ),
            new OA\Response(
                response: 403,
                description: "Usuário não autenticado ou token inválido"
            )
        ]
    )]
    public function logout(Request $request): JsonResponse
    {
        $authDados = $this->logoutService->execute($request);
        return response()->json($authDados->toArray());
    }

    #[OA\Get(
        path: "/api/v1/administrador/me",
        summary: "Retorna os dados do administrador autenticado",
        description: "Valida o token atual e retorna os dados do usuário autenticado",
        tags: ["Autenticação"],
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Usuário autenticado com sucesso",
                content: new OA\JsonContent(ref: "#/components/schemas/LoginResponse")
            ),
            new OA\Response(
                response: 401,
                description: "Não autenticado, token inválido ou expirado"
            )
        ]
    )]
    public function me(Request $request): JsonResponse
    {
        $payload = $this->meService->execute($request);
        return response()->json($payload);
    }

    #[OA\Post(
        path: "/api/v1/administrador/gerar-pin",
        summary: "Gera PIN para recuperação de senha",
        description: "Gera um código PIN de 4 dígitos e envia por email para o usuário",
        tags: ["Autenticação"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/GerarPinRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "PIN gerado e enviado com sucesso"
            ),
            new OA\Response(
                response: 400,
                description: "Email não encontrado",
                content: new OA\JsonContent(ref: "#/components/schemas/BadRequestError")
            ),
            new OA\Response(
                response: 422,
                description: "Erro de validação",
                content: new OA\JsonContent(ref: "#/components/schemas/ValidationError")
            )
        ]
    )]
    public function gerarPin(GerarPinRequest $request): JsonResponse
    {
        $email = $request->validated()['email'];
        $this->gerarPinService->execute($email);
        return response()->json();
    }

    #[OA\Post(
        path: "/api/v1/administrador/validar-pin",
        summary: "Valida PIN de recuperação de senha",
        description: "Valida se o PIN informado é válido e não expirou",
        tags: ["Autenticação"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/ValidarPinRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "PIN válido",
                content: new OA\JsonContent(ref: "#/components/schemas/PinValidadoResponse")
            ),
            new OA\Response(
                response: 400,
                description: "PIN inválido ou expirado",
                content: new OA\JsonContent(ref: "#/components/schemas/BadRequestError")
            ),
            new OA\Response(
                response: 422,
                description: "Erro de validação",
                content: new OA\JsonContent(ref: "#/components/schemas/ValidationError")
            )
        ]
    )]
    public function validarPin(ValidarPinRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->validarPinService->execute($data['email'], $data['pin']);
        return response()->json(['message' => 'PIN válido.']);
    }

    #[OA\Post(
        path: "/api/v1/administrador/alterar-senha",
        summary: "Altera a senha do usuário usando PIN",
        description: "Valida o PIN e altera a senha do usuário",
        tags: ["Autenticação"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/AlterarSenhaRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Senha alterada com sucesso",
                content: new OA\JsonContent(ref: "#/components/schemas/SenhaAlteradaSchema")
            ),
            new OA\Response(
                response: 400,
                description: "PIN inválido",
                content: new OA\JsonContent(ref: "#/components/schemas/BadRequestError")
            ),
            new OA\Response(
                response: 404,
                description: "Usuário não encontrado"
            ),
            new OA\Response(
                response: 422,
                description: "Erro de validação",
                content: new OA\JsonContent(ref: "#/components/schemas/ValidationError")
            )
        ]
    )]
    public function alterarSenha(AlterarSenhaRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->alterarSenhaService->execute($data['email'], $data['pin'], $data['senha']);
        return response()->json(['message' => 'Senha alterada com sucesso.']);
    }
}
