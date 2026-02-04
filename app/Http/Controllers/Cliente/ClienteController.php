<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cliente;

use App\DTOs\Cliente\ClienteDTO;
use App\DTOs\Cliente\ClienteFilterDTO;
use App\DTOs\Cliente\ClienteUpdateDTO;
use App\Http\Requests\Cliente\ClienteSearchRequest;
use App\Http\Requests\Cliente\ClienteStoreRequest;
use App\Http\Requests\Cliente\ClienteUpdateRequest;
use App\Http\Resources\Cliente\ClienteResource;
use App\Models\Cliente\Cliente;
use App\Services\Cliente\AtualizarCliente;
use App\Services\Cliente\BuscarClientes;
use App\Services\Cliente\CadastrarCliente;
use App\Services\Cliente\RemoverCliente;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly final class ClienteController
{
    public function index(ClienteSearchRequest $request, BuscarClientes $service): JsonResponse
    {
        $resposta = $service->pesquisar(ClienteFilterDTO::fromApirequest($request));
        return ClienteResource::collection($resposta)->toResponse($request);
    }

    public function store(ClienteStoreRequest $request, CadastrarCliente $service): JsonResponse
    {
        $cliente = $service->cadastrar(ClienteDTO::fromApiRequest($request));
        return response()->json($cliente, Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $cliente = Cliente::findOrFail($id)->load('endereco', 'contatos');
        return response()->json(new ClienteResource($cliente));
    }

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

    public function destroy(int $id, RemoverCliente $service): JsonResponse
    {
        $cliente = Cliente::findOrFail($id);
        $clienteRemovido = $service->delete($cliente);
        return response()->json($clienteRemovido);
    }
}
