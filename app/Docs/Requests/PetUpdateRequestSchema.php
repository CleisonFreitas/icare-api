<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PetUpdateRequest",
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
            example: "PET-002"
        ),
        new OA\Property(
            property: "tamanho",
            type: "string",
            enum: ["PEQUENO", "MEDIO", "GRANDE"],
            example: "GRANDE"
        ),
        new OA\Property(
            property: "cor",
            type: "string",
            example: "Preto"
        ),
        new OA\Property(
            property: "ativo",
            type: "boolean",
            nullable: true,
            example: true,
            description: "Indica se o pet está ativo"
        ),
        new OA\Property(
            property: "tem_microship",
            type: "boolean",
            nullable: true,
            example: true
        ),
        new OA\Property(
            property: "numero_microship",
            type: "string",
            nullable: true,
            example: "ABC123456"
        ),
        new OA\Property(
            property: "especie_id",
            type: "integer",
            example: 2
        ),
    ]
)]
class PetUpdateRequestSchema {}
