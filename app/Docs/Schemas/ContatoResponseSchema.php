<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ContatoResponse",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "tipo", type: "string", example: "telefone"),
        new OA\Property(property: "valor", type: "string", example: "(11)99999-9999"),
    ]
)]
class ContatoResponseSchema {}