<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PaginatedResponse",
    type: "object",
    properties: [

        new OA\Property(property: "current_page", type: "integer", example: 1),

        new OA\Property(property: "data", type: "array", items: new OA\Items()),

        new OA\Property(property: "first_page_url", type: "string", example: "http://api.test/api/v1/administrador/pet?page=1"),

        new OA\Property(property: "from", type: "integer", nullable: true, example: 1),

        new OA\Property(property: "last_page", type: "integer", example: 10),

        new OA\Property(property: "last_page_url", type: "string"),

        new OA\Property(property: "links", type: "array", items: new OA\Items(
            type: "object",
            properties: [
                new OA\Property(property: "url", type: "string", nullable: true),
                new OA\Property(property: "label", type: "string"),
                new OA\Property(property: "active", type: "boolean"),
            ]
        )),

        new OA\Property(property: "next_page_url", type: "string", nullable: true),

        new OA\Property(property: "path", type: "string"),

        new OA\Property(property: "per_page", type: "integer", example: 15),

        new OA\Property(property: "prev_page_url", type: "string", nullable: true),

        new OA\Property(property: "to", type: "integer", nullable: true, example: 15),

        new OA\Property(property: "total", type: "integer", example: 150),
    ]
)]
class PaginatedResponseSchema {}
