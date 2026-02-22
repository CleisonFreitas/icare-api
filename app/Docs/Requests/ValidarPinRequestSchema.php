<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ValidarPinRequest",
    required: ["email", "pin"],
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
            description: "PIN de 4 dígitos enviado por email",
            example: "1234"
        )
    ]
)]
class ValidarPinRequestSchema {}