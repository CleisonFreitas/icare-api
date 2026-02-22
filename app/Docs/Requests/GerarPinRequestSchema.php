<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "GerarPinRequest",
    required: ["email"],
    type: "object",
    properties: [
        new OA\Property(
            property: "email",
            type: "string",
            format: "email",
            example: "admin@email.com"
        )
    ]
)]
class GerarPinRequestSchema {}