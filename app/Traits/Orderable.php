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

        foreach ($ordenacoes as $ordem) {
            $coluna = data_get($ordem, 'coluna');
            $valor = data_get($ordem, 'ordem');

            if ($coluna == null || $valor == null) {
                continue;
            }

            $query->orderBy($coluna, $valor);
        }

        return $query;
    }
}
