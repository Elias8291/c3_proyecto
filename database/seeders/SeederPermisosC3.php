<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederPermisosC3 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            // Permisos relacionados con la gestión de documentos
            'ver-documentos',
            'crear-documentos',
            'editar-documentos',
            'eliminar-documentos',

            // Permisos relacionados con evaluaciones
            'ver-evaluaciones',
            'crear-evaluaciones',
            'editar-evaluaciones',
            'eliminar-evaluaciones',

            // Permisos relacionados con áreas específicas
            'ver-archivo',
            'gestionar-archivo',
            'ver-direccion-general',
            'gestionar-direccion-general',
            'ver-secretariado-ejecutivo',
            'gestionar-secretariado-ejecutivo',

            // Otros permisos administrativos generales
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'asignar-roles',
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
