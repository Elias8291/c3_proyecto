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
        // Crear el usuario administrador si no existe
        $admin = User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Carlos Eduardo',
            'apellido_paterno' => 'Pérez',
            'apellido_materno' => 'González',
            'password' => bcrypt('admin12345'),
            'telefono' => '555-1234',
            'image' => null, 
            'id_area' => 1,
        ]);

        // Asignamos el rol 'Admin' al usuario administrador
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Crear el primer usuario adicional si no existe
        $user1 = User::firstOrCreate([
            'email' => 'abisai@gmail.com',
        ], [
            'name' => 'Rafael Carlos Eduardo',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'Martínez',
            'password' => bcrypt('abisai1456'),
            'telefono' => '555-5678',
            'image' => null, 
            'id_area' => 2,
        ]);

        // Asignamos el rol 'Secretaria' al primer usuario adicional
        $secretaryRole = Role::where('name', 'Secretaria')->first();
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
            'telefono' => '555-8765',
            'image' => null, 
            'id_area' => 3,
        ]);

        // Asignamos el rol 'Empleado' al segundo usuario adicional
        $employeeRole = Role::where('name', 'Empleado')->first();
        if ($employeeRole) {
            $user2->assignRole($employeeRole);
        }
    }
}
