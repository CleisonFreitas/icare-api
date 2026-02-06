<?php

namespace App\Providers;

use App\Repositories\Contracts\ClienteContract;
use App\Repositories\Contracts\ContatoContract;
use App\Repositories\Contracts\EnderecoContract;
use App\Repositories\Contracts\EstoqueContract;
use App\Repositories\Contracts\PetContract;
use App\Repositories\Contracts\VacinaContract;
use App\Repositories\Logic\ClienteLogic;
use App\Repositories\Logic\ContatoLogic;
use App\Repositories\Logic\EnderecoLogic;
use App\Repositories\Logic\EstoqueLogic;
use App\Repositories\Logic\PetLogic;
use App\Repositories\Logic\VacinaLogic;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ClienteContract::class, ClienteLogic::class);
        $this->app->bind(EnderecoContract::class, EnderecoLogic::class);
        $this->app->bind(ContatoContract::class, ContatoLogic::class);
        $this->app->bind(PetContract::class, PetLogic::class);
        $this->app->bind(EstoqueContract::class, EstoqueLogic::class);
        $this->app->bind(VacinaContract::class, VacinaLogic::class);
    }

    public function boot(): void {}
}
