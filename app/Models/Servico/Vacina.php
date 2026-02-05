<?php

namespace App\Models\Servico;

use App\Models\Usuario\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacina extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vacinas';

    protected $fillable = [
        'pet_id',
        'nome',
        'data_administrada',
        'aplicado_por',
        'lote',
        'fabricante',
        'dosagem',
        'servico_id',
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'aplicado_por');
    }

    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }
}
