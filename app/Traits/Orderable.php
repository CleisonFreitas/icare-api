<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Orderable
{
    public function scopeOrder(Builder $query, array $ordenacoes): Builder
    {
        if (empty($ordenacoes)) {
            return $query;
        }

        $coluna = $ordenacoes['key'];
        $valor = $ordenacoes['direction'];
        return $query->orderBy($coluna, $valor);
    }
}
