<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
//Para la paginacion
use Illuminate\Pagination\Paginator;
use App\Models\Log;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Materia;
use App\Models\User;
use App\Models\Periodo;
use Spatie\Permission\Models\Role;
use App\Observers\LogObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        Estudiante::observe(LogObserver::class);
        Grupo::observe(LogObserver::class);
        Inscripcion::observe(LogObserver::class);
        Materia::observe(LogObserver::class);
        User::observe(LogObserver::class);
        Role::observe(LogObserver::class);
        Periodo::observe(LogObserver::class);
    }
}
