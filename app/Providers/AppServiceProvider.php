<?php

namespace App\Providers;

use App\Models\Support;
use App\Observers\SupportObserver;
use App\Repositories\Contracts\ReplayRepositoryInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use App\Repositories\Eloquent\ReplySupportRepository;
use App\Repositories\SupportEloquentORM;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SupportRepositoryInterface::class, SupportEloquentORM::class);

        $this->app->bind(ReplayRepositoryInterface::class, ReplySupportRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //Toda vez que tiver alguma ação nesse model, observa ele e aplica o que tiver no SupportObserver
        Support::observe(SupportObserver::class);
    }
}
