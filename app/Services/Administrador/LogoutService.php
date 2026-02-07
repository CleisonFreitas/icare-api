<?php

namespace App\Services\Administrador;

use Illuminate\Http\Request;

class LogoutService
{
    public function execute(Request $request): void
    {
        $user = $request->user();
        if ($user) {
            $token = $user->currentAccessToken();
            if ($token) {
                // expire and delete token
                $token->expires_at = now();
                $token->save();
                $token->delete();
            }
        }
    }
}
