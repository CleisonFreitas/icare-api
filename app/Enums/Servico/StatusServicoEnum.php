<?php
namespace App\Enums\Servico;

enum StatusServicoEnum: string
{
    case PENDENTE = 'PENDENTE';
    case REALIZANDO = 'REALIZANDO';
    case REALIZADO = 'REALIZADO';

    public static function toValues(): array
    {
        return array_map(fn($enum) => $enum->value, self::cases());
    }
}