<?php

namespace App\Docs;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Icare Pet API",
    version: "1.0.0",
    description: "API para gerenciamento de clínicas de pet shop"
)]
#[OA\Server(
    url: "http://localhost:8081",
    description: "Servidor principal"
)]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT"
)]
class OpenApi {}
