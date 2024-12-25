<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear el primer usuario adicional si no existe
        $user1 = User::firstOrCreate([
            'email' => 'abisai@gmail.com',
        ], [
            'name' => 'Rafael Carlos Eduardo',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'Martínez',
            'password' => bcrypt('abisai1456'),
            'telefono' => '9518993892',
            'image' => null,
            'id_area' => 10,
        ]);

        // Asignamos el rol 'Secretaria' al primer usuario adicional
        $secretaryRole = Role::where('name', 'Archivo')->first();
        if ($secretaryRole) {
            $user1->assignRole($secretaryRole);
        }

        // Crear el segundo usuario adicional si no existe
        $user2 = User::firstOrCreate([
            'email' => 'laura.martinez@gmail.com',
        ], [
            'name' => 'Laura Martínez',
            'apellido_paterno' => 'García',
            'apellido_materno' => 'Ramírez',
            'password' => bcrypt('laura12345'),
            'telefono' => '9511857878',
            'image' => null,
            'id_area' => 10,
        ]);

        // Asignamos el rol 'Empleado' al segundo usuario adicional
        $employeeRole = Role::where('name', 'Solicitante')->first();
        if ($employeeRole) {
            $user2->assignRole($employeeRole);
        }
    }
}
