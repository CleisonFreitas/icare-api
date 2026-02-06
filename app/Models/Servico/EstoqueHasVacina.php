<?php

namespace App\Models\Servico;

use Illuminate\Database\Eloquent\Model;

class EstoqueHasVacina extends Model
{
    protected $table = 'estoque_has_vacinas';

    protected $fillable = [
        'estoque_id',
        'vacina_id',
        'quantidade',
        'lote'
    ];
}
