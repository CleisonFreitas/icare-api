<?php

namespace App\Models\Cliente;

use App\Enums\Pet\PetTamanhoEnum;
use App\ModelFilters\Pet\PetFilter;
use App\Models\Servico\Solicitacao;
use App\Traits\Orderable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes, Orderable, Filterable;

    protected $table = 'pets';

    protected $fillable = [
        'nome',
        'documento',
        'tamanho',
        'cor',
        'ativo',
        'data_nascimento',
        'tem_microship',
        'numero_microship',
        'cliente_id',
        'especie_id'
    ];

    protected $casts = [
        'tamanho' => PetTamanhoEnum::class
    ];

    public function modelFilter(): string
    {
        return $this->provideFilter(PetFilter::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function especie(): HasOne
    {
        return $this->hasOne(Especie::class);
    }

    public function solicitacoes(): HasMany
    {
        return $this->hasMany(Solicitacao::class);
    }
}
