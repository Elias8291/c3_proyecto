<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evaluado;

class EvaluadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definir datos para 10 evaluados
        $evaluadosData = [
            [
                'primer_nombre' => 'Juan',
                'segundo_nombre' => 'Carlos',
                'primer_apellido' => 'Pérez',
                'segundo_apellido' => 'Gómez',
                'CURP' => 'PEGO900101HDFRRL01',
                'RFC' => 'PEGO900101ABC',
               
                'fecha_apertura' => '2024-01-10',
                'sexo' => 'H',
                'estado_nacimiento' => 'DF',
                'fecha_nacimiento' => '1990-01-01',
                'resultado_evaluacion' => true,
            ],
            [
                'primer_nombre' => 'María',
                'segundo_nombre' => 'Luisa',
                'primer_apellido' => 'Rodríguez',
                'segundo_apellido' => 'Hernández',
                'CURP' => 'ROHM920505MDFRNN01',
                'RFC' => 'ROHM920505XYZ',
                'fecha_apertura' => '2024-02-01',
                'sexo' => 'M',
                'estado_nacimiento' => 'DF',
                'fecha_nacimiento' => '1992-05-05',
                'resultado_evaluacion' => false,
            ],
            // Otros 8 evaluados con datos similares
        ];
        

        // Crear registros en la base de datos
        foreach ($evaluadosData as $evaluado) {
            Evaluado::create($evaluado);
        }
    }
}
