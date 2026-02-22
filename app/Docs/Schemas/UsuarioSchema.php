<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Usuario",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "nome", type: "string", example: "Administrador"),
        new OA\Property(property: "email", type: "string", example: "admin@email.com"),
    ]
)]
class UsuarioSchema {}