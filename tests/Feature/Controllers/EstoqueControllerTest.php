<?php

namespace Tests\Feature\Controllers;

use App\Models\Servico\Estoque;
use App\Models\Servico\Vacina;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class EstoqueControllerTest extends TestCase
{
    #[Test]
    public function index(): void
    {
        $this->actingAsAdmin();
        $filtros = ['nome'];

        $estoque = Estoque::factory()->create();
        $vacina = Vacina::factory()->create();

        $estoque->vacinas()->sync([
            $vacina->id => [
                'quantidade' => $this->faker->randomDigit,
                'lote' => $this->faker->word
            ]
        ]);

        $response = $this->getJson('api/v1/estoque?' . http_build_query($filtros));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => [
                    'id',
                    'nome',
                    'descricao',
                    'vacinas' => [
                        0 => [
                            'lote',
                            'quantidade'
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
        $dados = $estoque = Estoque::factory()->make()->toArray();

        $response = $this->postJson('api/v1/estoque', $dados);
        $response->assertCreated();
    }

    #[Test]
    public function show(): void
    {
        $this->actingAsAdmin();
        $estoque = Estoque::factory()->create();
        $vacina = Vacina::factory()->create();

        $estoque->vacinas()->sync([
            $vacina->id => [
                'quantidade' => $this->faker->randomDigit,
                'lote' => $this->faker->word
            ]
        ]);

        $response = $this->getJson("api/v1/estoque/$estoque->id");
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'nome',
            'descricao',
            'vacinas' => [
                0 => [
                    'lote',
                    'quantidade'
                ]
            ]
        ]);
    }

    #[Test]
    public function update(): void
    {
        $this->actingAsAdmin();
        $estoque = Estoque::factory()->create();
        $vacina = Vacina::factory()->create();
        $estoque->vacinas()->sync([
            $vacina->id => [
                'quantidade' => $this->faker->randomDigit,
                'lote' => $this->faker->word
            ]
        ]);

        $dados = Estoque::factory()->make()->toArray();

        $response = $this->putJson("api/v1/estoque/$estoque->id", $dados);
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'nome',
            'descricao',
            'vacinas' => [
                0 => [
                    'lote',
                    'quantidade'
                ]
            ]
        ]);
    }

    #[Test]
    public function destroy(): void
    {
        $this->actingAsAdmin();
        $estoque = Estoque::factory()->create();

        $response = $this->deleteJson("api/v1/estoque/$estoque->id");

        $response->assertOk();
    }
}