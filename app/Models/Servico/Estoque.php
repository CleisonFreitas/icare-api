<?php

namespace App\Models\Servico;

use App\ModelFilters\Servico\EstoqueFilter;
use App\Traits\Orderable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estoque extends Model
{
    use HasFactory, SoftDeletes, Filterable, Orderable;

    protected $table = 'estoques';

    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function modelFilter(): string
    {
        return $this->provideFilter(filter: EstoqueFilter::class);
    }

    public function vacinas(): BelongsToMany
    {
        return $this->belongsToMany(Vacina::class, 'estoque_has_vacinas')
            ->withPivot('quantidade', 'lote')
            ->withTimestamps();
    }
}
