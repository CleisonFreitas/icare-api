<?php

namespace Tests\Feature\Controllers;

use App\Models\Servico\Consulta;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ConsultaControllerTest extends TestCase
{
    #[Test]
    public function index(): void
    {
        $this->actingAsAdmin();

        Consulta::factory()->create();

        $response = $this->getJson('api/v1/consulta');
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => [
                    'id',
                    'titulo',
                    'descricao',
                    'data_prevista',
                    'data_realizada',
                    'servicos'
                ]
            ]
        ]);
    }

    #[Test]
    public function store(): void
    {
        $this->actingAsAdmin();
        $dados = Consulta::factory()->make()->toArray();

        $response = $this->postJson('api/v1/consulta', $dados);
        $response->assertCreated();
    }

    #[Test]
    public function show(): void
    {
        $this->actingAsAdmin();
        $consulta = Consulta::factory()->create();

        $response = $this->getJson("api/v1/consulta/$consulta->id");
        $response->assertOk();
    }

    #[Test]
    public function update(): void
    {
        $this->actingAsAdmin();
        $consulta = Consulta::factory()->create();
        $dados = Consulta::factory()->make()->toArray();

        $response = $this->putJson("api/v1/consulta/$consulta->id", $dados);
        $response->assertOk();
    }

    #[Test]
    public function destroy(): void
    {
        $this->actingAsAdmin();
        $consulta = Consulta::factory()->create();

        $response = $this->deleteJson("api/v1/consulta/$consulta->id");

        $response->assertOk();
    }
}
