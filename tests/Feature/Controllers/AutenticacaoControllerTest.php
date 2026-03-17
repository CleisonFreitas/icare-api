<?php

namespace Tests\Feature\Controllers;

use App\Mail\PinRecuperacaoMail;
use App\Models\Usuario\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AutenticacaoControllerTest extends TestCase
{
    #[Test]
    public function fluxo_login_me_e_logout(): void
    {
        $email = $this->faker->email;
        $senha = $this->faker->password;

        Usuario::factory()->create([
            'email' => $email,
            'senha' => $senha,
        ]);

        $response = $this->postJson('api/v1/administrador/login', ['email' => $email, 'senha' => $senha]);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['token', 'usuario']);

        $token = $response->json('token');

        $me = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('api/v1/administrador/me');
        $me->assertStatus(Response::HTTP_OK)
            ->assertJsonPath('usuario.email', $email);

        $logout = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('api/v1/administrador/logout');
        $logout->assertStatus(Response::HTTP_OK);
        
        $me2 = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('api/v1/administrador/me');
        $me2->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    #[Test]
    public function gerar_pin_validar_e_alterar_senha(): void
    {
        Mail::fake();

        $email = $this->faker->email;
        $user = Usuario::factory()->create(['email' => $email]);

        $resp = $this->postJson('api/v1/administrador/gerar-pin', ['email' => $email]);
        $resp->assertStatus(200);
        Mail::assertSent(PinRecuperacaoMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });

        $pin = DB::table('password_reset_tokens')->where('email', $email)->value('token');
        $this->assertNotEmpty($pin);

        $validar = $this->postJson('api/v1/administrador/validar-pin', ['email' => $email, 'pin' => $pin]);
        $validar->assertStatus(200);

        $nova = 'novaSenha123';
        $alter = $this->postJson('api/v1/administrador/alterar-senha', [
            'email' => $email,
            'pin' => $pin,
            'senha' => $nova,
            'senha_confirmation' => $nova,
        ]);

        $alter->assertStatus(200);

        $user->refresh();
        $this->assertTrue(Hash::check($nova, $user->senha));
    }
}
