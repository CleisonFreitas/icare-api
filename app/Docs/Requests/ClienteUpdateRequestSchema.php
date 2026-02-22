<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ClienteUpdateRequest",
    type: "object",
    required: ["nome", "email", "documento"],
    properties: [
        new OA\Property(property: "nome", type: "string", example: "João Atualizado"),
        new OA\Property(property: "email", type: "string", format: "email", example: "joao@email.com"),
        new OA\Property(property: "documento", type: "string", example: "12345678900"),
    ]
)]
class ClienteUpdateRequestSchema {}