<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notificacion;
use App\Models\User;
use App\Models\Area;

class NotificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtén usuarios y áreas existentes
        $usuarios = User::all();
        $areas = Area::all();

        if ($usuarios->isEmpty() || $areas->isEmpty()) {
            $this->command->warn('No hay usuarios o áreas para crear notificaciones.');
            return;
        }

        // Crear 50 notificaciones de ejemplo
        foreach (range(1, 50) as $index) {
            Notificacion::create([
                'usuario_emisor_id' => $usuarios->random()->id,
                'usuario_receptor_id' => $usuarios->random()->id,
                'area_id' => $areas->random()->id,
                'mensaje' => 'Esta es una notificación de prueba #' . $index,
                'leida' => rand(0, 1), // 0 = No leída, 1 = Leída
            ]);
        }

        $this->command->info('Notificaciones creadas con éxito.');
    }
}
