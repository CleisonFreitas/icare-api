<?php

namespace App\Models\Cliente;

use App\Enums\Pet\PetTamanhoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pets';

    protected $casts = [
        'tamanho' => PetTamanhoEnum::class
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function especie(): HasOne
    {
        return $this->hasOne(Especie::class);
    }
}
