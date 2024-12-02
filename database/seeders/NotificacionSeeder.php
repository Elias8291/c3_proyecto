<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notificacion;
use App\Models\User;

class NotificacionSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de tener usuarios para asociar las notificaciones
        $users = User::all();

        foreach ($users as $user) {
            Notificacion::create([
                'usuario_id' => $user->id,
                'mensaje' => 'Tienes una nueva notificación.',
                'leida' => null,  // Si es null, significa que no ha sido leída
            ]);
        }
    }
}
