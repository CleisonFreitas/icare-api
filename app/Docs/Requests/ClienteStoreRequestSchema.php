<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ClienteStoreRequest",
    type: "object",
    required: ["nome", "email", "documento", "endereco"],
    properties: [
        new OA\Property(property: "nome", type: "string", maxLength: 255, example: "João Silva"),
        new OA\Property(property: "email", type: "string", format: "email", example: "joao@email.com"),
        new OA\Property(property: "documento", type: "string", maxLength: 11, example: "12345678900"),
        new OA\Property(property: "data_nascimento", type: "string", format: "date", nullable: true, example: "1990-01-01"),
        new OA\Property(
            property: "endereco",
            ref: "#/components/schemas/Endereco"
        ),
        new OA\Property(
            property: "contatos",
            type: "array",
            nullable: true,
            items: new OA\Items(ref: "#/components/schemas/Contato")
        )
    ]
)]
class ClienteStoreRequestSchema {}