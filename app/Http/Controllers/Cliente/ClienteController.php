<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cliente;

use App\DTOs\Cliente\ClienteDTO;
use App\DTOs\Cliente\ClienteFilterDTO;
use App\DTOs\Cliente\ClienteUpdateDTO;
use App\Http\Requests\Cliente\ClienteSearchRequest;
use App\Http\Requests\Cliente\ClienteStoreRequest;
use App\Http\Requests\Cliente\ClienteUpdateRequest;
use App\Http\Requests\Cliente\ContatoRequest;
use App\Http\Requests\Cliente\EnderecoRequest;
use App\Http\Resources\Cliente\ClienteResource;
use App\Models\Cliente\Cliente;
use App\Services\Cliente\AtualizarCliente;
use App\Services\Cliente\AtualizarContatosDoCliente;
use App\Services\Cliente\AtualizarEnderecoDoCliente;
use App\Services\Cliente\BuscarClientes;
use App\Services\Cliente\CadastrarCliente;
use App\Services\Cliente\RemoverCliente;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

readonly final class ClienteController
{
    #[OA\Get(
        path: "/api/v1/cliente",
        summary: "Lista clientes com filtros e paginação",
        tags: ["Cliente"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "nome", in: "query", schema: new OA\Schema(type: "string")),
            new OA\Parameter(name: "documento", in: "query", schema: new OA\Schema(type: "string")),
            new OA\Parameter(name: "email", in: "query", schema: new OA\Schema(type: "string")),
            new OA\Parameter(
                name: "data_nascimento[inicio]",
                in: "query",
                schema: new OA\Schema(type: "string", format: "date")
            ),
            new OA\Parameter(
                name: "data_nascimento[fim]",
                in: "query",
                schema: new OA\Schema(type: "string", format: "date")
            ),
            new OA\Parameter(
                name: "limite",
                in: "query",
                schema: new OA\Schema(type: "integer", example: 15)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Lista paginada de clientes",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/BasePaginatedResponse"
                )
            ),
            new OA\Response(response: 401, description: "Não autenticado")
        ]
    )]
    public function index(ClienteSearchRequest $request, BuscarClientes $service): JsonResponse
    {
        $resposta = $service->pesquisar(ClienteFilterDTO::fromApiRequest($request));
        return ClienteResource::collection($resposta)->toResponse($request);
    }

    #[OA\Post(
        path: "/api/v1/cliente",
        summary: "Cadastrar novo cliente",
        tags: ["Cliente"],
        security: [["bearerAuth" => []]],

        requestBody: new OA\RequestBody(
            required: true,
            description: "Dados para criação do cliente",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ClienteStoreRequest"
            )
        ),

        responses: [
            new OA\Response(
                response: 201,
                description: "Cliente criado com sucesso",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Cliente"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Erro de validação"
            ),
            new OA\Response(
                response: 401,
                description: "Não autenticado"
            )
        ]
    )]
    public function store(ClienteStoreRequest $request, CadastrarCliente $service): JsonResponse
    {
        $cliente = $service->cadastrar(ClienteDTO::fromApiRequest($request));
        return response()->json($cliente, Response::HTTP_CREATED);
    }

    #[OA\Get(
        path: "/api/v1/cliente/{id}",
        summary: "Busca cliente por ID",
        tags: ["Cliente"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Cliente encontrado",
                content: new OA\JsonContent(ref: "#/components/schemas/Cliente")
            ),
            new OA\Response(response: 404, description: "Cliente não encontrado"),
            new OA\Response(response: 401, description: "Não autenticado")
        ]
    )]
    public function show(int $id): JsonResponse
    {
        $cliente = Cliente::findOrFail($id)->load('endereco', 'contatos');
        return response()->json(new ClienteResource($cliente));
    }

    #[OA\Put(
        path: "/api/v1/cliente/{id}",
        summary: "Atualizar cliente",
        tags: ["Cliente"],
        security: [["bearerAuth" => []]],

        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer"),
                description: "ID do cliente"
            )
        ],

        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/ClienteUpdateRequest"
            )
        ),

        responses: [
            new OA\Response(
                response: 200,
                description: "Cliente atualizado com sucesso",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Cliente"
                )
            ),
            new OA\Response(response: 404, description: "Cliente não encontrado"),
            new OA\Response(response: 422, description: "Erro de validação"),
            new OA\Response(response: 401, description: "Não autenticado")
        ]
    )]
    public function update(
        ClienteUpdateRequest $request,
        AtualizarCliente $service,
        int $id
    ): JsonResponse {
        $cliente = Cliente::findOrFail($id);
        $clienteAtualizado = $service->atualizar(
            ClienteUpdateDTO::fromApiRequest($request),
            $cliente
        );
        return response()->json(new ClienteResource($clienteAtualizado));
    }

    #[OA\Delete(
        path: "/api/v1/cliente/{id}",
        summary: "Remover cliente",
        tags: ["Cliente"],
        security: [["bearerAuth" => []]],

        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],

        responses: [
            new OA\Response(
                response: 204,
                description: "Cliente removido com sucesso"
            ),
            new OA\Response(response: 404, description: "Cliente não encontrado"),
            new OA\Response(response: 401, description: "Não autenticado")
        ]
    )]
    public function destroy(int $id, RemoverCliente $service): JsonResponse
    {
        $cliente = Cliente::findOrFail($id);
        $clienteRemovido = $service->delete($cliente);
        return response()->json($clienteRemovido);
    }

    public function atualizarEndereco(
        Cliente $cliente,
        EnderecoRequest $request,
        AtualizarEnderecoDoCliente $servico
    ): JsonResponse {
        return response()->json(
            $servico->atualizar($cliente, $request->validated())
        );
    }

    public function atualizarContatos(
        Cliente $cliente,
        ContatoRequest $request,
        AtualizarContatosDoCliente $servico
    ): JsonResponse {
        return response()->json(
            $servico->atualizarContatos($cliente, $request->validated())
        );
    }
}