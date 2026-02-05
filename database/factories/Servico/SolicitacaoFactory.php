<?php

namespace Database\Factories\Servico;

use App\Enums\Servico\StatusSolicitacaoEnum;
use App\Models\Cliente\Pet;
use App\Models\Servico\Solicitacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Solicitacao>
 */
class SolicitacaoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descricao' => $this->faker->sentence,
            'status' => $this->faker->randomElement(StatusSolicitacaoEnum::cases()),
            'pet_id' => Pet::factory()->lazy(),
        ];
    }
}
