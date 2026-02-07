<?php

declare(strict_types=1);

namespace App\Http\Controllers\Servico;

use App\DTOs\Servico\ConsultaDTO;
use App\DTOs\Servico\ConsultaFilterDTO;
use App\Http\Requests\Servico\ConsultaFilterRequest;
use App\Http\Requests\Servico\ConsultaStoreRequest;
use App\Http\Requests\Servico\ConsultaUpdateRequest;
use App\Http\Resources\Servico\ConsultaResource;
use App\Models\Servico\Consulta;
use App\Services\Servico\AtualizarConsulta;
use App\Services\Servico\BuscarConsultas;
use App\Services\Servico\CadastrarConsulta;
use App\Services\Servico\RemoverConsulta;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly final class ConsultaController
{
    public function index(ConsultaFilterRequest $request, BuscarConsultas $service): JsonResponse
    {
        $consultas = $service->buscar(ConsultaFilterDTO::fromApiRequest($request));

        return ConsultaResource::collection($consultas)->toResponse($request);
    }

    public function store(ConsultaStoreRequest $request, CadastrarConsulta $service): JsonResponse
    {
        $consulta = $service->cadastrar(ConsultaDTO::fromApiRequest($request));

        return response()->json(new ConsultaResource($consulta), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $consulta = Consulta::findOrFail($id)->load(['pet', 'servicos']);

        return response()->json(new ConsultaResource($consulta));
    }

    public function update(int $id, ConsultaUpdateRequest $request, AtualizarConsulta $service): JsonResponse
    {
        $consulta = Consulta::findOrFail($id);
        $consultaAtualizada = $service->atualizar(ConsultaDTO::fromApiRequest($request), $consulta);

        return response()->json(new ConsultaResource($consultaAtualizada));
    }

    public function destroy(int $id, RemoverConsulta $service): JsonResponse
    {
        $consulta = Consulta::findOrFail($id);
        $consultaRemovida = $service->remover($consulta);

        return response()->json(new ConsultaResource($consultaRemovida));
    }
}
