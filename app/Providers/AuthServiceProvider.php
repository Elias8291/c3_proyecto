<?php

namespace App\Providers;

use App\Models\Carpeta;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Observers\LogObserver;
use App\Models\Documento;
use App\Models\Evaluado;
use App\Models\Prestamo;
use App\Models\Caja;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //agregamos el usuario Super Admin
        // Otorga implícitamente todos los permisos a la función "Superadministrador"       
        Gate::before(function ($user, $ability) {
            return $user->email == 'admin@gmail.com' ?? null;
        });

        User::observe(LogObserver::class);
        Documento::observe(LogObserver::class);
        Carpeta::observe(LogObserver::class);
        Evaluado::observe(LogObserver::class);
        Prestamo::observe(LogObserver::class);
        Caja::observe(LogObserver::class);
    }
}
