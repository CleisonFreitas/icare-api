<?php

namespace Tests;

use App\Models\Usuario\Usuario;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use WithFaker, DatabaseMigrations;

    public function actingAsAdmin(): Usuario
    {
        $usuario = Usuario::factory()->create();
        Sanctum::actingAs($usuario, ['*'], 'administrador');

        return $usuario;
    }
}
