<?php

namespace App\Docs\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PaginatedClienteResponse",
    allOf: [
        new OA\Schema(ref: "#/components/schemas/BasePaginatedResponse"),
        new OA\Schema(
            type: "object",
            properties: [
                new OA\Property(
                    property: "data",
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Cliente")
                )
            ]
        )
    ]
)]
class PaginatedClienteResponse {}