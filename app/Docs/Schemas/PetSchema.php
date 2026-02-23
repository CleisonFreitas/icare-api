<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Pet",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 15),
        new OA\Property(property: "nome", type: "string", example: "Rex"),
        new OA\Property(property: "documento", type: "string", example: "PET-001"),
        new OA\Property(property: "cor", type: "string", example: "Caramelo"),
        new OA\Property(
            property: "tamanho",
            type: "string",
            enum: ["PEQUENO", "MEDIO", "GRANDE"],
            example: "MEDIO"
        ),
        new OA\Property(
            property: "numero_microship",
            type: "string",
            nullable: true,
            example: "123456789ABC"
        ),
        new OA\Property(
            property: "created_at",
            type: "string",
            format: "date-time",
            example: "2026-02-22T10:30:00Z"
        ),
        new OA\Property(
            property: "updated_at",
            type: "string",
            format: "date-time",
            example: "2026-02-22T10:30:00Z"
        ),
    ]
)]
class PetSchema {}