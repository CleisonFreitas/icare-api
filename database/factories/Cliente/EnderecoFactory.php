<?php

namespace Database\Factories\Cliente;

use App\Models\Cliente\Cliente;
use App\Models\Cliente\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Endereco>
 */
class EnderecoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cep' => $this->faker->numerify('########'),
            'logradouro' => $this->faker->streetName,
            'complemento' => $this->faker->randomLetter,
            'numero' => $this->faker->randomNumber,
            'bairro' => $this->faker->streetName,
            'cidade' => $this->faker->city,
            'pais' => $this->faker->country,
            'cliente_id' => Cliente::factory()->lazy(),
        ];
    }
}
