<?php

namespace App\Services\Administrador;

use App\DTOs\Usuario\UsuarioAuthDTO;
use App\Exceptions\UsuarioLoginException;
use Illuminate\Http\Request;

class LogoutService
{
    public function execute(Request $request): UsuarioAuthDTO
    {
        $user = $request->user();
        if (!$user) {
            throw new UsuarioLoginException(
                "Usuário não está logado ou não foi encontrado!"
            );
        }

        $token = $user->currentAccessToken();
        if ($token) {
            // expire and delete token
            $token->expires_at = now();
            $token->save();
            $token->delete();
        }
        return new UsuarioAuthDTO($user, $token?->name);
    }
}
