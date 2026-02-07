<?php

declare(strict_types=1);

namespace App\Http\Controllers\Servico;

use App\DTOs\Servico\ServicoDTO;
use App\DTOs\Servico\ServicoFilterDTO;
use App\Http\Requests\Servico\ServicoFilterRequest;
use App\Http\Requests\Servico\ServicoStoreRequest;
use App\Http\Requests\Servico\ServicoUpdateRequest;
use App\Http\Resources\Servico\ServicoResource;
use App\Models\Servico\Servico;
use App\Services\Servico\AtualizarServico;
use App\Services\Servico\BuscarServicos;
use App\Services\Servico\CadastrarServico;
use App\Services\Servico\RemoverServico;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly final class ServicoController
{
    public function index(ServicoFilterRequest $request, BuscarServicos $service): JsonResponse
    {
        $servicos = $service->buscar(ServicoFilterDTO::fromApiRequest($request));

        return ServicoResource::collection($servicos)->toResponse($request);
    }

    public function store(ServicoStoreRequest $request, CadastrarServico $service): JsonResponse
    {
        $servico = $service->cadastrar(ServicoDTO::fromApiRequest($request));

        return response()->json(new ServicoResource($servico), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $servico = Servico::findOrFail($id)->load(['pet', 'consulta']);

        return response()->json(new ServicoResource($servico));
    }

    public function update(int $id, ServicoUpdateRequest $request, AtualizarServico $service): JsonResponse
    {
        $servico = Servico::findOrFail($id);
        $servicoAtualizado = $service->atualizar(ServicoDTO::fromApiRequest($request), $servico);

        return response()->json(new ServicoResource($servicoAtualizado));
    }

    public function destroy(int $id, RemoverServico $service): JsonResponse
    {
        $servico = Servico::findOrFail($id);
        $servicoRemovido = $service->remover($servico);

        return response()->json(new ServicoResource($servicoRemovido));
    }
}
