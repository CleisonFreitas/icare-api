<?php

namespace App\Services\Administrador;

use Illuminate\Http\Request;
use Carbon\Carbon;

class MeService
{
    public function execute(Request $request): array
    {
        $user = $request->user();
        if (! $user) {
            throw new \RuntimeException('Não autenticado.', 401);
        }

        $token = $user->currentAccessToken();
        if (! $token) {
            throw new \RuntimeException('Token não encontrado.', 401);
        }

        if ($token->expires_at && Carbon::parse($token->expires_at)->lessThanOrEqualTo(now())) {
            throw new \RuntimeException('Token já expirado', 401);
        }

        return [
            'usuario' => [
                'id' => $user->id,
                'email' => $user->email,
                'nome' => $user->nome,
            ],
        ];
    }
}
