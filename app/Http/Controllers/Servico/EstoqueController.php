<?php

declare(strict_types=1);

namespace App\Http\Controllers\Servico;

use App\DTOs\Servico\EstoqueDTO;
use App\DTOs\Servico\EstoqueFilterDTO;
use App\Http\Requests\Servico\EstoqueFilterRequest;
use App\Http\Requests\Servico\EstoqueStoreRequest;
use App\Http\Requests\Servico\EstoqueUpdateRequest;
use App\Http\Resources\Servico\EstoqueResource;
use App\Models\Servico\Estoque;
use App\Services\Servico\AtualizarEstoque;
use App\Services\Servico\BuscarEstoques;
use App\Services\Servico\CadastrarEstoque;
use App\Services\Servico\RemoverEstoque;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly final class EstoqueController
{
    public function index(EstoqueFilterRequest $request, BuscarEstoques $service): JsonResponse
    {
        $estoques = $service->buscar(
            EstoqueFilterDTO::fromApiRequest($request)
        );

        return EstoqueResource::collection($estoques)
            ->toResponse($request);
    }

    public function store(EstoqueStoreRequest $request, CadastrarEstoque $service): JsonResponse
    {
        $estoque = $service->cadastrar(
            EstoqueDTO::fromApiRequest($request)
        );

        return response()->json(new EstoqueResource($estoque), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $estoque = Estoque::findOrFail($id)->load('vacinas');

        return response()->json(new EstoqueResource($estoque));
    }

    public function update(
        int $id,
        EstoqueUpdateRequest $request,
        AtualizarEstoque $service
    ): JsonResponse {
        $estoque = Estoque::findOrFail($id);
        $estoqueAtualizado = $service->atualizar(
            EstoqueDTO::fromApiRequest($request),
            $estoque
        );

        return response()->json(new EstoqueResource($estoqueAtualizado));
    }

    public function destroy(int $id, RemoverEstoque $service): JsonResponse
    {
        $estoque = Estoque::findOrFail($id);
        $estoqueRemovido = $service->remover($estoque);

        return response()->json(new EstoqueResource($estoqueRemovido));
    }
}
