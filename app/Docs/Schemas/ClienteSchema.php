<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Cliente",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 10),
        new OA\Property(property: "nome", type: "string", example: "João Silva"),
        new OA\Property(property: "email", type: "string", format: "email", example: "joao@email.com"),
        new OA\Property(property: "documento", type: "string", example: "12345678900"),
        new OA\Property(property: "data_nascimento", type: "string", format: "date", nullable: true, example: "1990-01-01"),

        new OA\Property(
            property: "endereco",
            ref: "#/components/schemas/Endereco",
            nullable: true
        ),

        new OA\Property(
            property: "contatos",
            type: "array",
            nullable: true,
            items: new OA\Items(ref: "#/components/schemas/ContatoResponse")
        ),
    ]
)]
class ClienteSchema {}