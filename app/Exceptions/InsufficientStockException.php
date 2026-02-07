<?php

namespace App\Exceptions;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

final class InsufficientStockException extends RuntimeException
{
    public function __construct(string $message = "")
    {
        return parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}
