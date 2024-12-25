<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeederRolesC3 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definir los permisos y descripciones para cada rol
        $rolesPermissions = [
            [
                'name' => 'Archivo',
                'description' => 'Usuario encargado de gestionar archivos y documentos.',
                'permissions' => [
                    'ver-dashboard',
                    'ver-inicio',
                    'ver-evaluados',
                    'editar-evaluado',
                    'crear-evaluado',
                    'ver-carpetas',
                    'ver-contenido-carpetas',
                    'editar-carpeta',
                    'crear-carpeta',
                    'ver-cajas',
                    'crear-caja',
                    'editar-caja',
                    'lista-prestamos',
                    'ver-notificacion-prestamo',
                    'eliminar-evaluado',
                    'eliminar-documentos',
                  
                ],
            ],
            [
                'name' => 'Solicitante',
                'description' => 'Usuario con permisos para solicitar préstamos de documentos.',
                'permissions' => [
                    'ver-dashboard',
                    'ver-inicio',
                      'ver-carpetas',
                    'ver-contenido-carpetas'
                
                ],
            ],
        ];

        // Crear roles, descripciones y asignar permisos
        foreach ($rolesPermissions as $roleData) {
            // Crear o encontrar el rol
            $role = Role::firstOrCreate(
                ['name' => $roleData['name']],
                ['description' => $roleData['description']] // Asignar descripción
            );

            foreach ($roleData['permissions'] as $permissionName) {
                // Crear o encontrar cada permiso
                $permission = Permission::firstOrCreate(['name' => $permissionName]);

                // Asignar el permiso al rol
                $role->givePermissionTo($permission);
            }
        }

        // Limpiar la caché de permisos después de las asignaciones
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
