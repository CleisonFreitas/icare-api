<?php

namespace App\Docs\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BadRequestError",
    type: "object",
    properties: [
        new OA\Property(
            property: "message",
            type: "string",
            example: "Email informado não foi encontrado!"
        )
    ]
)]
class BadRequestSchema {}