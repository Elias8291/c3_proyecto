<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'nombre_area' => 'Dirección General',
                'descripcion' => 'Área encargada de la gestión y toma de decisiones generales del C3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Archivo',
                'descripcion' => 'Área encargada del control y gestión de documentos físicos y digitales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Secretariado Ejecutivo',
                'descripcion' => 'Área responsable de la coordinación y ejecución de políticas públicas del C3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Evaluaciones Psicológicas',
                'descripcion' => 'Área encargada de las evaluaciones psicológicas de los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Evaluaciones Toxicológicas',
                'descripcion' => 'Área encargada de realizar las pruebas toxicológicas a los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Evaluaciones Médicas',
                'descripcion' => 'Área encargada de las evaluaciones médicas y el bienestar físico de los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Evaluaciones Socioeconómicas',
                'descripcion' => 'Área encargada de realizar las evaluaciones socioeconómicas de los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Control de Confianza',
                'descripcion' => 'Área encargada de supervisar el cumplimiento de los procedimientos de control de confianza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Sistemas',
                'descripcion' => 'Área encargada de la administración de la infraestructura tecnológica y soporte técnico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Capacitación y Formación',
                'descripcion' => 'Área encargada de capacitar al personal del C3 en las competencias necesarias',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
