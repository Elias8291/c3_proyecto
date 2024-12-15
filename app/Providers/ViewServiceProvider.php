<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Notificacion;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Compartir notificaciones en todas las vistas
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $notificaciones = Notificacion::where('usuario_receptor_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();

                $notificacionesNoLeidas = Notificacion::where('usuario_receptor_id', auth()->id())
                    ->where('leida', false)
                    ->count();

                $view->with('notificaciones', $notificaciones)
                     ->with('notificacionesNoLeidas', $notificacionesNoLeidas);
            }
        });
    }

    /**
     * Register services.
     */
    public function register()
    {
        //
    }
}
