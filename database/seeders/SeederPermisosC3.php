<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class SeederPermisosC3 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lista de permisos
        $permisos = [
            'ver-dashboard',
            'ver-inicio',
            'ver-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'crear-usuario',
            'ver-roles',
            'editar-rol',
            'eliminar-rol',
            'crear-rol',
            'ver-evaluados',
            'editar-evaluado',
            'eliminar-evaluado',
            'crear-evaluado',
            'ver-carpetas',
            'ver-contenido-carpetas',
            'editar-carpeta',
            'eliminar-carpeta',
            'crear-carpeta',
            'ver-cajas',
            'crear-caja',
            'editar-caja',
            'eliminar-caja',
            'solicitar-prestamo',
            'ver-notificacion-prestamo',
            'devolver-prestamo',
            'cancelar-prestamo',
            'eliminar-documentos',
            'lista-prestamos',
            'ver-notificacion-prestamo',
        ];

        // Crear o actualizar permisos
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
  // Crear el rol de administrador y asignar todos los permisos
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        // Crear un usuario administrador con el rol de admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], 
            [
                'name' => 'Elias',
                'password' => bcrypt('admin12345'), 
                'apellido_paterno' => 'Ramos',
                'apellido_materno' => 'Ramos',
                'telefono' => '9517898998',
                'image' => null,
                'id_area' => 1,
            ]
        );

        // Asignar el rol al usuario
        $adminUser->assignRole($adminRole);
    }
}
