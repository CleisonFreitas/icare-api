<?php

namespace App\Docs\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PinValidadoResponse",
    type: "object",
    properties: [
        new OA\Property(
            property: "message",
            type: "string",
            example: "PIN válido."
        )
    ]
)]
class PinValidadoResponseSchema {}