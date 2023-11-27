<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
      //passando autorização para cada usuario
      //recebe o usuario autenticado no 1º parametro
      // recebe id do registro   no 2º parametro

      Gate::define('owner', function (User $user, string $id){
        //verifica se o id do Usuario é igual o id do registro
        return $user->id === $id;
      });
    }
}
