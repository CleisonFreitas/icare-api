<?php

namespace App\Docs\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PaginatedResponse ",
    type: "object",
    properties: [
        new OA\Property(
            property: "links",
            type: "object",
            properties: [
                new OA\Property(property: "first", type: "string", nullable: true),
                new OA\Property(property: "last", type: "string", nullable: true),
                new OA\Property(property: "prev", type: "string", nullable: true),
                new OA\Property(property: "next", type: "string", nullable: true),
            ]
        ),
        new OA\Property(
            property: "meta",
            type: "object",
            properties: [
                new OA\Property(property: "current_page", type: "integer"),
                new OA\Property(property: "from", type: "integer", nullable: true),
                new OA\Property(property: "last_page", type: "integer"),
                new OA\Property(property: "path", type: "string"),
                new OA\Property(property: "per_page", type: "integer"),
                new OA\Property(property: "to", type: "integer", nullable: true),
                new OA\Property(property: "total", type: "integer"),
            ]
        )
    ]
)]
class PaginatedResponse  {}