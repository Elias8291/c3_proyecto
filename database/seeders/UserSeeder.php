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
        // Creamos el usuario administrador
        $admin = User::create([
            'name' => 'Carlos Eduardo',
            'apellido_paterno' => 'Pérez',
            'apellido_materno' => 'González',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin12345'), // Aseguramos la contraseña con bcrypt
            'telefono' => '555-1234',
            'image' => null, // Puede ser null
            'id_area' => 1, // Cambia según el id correspondiente del área
        ]);

        // Asignamos el rol 'Admin' al usuario administrador
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Creamos otro usuario
        $user = User::create([
            'name' => 'Rafael Carlos Eduardo',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'Martínez',
            'email' => 'abisai@gmail.com',
            'password' => bcrypt('abisai1456'), // Aseguramos la contraseña con bcrypt
            'telefono' => '555-5678',
            'image' => null, // Puede ser null
            'id_area' => 2, // Cambia según el id correspondiente del área
        ]);

        // Asignamos el rol 'Secretaria' al otro usuario
        $secretaryRole = Role::where('name', 'Secretaria')->first();
        if ($secretaryRole) {
            $user->assignRole($secretaryRole);
        }

        // Puedes agregar más usuarios aquí
    }
}
