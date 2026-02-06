<?php

namespace Database\Factories\Servico;

use App\Models\Servico\Estoque;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Estoque>
 */
class EstoqueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'descricao' => $this->faker->sentence
        ];
    }
}
