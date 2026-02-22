<?php

namespace App\Docs\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "LoginResponse",
    type: "object",
    properties: [
        new OA\Property(
            property: "usuario",
            ref: "#/components/schemas/Usuario"
        ),
        new OA\Property(
            property: "token",
            type: "string",
            example: "1|asdhjkasdhjkashdkjashdkjashdk"
        )
    ]
)]
class LoginResponseSchema {}