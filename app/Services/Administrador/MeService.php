<?php

namespace App\Services\Administrador;

use App\DTOs\Usuario\UsuarioAuthDTO;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;

class MeService
{
    public function execute(Request $request): UsuarioAuthDTO
    {
        $user = $request->user();
        if (!$user) {
            throw new AuthenticationException('Não autenticado.', ['administrador']);
        }

        $token = $user->currentAccessToken();
        if (!$token) {
            throw new AuthenticationException('Token não encontrado!.', ['administrador']);
        }

        if ($token->expires_at && Carbon::parse($token->expires_at)->lessThanOrEqualTo(now())) {
            throw new AuthenticationException('Token já expirado', ['administrador']);
        }

        return new UsuarioAuthDTO($user, $token->name);
    }
}
