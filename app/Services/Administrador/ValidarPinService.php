<?php

namespace App\Services\Administrador;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ValidarPinService
{
    public function execute(string $email, string $pin): void
    {
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (! $record || (string) $record->token !== (string) $pin) {
            throw new \RuntimeException('PIN inválido.', 400);
        }

        $created = Carbon::parse($record->created_at);
        if ($created->diffInMinutes(Carbon::now()) > 60) {
            throw new \RuntimeException('PIN expirado.', 400);
        }
    }
}
