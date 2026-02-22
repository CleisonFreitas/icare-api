<?php

namespace App\Docs\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "SenhaAlteradaSchema",
    type: "object",
    properties: [
        new OA\Property(
            property: "message",
            type: "string",
            example: "Senha alterada com sucesso."
        )
    ]
)]
class SenhaAlteradaSchema {}