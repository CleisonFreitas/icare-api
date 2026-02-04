<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function ($router) {
    require __DIR__ . '/administrador.php';
    require __DIR__ . '/cliente.php';
});
