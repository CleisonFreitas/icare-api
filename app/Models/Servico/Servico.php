<?php

namespace App\Models\Servico;

use App\ModelFilters\Servico\ServicoFilter;
use App\Models\Cliente\Pet;
use App\Traits\Orderable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servico extends Model
{
    use HasFactory, SoftDeletes, Filterable, Orderable;

    protected $table = 'servicos';

    protected $fillable = [
        'nome',
        'detalhes',
        'status',
        'data_conclusao',
        'pet_id',
        'consulta_id',
        'valor'
    ];

    public function modelFilter(): string
    {
        return $this->provideFilter(ServicoFilter::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function consulta(): BelongsTo
    {
        return $this->belongsTo(Consulta::class);
    }
}
