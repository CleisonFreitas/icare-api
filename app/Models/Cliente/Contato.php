<?php

namespace App\Models\Cliente;

use App\Enums\Cliente\ClienteTipoContatoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contatos';

    protected $fillable = [
        'nome',
        'tipo',
        'valor',
        'preferencial'
    ];

    protected $casts = [
        'tipo' => ClienteTipoContatoEnum::class,
        'preferencial' => 'boolean',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
