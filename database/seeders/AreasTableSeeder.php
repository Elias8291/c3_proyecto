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
                'nombre_area' => 'Psicométrico',
                'descripcion' => 'Área encargada de realizar evaluaciones psicométricas a los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Psicológico',
                'descripcion' => 'Área encargada de las evaluaciones psicológicas de los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Médico',
                'descripcion' => 'Área encargada de las evaluaciones médicas y el bienestar físico de los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Toxicológico',
                'descripcion' => 'Área encargada de realizar las pruebas toxicológicas a los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Poligráfico',
                'descripcion' => 'Área encargada de realizar pruebas poligráficas a los evaluados para evaluar su veracidad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Investigación Socioeconómica',
                'descripcion' => 'Área encargada de realizar investigaciones socioeconómicas de los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Perfiles',
                'descripcion' => 'Área encargada de la elaboración y análisis de perfiles de los evaluados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_area' => 'Programación',
                'descripcion' => 'Área responsable de definir las reglas de evaluación y gestionar documentos que los evaluados deben firmar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Áreas adicionales ya existentes en el sistema
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
                'nombre_area' => 'Sistemas',
                'descripcion' => 'Área encargada de la administración de la infraestructura tecnológica y soporte técnico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
