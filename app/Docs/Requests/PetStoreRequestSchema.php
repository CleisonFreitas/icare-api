<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PetStoreRequest",
    type: "object",
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
            description: "ID da espécie cadastrada"
        ),
    ]
)]
class PetStoreRequestSchema {}
