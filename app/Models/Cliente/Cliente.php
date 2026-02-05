<?php

namespace App\Models\Cliente;

use App\ModelFilters\Cliente\ClienteFilter;
use App\Traits\Orderable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, Filterable, Orderable;

    protected $table = 'clientes';

    protected $casts = [
        'senha' => 'hashed'
    ];

    protected $hidden = [
        'senha'
    ];

    public function modelFilter(): string
    {
        return $this->provideFilter(ClienteFilter::class);
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }

    public function contatos(): HasMany
    {
        return $this->hasMany(Contato::class);
    }
}
