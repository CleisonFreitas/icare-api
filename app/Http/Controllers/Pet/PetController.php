<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pet;

use App\DTOs\Pet\PetDTO;
use App\DTOs\Pet\PetFilterDTO;
use App\DTOs\Pet\PetUpdateDTO;
use App\Http\Requests\Pet\PetFilterRequest;
use App\Http\Requests\Pet\PetStoreRequest;
use App\Http\Requests\Pet\PetUpdateRequest;
use App\Http\Resources\Pet\PetResource;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Pet;
use App\Services\Pet\AtualizarPet;
use App\Services\Pet\BuscarPet;
use App\Services\Pet\CadastrarPet;
use App\Services\Pet\RemoverPet;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly final class PetController
{
    public function index(PetFilterRequest $request, BuscarPet $service): JsonResponse
    {
        $pets = $service->buscar(
            PetFilterDTO::fromApiRequest($request)
        );

        return PetResource::collection($pets)->toResponse($request);
    }

    public function store(
        PetStoreRequest $request,
        CadastrarPet $service,
        Cliente $cliente,
    ): JsonResponse {
        $pet = $service->cadastrar(
            dto: PetDTO::fromApiRequest($request),
            cliente: $cliente
        );

        return response()->json(new PetResource($pet), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $pet = Pet::findOrFail($id);

        return response()->json(new PetResource($pet));
    }

    public function update(
        PetUpdateRequest $request,
        AtualizarPet $service,
        int $id
    ): JsonResponse {
        $pet = Pet::findOrFail($id);

        $petAtualizado = $service->atualizar(
            dto: PetUpdateDTO::fromApiRequest($request),
            pet: $pet
        );

        return response()->json(new PetResource($petAtualizado));
    }

    public function destroy(int $id, RemoverPet $service): JsonResponse
    {
        $pet = Pet::findOrFail($id);
        $petRemovido = $service->remover($pet);

        return response()->json(new PetResource($petRemovido));
    }
}
