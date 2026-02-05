<?php
namespace App\Enums\Pet;

enum PetTamanhoEnum: string
{
    case PEQUENO = 'PEQUENO';
    case MEDIO = 'MEDIO';
    case GRANDE = 'GRANDE';

    public function descricao(): string
    {
        return match($this) {
            self::PEQUENO => 'Pequeno',
            self::MEDIO => 'Médio',
            self::GRANDE => 'Grande'
        };
    }

    public static function toValues(): array
    {
        return array_map(fn($enum) => $enum->value, self::cases());
    }
}