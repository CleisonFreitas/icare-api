<?php

namespace App\Exceptions;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class UsuarioLoginException extends RuntimeException
{
    public function __construct(private readonly string $message = "")
    {
        return parent::__construct($message, Response::HTTP_FORBIDDEN);
    }
}
