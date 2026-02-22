<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Contato",
    type: "object",
    required: ["tipo", "valor"],
    properties: [
        new OA\Property(property: "tipo", type: "string", example: "telefone"),
        new OA\Property(property: "valor", type: "string", example: "(11)99999-9999"),
    ]
)]
class ContatoSchema {}