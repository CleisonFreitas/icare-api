<?php

namespace App\Services\Administrador;

use App\Mail\PinRecuperacaoMail;
use App\Models\Usuario\Usuario;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class GerarPinService
{
    public function execute(string $email): void
    {
        $user = Usuario::where('email', $email)->first();
        if (!$user) {
            throw new Exception("Email informado não foi encontrado!", Response::HTTP_BAD_REQUEST);
        }

        $pin = random_int(1000, 9999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $pin, 'created_at' => Carbon::now()]
        );

        Mail::to($user->email)->send(new PinRecuperacaoMail($pin, $user));
    }
}
