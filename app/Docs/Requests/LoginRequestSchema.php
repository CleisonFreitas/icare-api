<?php

namespace App\Docs\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "LoginRequest",
    required: ["email", "senha"],
    properties: [
        new OA\Property(property: "email", type: "string", format: "email", example: "admin@email.com"),
        new OA\Property(property: "senha", type: "string", format: "password", example: "123456")
    ],
    type: "object"
)]
class LoginRequestSchema {}