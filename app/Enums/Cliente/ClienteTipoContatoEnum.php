<?php

namespace App\Enums\Cliente;

enum ClienteTipoContatoEnum: string
{
    case TELEFONE = 'TELEFONE';
    case EMAIL = 'EMAIL';

    public function descricao(): string
    {
        return match($this) {
            self::TELEFONE => 'Telefone',
            self::EMAIL => 'Email'
        };
    }

    public static function toValues(): array
    {
        return array_map(fn($enum) => $enum->value, self::cases());
    }
}
