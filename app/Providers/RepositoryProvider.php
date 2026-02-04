<?php

namespace App\Providers;

use App\Repositories\Contracts\ClienteContract;
use App\Repositories\Contracts\ContatoContract;
use App\Repositories\Contracts\EnderecoContract;
use App\Repositories\Logic\ClienteLogic;
use App\Repositories\Logic\ContatoLogic;
use App\Repositories\Logic\EnderecoLogic;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ClienteContract::class, ClienteLogic::class);
        $this->app->bind(EnderecoContract::class, EnderecoLogic::class);
        $this->app->bind(ContatoContract::class, ContatoLogic::class);
    }

    public function boot(): void {}
}
