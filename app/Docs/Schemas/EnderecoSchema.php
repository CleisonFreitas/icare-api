<?php

namespace App\Docs\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Endereco",
    type: "object",
    required: ["cep", "logradouro", "numero", "bairro", "cidade", "pais"],
    properties: [
        new OA\Property(property: "cep", type: "string", example: "01001000"),
        new OA\Property(property: "logradouro", type: "string", example: "Rua das Flores"),
        new OA\Property(property: "numero", type: "integer", example: 123),
        new OA\Property(property: "complemento", type: "string", nullable: true, example: "Apto 12"),
        new OA\Property(property: "bairro", type: "string", example: "Centro"),
        new OA\Property(property: "cidade", type: "string", example: "São Paulo"),
        new OA\Property(property: "pais", type: "string", example: "Brasil"),
    ]
)]
class EnderecoSchema {}