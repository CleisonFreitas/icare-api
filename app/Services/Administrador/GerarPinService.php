<?php

namespace App\Services\Administrador;

use App\Mail\PinRecuperacaoMail;
use App\Models\Usuario\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class GerarPinService
{
    public function execute(string $email): void
    {
        $user = Usuario::where('email', $email)->first();
        if (! $user) {
            // do nothing to avoid user enumeration
            return;
        }

        $pin = random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $pin, 'created_at' => Carbon::now()]
        );

        Mail::to($user->email)->send(new PinRecuperacaoMail($pin, $user));
    }
}
