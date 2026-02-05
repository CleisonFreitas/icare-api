<?php

namespace Database\Factories\Servico;

use App\Enums\Servico\StatusConsultaEnum;
use App\Models\Cliente\Pet;
use App\Models\Servico\Consulta;
use App\Models\Servico\Solicitacao;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Consulta>
 */
class ConsultaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descricao' => $this->faker->text,
            'data_prevista' => Carbon::parse($this->faker->date),
            'data_realizada' => Carbon::parse($this->faker->date),
            'status' => $this->faker->randomElement(StatusConsultaEnum::cases()),
            'pet_id' => Pet::factory()->lazy(),
            'solicitacao_id' => Solicitacao::factory()->lazy(),
        ];
    }
}
