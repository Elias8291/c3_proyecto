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
        // Definir los permisos para cada rol
        $rolesPermissions = [
            'Admin' => [
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
            ],
            'Archivo' => [
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
                // No incluye permisos relacionados con usuarios y roles
            ],
            'Secretariado Ejecutivo' => [
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
                // Puedes agregar o quitar permisos según tus necesidades
            ],
            'Dirección General' => [
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
                'eliminar-caja', // Permiso adicional según necesidad
                // Puedes agregar o quitar permisos según tus necesidades
            ],
            'Evaluador' => [
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
                // No incluye permisos relacionados con usuarios, roles ni permisos de eliminación
            ],
        ];

        // Crear roles y asignar permisos
        foreach ($rolesPermissions as $roleName => $permissions) {
            // Crear o obtener el rol
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Obtener los permisos que existen en la base de datos
            $existingPermissions = Permission::whereIn('name', $permissions)->get();

            // Asignar permisos al rol
            $role->syncPermissions($existingPermissions);
        }

        // Limpiar la caché de permisos después de las asignaciones
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
