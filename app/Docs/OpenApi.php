<?php

namespace App\Docs;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Task Manager API",
    version: "1.0.0",
    description: "API para gerenciamento de tarefas"
)]
#[OA\Server(
    url: "http://localhost:8081",
    description: "Servidor principal"
)]
class OpenApi
{
    #[OA\Get(
        path: "/health",
        summary: "Health check",
        tags: ["System"],
        responses: [
            new OA\Response(
                response: 200,
                description: "API funcionando"
            )
        ]
    )]
    public function health() {}
}
