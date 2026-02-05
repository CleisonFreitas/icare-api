<?php

namespace App\Models\Servico;

use App\Enums\Servico\StatusConsultaEnum;
use App\ModelFilters\Servico\ConsultaFilter;
use App\Models\Cliente\Pet;
use App\Traits\Orderable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulta extends Model
{
    use HasFactory, SoftDeletes, Orderable, Filterable;

    protected $table = 'consultas';

    protected $fillable = [
        'titulo',
        'descricao',
        'data_prevista',
        'data_realizada',
        'status',
        'pet_id',
        'solicitacao_id'
    ];

    public function solicitacao(): HasOne
    {
        return $this->hasOne(Solicitacao::class);
    }

    public function modelFilter(): string
    {
        return $this->provideFilter(ConsultaFilter::class);
    }

    protected $casts = [
        'status' => StatusConsultaEnum::class
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function servicos(): HasMany
    {
        return $this->hasMany(Servico::class);
    }
}
