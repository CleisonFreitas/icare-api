<?php

declare(strict_types=1);

namespace App\DTOs\Usuario;

use App\DTOs\BaseDTO;
use App\Models\Usuario\Usuario;

readonly class UsuarioAuthDTO extends BaseDTO
{
    public function __construct(
        private ?Usuario $usuario,
        private ?string $token
    ) {}

    public function getUsuario(): ?UsuarioDTO
    {
        return new UsuarioDTO(
            id: $this->usuario?->id,
            nome: $this->usuario?->nome,
            email: $this->usuario?->email,
        );
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}