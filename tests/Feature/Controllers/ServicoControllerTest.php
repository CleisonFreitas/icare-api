<?php

namespace Tests\Feature\Controllers;

use App\Models\Servico\Servico;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ServicoControllerTest extends TestCase
{
    #[Test]
    public function index(): void
    {
        $this->actingAsAdmin();

        $servico = Servico::factory()->create();

        $filtros = [
            'nome' => $servico->nome,
            'status' => $servico->status->value
        ];

        $response = $this->getJson('api/v1/servico?' . http_build_query($filtros));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => [
                    'id',
                    'nome',
                    'detalhes',
                    'status',
                    'valor',
                    'pet',
                    'consulta'
                ]
            ]
        ]);
    }

    #[Test]
    public function store(): void
    {
        $this->actingAsAdmin();
        $dados = Servico::factory()->make()->toArray();

        $response = $this->postJson('api/v1/servico', $dados);
        $response->assertCreated();
    }

    #[Test]
    public function show(): void
    {
        $this->actingAsAdmin();
        $servico = Servico::factory()->create();

        $response = $this->getJson("api/v1/servico/$servico->id");
        $response->assertOk();
        $response->assertJsonStructure([
            'id', 'nome', 'detalhes', 'status', 'valor'
        ]);
    }

    #[Test]
    public function update(): void
    {
        $this->actingAsAdmin();
        $servico = Servico::factory()->create();
        $dados = Servico::factory()->make()->toArray();

        $response = $this->putJson("api/v1/servico/$servico->id", $dados);
        $response->assertOk();
        $response->assertJsonStructure([
            'id', 'nome', 'detalhes', 'status', 'valor'
        ]);
    }

    #[Test]
    public function destroy(): void
    {
        $this->actingAsAdmin();
        $servico = Servico::factory()->create();

        $response = $this->deleteJson("api/v1/servico/$servico->id");

        $response->assertOk();
    }
}
