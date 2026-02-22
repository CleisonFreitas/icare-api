<?php

namespace App\Docs\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "LogoutResponse",
    type: "object",
    properties: [
        new OA\Property(
            property: "usuario",
            ref: "#/components/schemas/Usuario"
        ),
        new OA\Property(
            property: "token",
            type: "string",
            nullable: true,
            example: "admin-token"
        )
    ]
)]
class LogoutResponseSchema {}