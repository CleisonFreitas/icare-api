<?php

namespace App\Services\Administrador;

use App\Models\Usuario\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AlterarSenhaService
{
    public function execute(string $email, string $pin, string $senha): void
    {
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();
        if (! $record || (string) $record->token !== (string) $pin) {
            throw new \RuntimeException('PIN inválido.', 400);
        }

        $user = Usuario::where('email', $email)->first();
        if (! $user) {
            throw new \RuntimeException('Usuário não encontrado.', 404);
        }

        $user->senha = Hash::make($senha);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $email)->delete();
    }
}
