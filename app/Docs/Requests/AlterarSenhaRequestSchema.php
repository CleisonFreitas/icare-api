<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AlterarSenhaRequest",
    required: ["email", "pin", "senha", "senha_confirmation"],
    type: "object",
    properties: [
        new OA\Property(
            property: "email",
            type: "string",
            format: "email",
            example: "admin@email.com"
        ),
        new OA\Property(
            property: "pin",
            type: "string",
            description: "PIN enviado por email",
            example: "123456"
        ),
        new OA\Property(
            property: "senha",
            type: "string",
            format: "password",
            minLength: 6,
            example: "novasenha123"
        ),
        new OA\Property(
            property: "senha_confirmation",
            type: "string",
            format: "password",
            example: "novasenha123"
        )
    ]
)]
class AlterarSenhaRequestSchema {}