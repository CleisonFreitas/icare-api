<?php

namespace Database\Factories\Cliente;

use App\Models\Cliente\Cliente;
use App\Models\Cliente\Especie;
use App\Models\Cliente\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'documento' => $this->faker->numerify('#######'),
            'size' => $this->faker->randomElement(['BAIXO', 'MEDIO', 'ALTO']),
            'cor' => $this->faker->colorName,
            'especie_id' => Especie::factory()->lazy(),
            'cliente_id' => Cliente::factory()->lazy(),
            'ativo' => true,
            'tem_microship' => $this->faker->boolean,
            'numero_microship' => $this->faker->numerify('#########')
        ];
    }
}
