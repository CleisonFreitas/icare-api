<?php

declare(strict_types=1);

namespace App\Http\Controllers\Servico;

use App\DTOs\Servico\VacinaDTO;
use App\DTOs\Servico\VacinaFilterDTO;
use App\Http\Requests\Servico\VacinaFilterRequest;
use App\Http\Requests\Servico\VacinaStoreRequest;
use App\Http\Requests\Servico\VacinaUpdateRequest;
use App\Http\Resources\Servico\VacinaResource;
use App\Models\Servico\Vacina;
use App\Services\Servico\AtualizarVacina;
use App\Services\Servico\BuscarVacinas;
use App\Services\Servico\CadastrarVacina;
use App\Services\Servico\RemoverVacina;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly final class VacinaController
{
    public function index(VacinaFilterRequest $request, BuscarVacinas $service): JsonResponse
    {
        $vacinas = $service->buscar(
            VacinaFilterDTO::fromApiRequest($request)
        );

        return VacinaResource::collection($vacinas)->toResponse($request);
    }

    public function store(VacinaStoreRequest $request, CadastrarVacina $service): JsonResponse
    {
        $vacina = $service->cadastrar(
            VacinaDTO::fromApiRequest($request)
        );

        return response()->json(new VacinaResource($vacina), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $vacina = Vacina::findOrFail($id)->load('estoques');

        return response()->json(new VacinaResource($vacina));
    }

    public function update(
        int $id,
        VacinaUpdateRequest $request,
        AtualizarVacina $service
    ): JsonResponse {
        $vacina = Vacina::findOrFail($id);
        $vacinaAtualizada = $service->atualizar(
            VacinaDTO::fromApiRequest($request),
            $vacina
        );

        return response()->json(new VacinaResource($vacinaAtualizada));
    }

    public function destroy(int $id, RemoverVacina $service): JsonResponse
    {
        $vacina = Vacina::findOrFail($id);
        $vacinaRemovida = $service->remover($vacina);

        return response()->json(new VacinaResource($vacinaRemovida));
    }
}
