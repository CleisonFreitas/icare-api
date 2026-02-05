<?php

namespace App\Models\Servico;

use App\Enums\Servico\StatusSolicitacaoEnum;
use App\ModelFilters\Servico\SolicitacaoFilter;
use App\Models\Cliente\Pet;
use App\Traits\Orderable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitacao extends Model
{
    use HasFactory, SoftDeletes, Orderable, Filterable;

    protected $table = 'solicitacoes';

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'pet_id'
    ];

    protected $casts = [
        'status' => StatusSolicitacaoEnum::class
    ];

    public function modelFilter(): string
    {
        return $this->provideFilter(SolicitacaoFilter::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}
