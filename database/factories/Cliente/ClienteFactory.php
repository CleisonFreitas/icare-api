<?php

namespace Database\Factories\Cliente;

use App\Models\Cliente\Cliente;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cliente>
 */
class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'documento' => $this->faker->numerify('###########'),
            'data_nascimento' => Carbon::parse($this->faker->date),
            'senha' => $this->faker->password
        ];
    }
}
