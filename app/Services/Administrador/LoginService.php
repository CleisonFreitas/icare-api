<?php

namespace App\Services\Administrador;

use App\Exceptions\UsuarioLoginException;
use App\Models\Usuario\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function execute(array $data): array
    {
        /** @var Usuario|null $user */
        $user = Usuario::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['senha'], $user->senha)) {
            throw new UsuarioLoginException('Credenciais inválidas.');
        }

        $token = $user->createToken('admin-token', ['*'])->plainTextToken;

        return [
            'usuario' => [
                'id' => $user->id,
                'nome' => $user->nome,
                'email' => $user->email,
            ],
            'token' => $token,
        ];
    }
}
