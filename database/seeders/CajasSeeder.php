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
        // Generar cajas para cada año y rango de número de caja
        $this->seedCajas(2017, 1, 110);
        $this->seedCajas(2018, 1, 95);
        $this->seedCajas(2019, 1, 115);
        $this->seedCajas(2020, 1, 140);
    }

    /**
     * Seed cajas for a specific year and range of numbers.
     *
     * @param int $anio
     * @param int $start
     * @param int $end
     * @return void
     */
    private function seedCajas(int $anio, int $start, int $end)
    {
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        
        foreach (range($start, $end) as $numero) {
            DB::table('cajas')->insert([
                'numero_caja' => $numero,
                'mes' => $meses[array_rand($meses)], // Mes aleatorio
                'anio' => $anio,
                'ubicacion' => 'Ubicación ' . $numero, // Ubicación ficticia
                'rango_alfabetico' => chr(65 + ($numero % 26)) . '-' . chr(65 + (($numero + 1) % 26)), // Rango alfabético ficticio
                'maximo_carpetas' => rand(10, 50), // Número aleatorio de carpetas permitido
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
