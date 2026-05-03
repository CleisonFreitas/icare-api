<?php

namespace Database\Factories\Cliente;

use App\Enums\Cliente\ClienteTipoContatoEnum;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Contato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contato>
 */
class ContatoFactory extends Factory
{
    public function definition(): array
    {
        $contato = $this->faker->randomElement(ClienteTipoContatoEnum::toValues());
        $valor = $contato == ClienteTipoContatoEnum::EMAIL->value
            ? $this->faker->email
            : $this->faker->phoneNumber;

        return [
            'nome' => $this->faker->name,
            'tipo' => $contato,
            'valor' => $valor,
            'cliente_id' => Cliente::factory()->lazy()
        ];
    }
}
