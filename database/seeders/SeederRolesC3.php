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
        // Roles y permisos asignados
        $rolesPermissions = [
            'Admin' => [
                'ver-documentos',
                'crear-documentos',
                'editar-documentos',
                'eliminar-documentos',
                'ver-evaluaciones',
                'crear-evaluaciones',
                'editar-evaluaciones',
                'eliminar-evaluaciones',
                'ver-archivo',
                'gestionar-archivo',
                'ver-direccion-general',
                'gestionar-direccion-general',
                'ver-secretariado-ejecutivo',
                'gestionar-secretariado-ejecutivo',
                'ver-usuarios',
                'crear-usuarios',
                'editar-usuarios',
                'eliminar-usuarios',
                'asignar-roles',
            ],
            'Secretaria' => [
                'ver-documentos',
                'crear-documentos',
                'editar-documentos',
                'ver-evaluaciones',
                'crear-evaluaciones',
                'editar-evaluaciones',
                'ver-archivo',
            ],
            'Archivo' => [
                'ver-documentos',
                'gestionar-archivo',
                'ver-evaluaciones',
            ],
            'Secretariado Ejecutivo' => [
                'ver-secretariado-ejecutivo',
                'gestionar-secretariado-ejecutivo',
                'ver-documentos',
                'ver-evaluaciones',
            ],
            'Dirección General' => [
                'ver-direccion-general',
                'gestionar-direccion-general',
                'ver-documentos',
                'ver-evaluaciones',
                'asignar-roles',
            ],
        ];

        // Crear roles y asignar permisos
        foreach ($rolesPermissions as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);

            // Asignar permisos a cada rol
            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                if ($permission) {
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
