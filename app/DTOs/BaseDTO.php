<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Support\Str;
use JsonSerializable;
use ReflectionClass;

abstract readonly class BaseDTO implements JsonSerializable
{
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();

        $dados = [];

        foreach ($properties as $property) {

            $nome = $property->getName();

            $valor = $property->getValue($this);
            $dados[Str::snake($nome)] = $valor;
        }

        return $dados;
    }

    public function jsonSerialize(): array
    {
        $reflection = new ReflectionClass($this);

        return collect($reflection->getProperties())

            ->filter(fn($prop) => $prop->isInitialized($this))

            ->mapWithKeys(function ($prop) {

                $nome = Str::snake($prop->getName());
                $valor = $prop->getValue($this);

                return [$nome => $valor];
            })->toArray();
    }
}
