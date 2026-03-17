<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Contato",
    type: "object",
    required: ["nome", "tipo", "valor"],
    properties: [
        new OA\Property(property: "nome", type: "string", example: "João da Silva"),
        new OA\Property(property: "tipo", type: "string", example: "TELEFONE"),
        new OA\Property(property: "valor", type: "string", example: "(11)99999-9999"),
        new OA\Property(property: "preferencial", type: "boolean", example: true),
    ]
)]
class ContatoSchema {}