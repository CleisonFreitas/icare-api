<?php

declare(strict_types=1);

namespace App\DTOs\Usuario;

class UsuarioDTO
{
    public function __construct(
        private readonly ?int $id,
        private readonly ?string $nome,
        private readonly ?string $email
    ) {}
}