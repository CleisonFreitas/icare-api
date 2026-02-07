<?php

namespace App\Enums\Servico;

enum StatusConsultaEnum: string
{
    case PENDENTE = 'PENDENTE';
    case CONCLUIDO = 'CONCLUIDO';

    public static function toValues(): array
    {
        return array_map(fn($enum) => $enum->value, self::cases());
    }
}
