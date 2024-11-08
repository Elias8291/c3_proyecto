<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CajasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anios = range(2017, 2024);
        $meses = [
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
            '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];
        
        $ubicaciones = [
            'Armario 1 - Lado A', 'Armario 1 - Lado B',
            'Armario 2 - Lado A', 'Armario 2 - Lado B',
            'Armario 3 - Lado A', 'Armario 3 - Lado B',
            'Armario 4 - Lado A', 'Armario 4 - Lado B',
            'Armario 5 - Lado A', 'Armario 5 - Lado B',
            'Armario 6 - Lado A', 'Armario 6 - Lado B',
            'Armario 7 - Lado A', 'Armario 7 - Lado B',
            'Armario 8 - Lado A', 'Armario 8 - Lado B'
        ];

        $rangos_alfabeticos = ['A-C', 'D-F', 'G-I', 'J-L', 'M-O', 'P-R', 'S-U', 'V-Z'];

        foreach ($anios as $anio) {
            $numero_caja = 1; // Reinicia el número de caja para cada año

            foreach ($meses as $mesNumero => $mesNombre) {
                $contadorRango = 0; // Reinicia el contador de rangos alfabéticos en cada mes

                // Asignar múltiples cajas por mes
                for ($i = 0; $i < count($rangos_alfabeticos); $i++) {
                    if ($numero_caja > 140) { // Controla el máximo de cajas por año (ajusta según sea necesario)
                        break;
                    }

                    DB::table('cajas')->insert([
                        'numero_caja' => $numero_caja, // Número de caja secuencial
                        'mes' => $mesNombre,
                        'anio' => $anio,
                        'ubicacion' => $ubicaciones[$numero_caja % count($ubicaciones)], // Cicla las ubicaciones
                        'rango_alfabetico' => $rangos_alfabeticos[$contadorRango], // Asigna el rango alfabético
                        'maximo_carpetas' => rand(30, 35) // Capacidad aleatoria de carpetas entre 30 y 35
                    ]);

                    $numero_caja++;
                    $contadorRango++;

                    // Reinicia el contador de rangos si llega al final del array
                    if ($contadorRango >= count($rangos_alfabeticos)) {
                        $contadorRango = 0;
                    }
                }
            }
        }
    }
}
