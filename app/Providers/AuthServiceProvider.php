<?php

namespace App\Providers;

 use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

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
    { //['isCentro', 'isDoador', 'isMedico', 'Admin']
        // Gate para acessar painel de admin
        Gate::define('acessar-Admin', function (User $user) {
            return $user->isAdmin();
        });

       // Gate para acessar painel Doador
        Gate::define('acessar-Doador', function (User $user) {
            return $user->isDoador();
        });

            // Gate para Medico
        Gate::define('acessar-Medico', function (User $user) {
            return $user->isMedico();
        });
            // Centro
         Gate::define('acessar-Centro', function (User $user) {
           return $user->isCentro();
        });

    }
}
