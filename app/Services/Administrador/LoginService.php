<?php

namespace App\Services\Administrador;

use App\Models\Usuario\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function execute(array $data): array
    {
        /** @var Usuario|null $user */
        $user = Usuario::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['senha'], $user->senha)) {
            throw new \RuntimeException('Credenciais inválidas.', 401);
        }

        $token = $user->createToken('admin-token', ['*'])->plainTextToken;

        return [
            'token' => $token,
            'usuario' => [
                'id' => $user->id,
                'email' => $user->email,
            ],
        ];
    }
}
