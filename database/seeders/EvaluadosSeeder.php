<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EvaluadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_MX'); // Generador de datos en español

        // Años a llenar
        $years = range(2017, 2023);

        // Lista de estados federativos
        $estados = [
            'AS', 'BC', 'BS', 'CC', 'CL', 'CM', 'CS', 'CH', 'DF', 'DG',
            'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC',
            'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ',
            'YN', 'ZS', 'NE'
        ];

        foreach ($years as $year) {
            for ($i = 0; $i < 100; $i++) {
                $apellidoPaterno = $faker->lastName();
                $apellidoMaterno = $faker->lastName();
                $nombre = $faker->firstName();
                $fechaNacimiento = Carbon::createFromDate(
                    $faker->year($max = $year),
                    $faker->month,
                    $faker->dayOfMonth
                );

                $sexo = $faker->randomElement(['H', 'M']);
                $estado = $faker->randomElement($estados);

                // Generar CURP
                $curp = $this->generarCURP($nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $estado, $fechaNacimiento);

                // Generar RFC
                $rfc = $this->generarRFC($apellidoPaterno, $apellidoMaterno, $nombre, $fechaNacimiento);

                DB::table('evaluados')->insert([
                    'AP' => $apellidoPaterno,  // Apellido paterno
                    'AM' => $apellidoMaterno,  // Apellido materno
                    'nombre' => $nombre,       // Nombre del evaluado
                    'CURP' => $curp,            // CURP único
                    'RFC' => $rfc,              // RFC válido
                    'CUIP' => $faker->numerify('##########'),  // CUIP obligatorio
                    'IFE' => strtoupper($faker->bothify('######??##')),  // IFE obligatorio
                    'SMN' => $faker->numberBetween(1000, 3000),       // SMN obligatorio
                    'fecha_apertura' => $fechaNacimiento,            // Fecha dentro del año
                    'sexo' => $sexo,                                  // Sexo del evaluado
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Genera una CURP válida de forma aleatoria.
     *
     * @param string $nombre
     * @param string $apellidoPaterno
     * @param string $apellidoMaterno
     * @param string $sexo
     * @param string $estado
     * @param \DateTime $fechaNacimiento
     * @return string
     */
    private function generarCURP($nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $estado, $fechaNacimiento)
    {
        // 1. Primera letra del primer apellido
        $curp = strtoupper(substr($apellidoPaterno, 0, 1));
        
        // 2. Primera vocal interna del primer apellido
        preg_match('/[AEIOU]/', substr($apellidoPaterno, 1), $vocales);
        $curp .= $vocales[0] ?? 'X';
        
        // 3. Primera letra del segundo apellido
        $curp .= strtoupper(substr($apellidoMaterno, 0, 1));
        
        // 4. Primera letra del primer nombre
        $curp .= strtoupper(substr($nombre, 0, 1));
        
        // 5. Fecha de nacimiento (AAMMDD)
        $curp .= $fechaNacimiento->format('ymd');
        
        // 6. Sexo
        $curp .= strtoupper($sexo);
        
        // 7. Entidad federativa
        $curp .= $estado;
        
        // 8. Primera consonante interna del primer apellido
        preg_match('/[^AEIOU][AEIOU]*([^AEIOU])/i', substr($apellidoPaterno, 1), $consonantes);
        $curp .= strtoupper($consonantes[1] ?? 'X');
        
        // 9. Primera consonante interna del segundo apellido
        preg_match('/[^AEIOU][AEIOU]*([^AEIOU])/i', substr($apellidoMaterno, 1), $consonantes2);
        $curp .= strtoupper($consonantes2[1] ?? 'X');
        
        // 10. Primera consonante interna del primer nombre
        preg_match('/[^AEIOU][AEIOU]*([^AEIOU])/i', substr($nombre, 1), $consonantes3);
        $curp .= strtoupper($consonantes3[1] ?? 'X');
        
        // 11. Homoclave (generada aleatoriamente)
        $homoclave = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 2));
        $curp .= $homoclave;
        
        return $curp;
    }

    /**
     * Genera un RFC válido de forma aleatoria.
     *
     * @param string $apellidoPaterno
     * @param string $apellidoMaterno
     * @param string $nombre
     * @param \DateTime $fechaNacimiento
     * @return string
     */
    private function generarRFC($apellidoPaterno, $apellidoMaterno, $nombre, $fechaNacimiento)
    {
        // 1. Primera letra del primer apellido
        $rfc = strtoupper(substr($apellidoPaterno, 0, 1));
        
        // 2. Primera vocal interna del primer apellido
        preg_match('/[AEIOU]/', substr($apellidoPaterno, 1), $vocales);
        $rfc .= $vocales[0] ?? 'X';
        
        // 3. Primera letra del segundo apellido
        $rfc .= strtoupper(substr($apellidoMaterno, 0, 1));
        
        // 4. Primera letra del primer nombre
        $rfc .= strtoupper(substr($nombre, 0, 1));
        
        // 5. Fecha de nacimiento (AAMMDD)
        $rfc .= $fechaNacimiento->format('ymd');
        
        // 6. Homoclave (generada aleatoriamente)
        $homoclave = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 3));
        $rfc .= $homoclave;
        
        return $rfc;
    }
}
