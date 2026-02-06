<?php

namespace Tests\Feature\Controllers;

use App\Models\Servico\Estoque;
use App\Models\Servico\Vacina;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class VacinaControllerTest extends TestCase
{
    #[Test]
    public function index(): void
    {
        $this->actingAsAdmin();

        $vacina = Vacina::factory()->create();
        $estoque = Estoque::factory()->create();

        $vacina->estoques()->sync([
            $estoque->id => [
                'quantidade' => $this->faker->randomDigit,
                'lote' => $this->faker->word
            ]
        ]);
        $dataAdministrada = Carbon::parse($vacina->data_administrada);

        $filtros = [
            'nome' => $vacina->nome,
            'autor_aplicacao' => $vacina->autor->nome,
            'data_administrada' => [
                'inicio' => $dataAdministrada->clone()->subDay()->format('Y-m-d'),
                'fim' => $dataAdministrada->clone()->addDay()->format('Y-m-d'),
            ]
        ];

        $response = $this->getJson('api/v1/vacina?' . http_build_query($filtros));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => [
                    'id',
                    'pet_id',
                    'nome',
                    'data_administrada',
                    'aplicado_por',
                    'fabricante',
                    'dosagem',
                    'servicos_id',
                    'estoques' => [
                        0 => [
                            'id',
                            'nome',
                            'descricao'
                        ]
                    ]
                ]
            ]
        ]);
    }

    #[Test]
    public function store(): void
    {
        $this->actingAsAdmin();
        $dados = Vacina::factory()->make()->toArray();

        $response = $this->postJson('api/v1/vacina', $dados);
        $response->assertCreated();
    }

    #[Test]
    public function show(): void
    {
        $this->actingAsAdmin();
        $vacina = Vacina::factory()->create();
        $estoque = Estoque::factory()->create();

        $vacina->estoques()->sync([
            $estoque->id => [
                'quantidade' => $this->faker->randomDigit,
                'lote' => $this->faker->word
            ]
        ]);

        $response = $this->getJson("api/v1/vacina/$vacina->id");
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'pet_id',
            'nome',
            'data_administrada',
            'aplicado_por',
            'fabricante',
            'dosagem',
            'servicos_id',
            'estoques' => [
                0 => [
                    'id',
                    'nome',
                    'descricao'
                ]
            ]
        ]);
    }

    #[Test]
    public function update(): void
    {
        $this->actingAsAdmin();
        $vacina = Vacina::factory()->create();
        $dados = Vacina::factory()->make()->toArray();
        $response = $this->putJson("api/v1/vacina/$vacina->id", $dados);

        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'pet_id',
            'nome',
            'data_administrada',
            'aplicado_por',
            'fabricante',
            'dosagem',
            'servicos_id',
            'estoques'
        ]);
    }

    #[Test]
    public function destroy(): void
    {
        $this->actingAsAdmin();
        $vacina = Vacina::factory()->create();

        $response = $this->deleteJson("api/v1/vacina/$vacina->id");

        $response->assertOk();
    }
}
