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
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
    }
}
