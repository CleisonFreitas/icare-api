<?php

namespace Database\Factories\Servico;

use App\Models\Cliente\Pet;
use App\Models\Servico\Servico;
use App\Models\Servico\Vacina;
use App\Models\Usuario\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vacina>
 */
class VacinaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory()->lazy(),
            'nome' => $this->faker->name,
            'data_administrada' => Carbon::parse($this->faker->date),
            'aplicado_por' => Usuario::factory()->lazy(),
            'lote' => $this->faker->word,
            'fabricante' => $this->faker->name,
            'dosagem' => $this->faker->randomDigit,
            'servico_id' => Servico::factory()->lazy()
        ];
    }
}
