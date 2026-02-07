<?php

namespace Tests\Feature\Controllers;

use App\Models\Servico\Estoque;
use App\Models\Servico\EstoqueHasVacina;
use App\Models\Servico\Vacina;
use App\Models\Cliente\Pet;
use App\Models\Servico\Consulta;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class ConsultaStockTest extends TestCase
{
    #[Test]
    public function diminui_estoque_quando_servico_vacinacao_e_criado(): void
    {
        $this->actingAsAdmin();

        // criar estoque e vacina base
        $estoque = Estoque::factory()->create();
        $vacina = Vacina::factory()->create();
        $lote = $this->faker->word;

        // criar registro pivot manualmente
        $pivot = EstoqueHasVacina::create([
            'estoque_id' => $estoque->id,
            'vacina_id' => $vacina->id,
            'quantidade' => 3,
            'lote' => $lote
        ]);

        $consulta = Consulta::factory()->make()->toArray();
        $payload = [
            ...$consulta,
            'servicos' => [
                [
                    'nome' => 'Vacinação',
                    'detalhes' => 'Dose',
                    'valor' => 0,
                    'vacina' =>[
                        'estoque_id' => $estoque->id,
                        'lote' => $lote,
                        'aplicado_por' => $vacina->aplicado_por,
                        'dosagem' => $vacina->dosagem,
                        'servico_id' => $vacina->servico_id,
                    ],
                ]
            ]
        ];

        $response = $this->postJson('api/v1/consulta', $payload);
        $response->assertCreated();

        $pivot->refresh();
        $this->assertEquals(2, $pivot->quantidade);
    }

    #[Test]
    public function exibir_error_quando_estoque_nao_for_suficiente(): void
    {
        $this->actingAsAdmin();

        $estoque = Estoque::factory()->create();
        $vacina = Vacina::factory()->create();

        $lote = $this->faker->word;

        EstoqueHasVacina::create([
            'estoque_id' => $estoque->id,
            'vacina_id' => $vacina->id,
            'quantidade' => 0,
            'lote' => $lote
        ]);

        $pet = Pet::factory()->create();

        $payload = [
            ...Consulta::factory()->for($pet)->make()->toArray(),
            'servicos' => [
                [
                    'nome' => 'Vacinação',
                    'detalhes' => 'Dose',
                    'valor' => 0,
                    'vacina' =>[
                        'estoque_id' => $estoque->id,
                        'lote' => $lote,
                        'aplicado_por' => $vacina->aplicado_por,
                        'dosagem' => $vacina->dosagem,
                        'servico_id' => $vacina->servico_id,
                    ],
                ]
            ]
        ];

        $response = $this->postJson('api/v1/consulta', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJsonStructure(['message']);
    }
}
