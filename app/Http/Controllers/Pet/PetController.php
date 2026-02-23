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
use OpenApi\Attributes as OA;

readonly final class PetController
{
    #[OA\Get(
        path: "/api/v1/pet",
        summary: "Listar pets com filtros e paginação",
        tags: ["Pet"],
        security: [["bearerAuth" => []]],

        parameters: [
            new OA\Parameter(name: "nome", in: "query", schema: new OA\Schema(type: "string")),
            new OA\Parameter(name: "documento", in: "query", schema: new OA\Schema(type: "string")),

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
                name: "tamanho",
                in: "query",
                schema: new OA\Schema(type: "string")
            ),

            new OA\Parameter(name: "cor", in: "query", schema: new OA\Schema(type: "string")),
            new OA\Parameter(name: "numero_microship", in: "query", schema: new OA\Schema(type: "string")),

            new OA\Parameter(
                name: "cliente.nome",
                in: "query",
                schema: new OA\Schema(type: "string")
            ),
            new OA\Parameter(
                name: "cliente.documento",
                in: "query",
                schema: new OA\Schema(type: "string")
            ),

            new OA\Parameter(
                name: "per_page",
                in: "query",
                schema: new OA\Schema(type: "integer", example: 15)
            ),

            new OA\Parameter(
                name: "page",
                in: "query",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],

        responses: [
            new OA\Response(
                response: 200,
                description: "Lista paginada de pets",
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: "#/components/schemas/PaginatedResponse"),
                        new OA\Schema(
                            properties: [
                                new OA\Property(
                                    property: "data",
                                    type: "array",
                                    items: new OA\Items(ref: "#/components/schemas/Pet")
                                )
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(response: 401, description: "Não autenticado")
        ]
    )]
    public function index(PetFilterRequest $request, BuscarPet $service): JsonResponse
    {
        $pets = $service->buscar(
            PetFilterDTO::fromApiRequest($request)
        );

        return PetResource::collection($pets)->toResponse($request);
    }

    #[OA\Post(
        path: "/api/v1/cliente/{cliente}/pet",
        summary: "Cadastrar pet para um cliente",
        description: "Cria um novo pet vinculado a um cliente existente.",
        tags: ["Pet"],
        security: [["bearerAuth" => []]],

        parameters: [
            new OA\Parameter(
                name: "cliente",
                description: "ID do cliente",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 10)
            )
        ],

        requestBody: new OA\RequestBody(
            required: true,
            description: "Dados necessários para cadastro do pet",
            content: new OA\JsonContent(
                required: [
                    "nome",
                    "documento",
                    "tamanho",
                    "cor",
                    "especie_id"
                ],
                properties: [
                    new OA\Property(
                        property: "nome",
                        type: "string",
                        maxLength: 255,
                        example: "Rex"
                    ),
                    new OA\Property(
                        property: "documento",
                        type: "string",
                        maxLength: 255,
                        example: "PET-001"
                    ),
                    new OA\Property(
                        property: "tamanho",
                        type: "string",
                        enum: ["PEQUENO", "MEDIO", "GRANDE"],
                        example: "MEDIO",
                        description: "Enum PetTamanhoEnum"
                    ),
                    new OA\Property(
                        property: "cor",
                        type: "string",
                        example: "Caramelo"
                    ),
                    new OA\Property(
                        property: "tem_microship",
                        type: "boolean",
                        nullable: true,
                        example: true,
                        description: "Indica se o pet possui microchip"
                    ),
                    new OA\Property(
                        property: "numero_microship",
                        type: "string",
                        nullable: true,
                        example: "123456789ABC",
                        description: "Obrigatório quando tem_microship = true"
                    ),
                    new OA\Property(
                        property: "especie_id",
                        type: "integer",
                        example: 2,
                        description: "ID existente na tabela especies"
                    ),
                ]
            )
        ),

        responses: [

            new OA\Response(
                response: 201,
                description: "Pet criado com sucesso",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 15),
                        new OA\Property(property: "nome", type: "string", example: "Rex"),
                        new OA\Property(property: "documento", type: "string", example: "PET-001"),
                        new OA\Property(
                            property: "tamanho",
                            type: "string",
                            enum: ["PEQUENO", "MEDIO", "GRANDE"],
                            example: "MEDIO"
                        ),
                        new OA\Property(property: "cor", type: "string", example: "Caramelo"),
                        new OA\Property(property: "tem_microship", type: "boolean", example: true),
                        new OA\Property(property: "numero_microship", type: "string", example: "123456789ABC"),
                        new OA\Property(property: "especie_id", type: "integer", example: 2),
                        new OA\Property(property: "created_at", type: "string", format: "date-time"),
                        new OA\Property(property: "updated_at", type: "string", format: "date-time"),
                    ]
                )
            ),

            new OA\Response(
                response: 401,
                description: "Não autenticado"
            ),

            new OA\Response(
                response: 404,
                description: "Cliente não encontrado"
            ),

            new OA\Response(
                response: 422,
                description: "Erro de validação"
            )
        ]
    )]
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

    #[OA\Get(
        path: "/api/v1/pet/{id}",
        summary: "Buscar pet por ID",
        description: "Retorna os dados de um pet específico.",
        tags: ["Pet"],
        security: [["bearerAuth" => []]],

        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID do pet",
                schema: new OA\Schema(type: "integer", example: 15)
            )
        ],

        responses: [
            new OA\Response(
                response: 200,
                description: "Pet encontrado com sucesso",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Pet"
                )
            ),

            new OA\Response(
                response: 401,
                description: "Não autenticado"
            ),

            new OA\Response(
                response: 404,
                description: "Pet não encontrado"
            )
        ]
    )]
    public function show(int $id): JsonResponse
    {
        $pet = Pet::findOrFail($id);

        return response()->json(new PetResource($pet));
    }

    #[OA\Put(
        path: "/api/v1/pet/{id}",
        summary: "Atualizar pet",
        description: "Atualiza os dados de um pet existente.",
        tags: ["Pet"],
        security: [["bearerAuth" => []]],

        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID do pet",
                schema: new OA\Schema(type: "integer", example: 15)
            )
        ],

        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/PetUpdateRequest"
            )
        ),

        responses: [
            new OA\Response(
                response: 200,
                description: "Pet atualizado com sucesso",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Pet"
                )
            ),

            new OA\Response(
                response: 401,
                description: "Não autenticado"
            ),

            new OA\Response(
                response: 404,
                description: "Pet não encontrado"
            ),

            new OA\Response(
                response: 422,
                description: "Erro de validação"
            )
        ]
    )]
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

    #[OA\Delete(
        path: "/api/v1/pet/{id}",
        summary: "Remover pet",
        description: "Remove um pet existente.",
        tags: ["Pet"],
        security: [["bearerAuth" => []]],

        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID do pet",
                schema: new OA\Schema(type: "integer", example: 15)
            )
        ],

        responses: [
            new OA\Response(
                response: 200,
                description: "Pet removido com sucesso",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Pet"
                )
            ),

            new OA\Response(
                response: 401,
                description: "Não autenticado"
            ),

            new OA\Response(
                response: 404,
                description: "Pet não encontrado"
            )
        ]
    )]
    public function destroy(int $id, RemoverPet $service): JsonResponse
    {
        $pet = Pet::findOrFail($id);
        $petRemovido = $service->remover($pet);

        return response()->json(new PetResource($petRemovido));
    }
}
