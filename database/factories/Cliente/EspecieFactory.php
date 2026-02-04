<?php

namespace Database\Factories\Cliente;

use App\Models\Cliente\Especie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Especie>
 */
class EspecieFactory extends Factory
{
    public function definition(): array
    {
        $nome = $this->faker->name;

        return [
            'nome' => $nome,
            'slug' => Str::slug($nome),
            'grupo' => $this->faker->name,
            'ativo' => true,
        ];
    }
}
