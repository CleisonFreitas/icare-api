<?php

namespace Database\Factories\Servico;

use App\Enums\Servico\StatusServicoEnum;
use App\Models\Cliente\Pet;
use App\Models\Servico\Consulta;
use App\Models\Servico\Servico;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Servico>
 */
class ServicoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->sentence(3),
            'detalhes' => $this->faker->sentence,
            'status' => $this->faker->randomElement(StatusServicoEnum::cases()),
            'data_conclusao' => Carbon::parse($this->faker->dateTime),
            'valor' => $this->faker->randomFloat,
            'pet_id' => Pet::factory()->lazy(),
            'consulta_id' => Consulta::factory()->lazy()
        ];
    }
}