<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EvaluadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        $nombresMasculinos = ["Juan", "Pedro", "Carlos", "Miguel", "Jorge", "Luis", "Andres", "Jose", "Ricardo", "Mario", "Sergio", "Fernando", "Hector", "Victor", "Adrian", "Raul"];
        $nombresFemeninos = ["Ana", "Maria", "Luisa", "Rosa", "Elena", "Clara", "Carmen", "Isabel", "Sofia", "Valeria", "Daniela", "Patricia", "Gabriela", "Mariana", "Paula", "Lorena"];
        $apellidos = ["Gonzalez", "Martinez", "Lopez", "Hernandez", "Diaz", "Perez", "Sanchez", "Ramirez", "Cruz", "Vargas", "Reyes", "Ortega", "Mendoza", "Castro", "Flores"];
        $estados = ["AS", "BC", "BS", "CC", "CL", "CM", "CS", "CH", "DF", "DG", "GT", "GR", "HG", "JC", "MC", "MN", "MS", "NT", "NL", "OC", "PL", "QT", "QR", "SP", "SL", "SR", "TC", "TS", "TL", "VZ", "YN", "ZS", "NE"];

        foreach (range(2017, 2024) as $year) {
            foreach (range(1, 12) as $month) {
                for ($i = 0; $i < 30; $i++) {
                    $fecha_apertura = $faker->dateTimeBetween("$year-$month-01", "$year-$month-" . cal_days_in_month(CAL_GREGORIAN, $month, $year));
                    $edadMinima = 18; // Mínimo 18 años de edad
                    $edadMaxima = 40; // Máximo 40 años de edad
                    $fecha_nacimiento = (clone $fecha_apertura)->modify("-" . rand($edadMinima, $edadMaxima) . " years");

                    // Elegir primer nombre y determinar el sexo
                    if ($faker->boolean) {
                        $primer_nombre = $faker->randomElement($nombresMasculinos);
                        $segundo_nombre = $faker->randomElement($nombresMasculinos);
                        $sexo = "H";
                    } else {
                        $primer_nombre = $faker->randomElement($nombresFemeninos);
                        $segundo_nombre = $faker->randomElement($nombresFemeninos);
                        $sexo = "M";
                    }

                    $primer_apellido = $this->sanitizeString($faker->randomElement($apellidos));
                    $segundo_apellido = $this->sanitizeString($faker->randomElement($apellidos));
                    $estado_nacimiento = $faker->randomElement($estados);

                    // Generar CURP
                    $curp = $this->generateCURP($primer_apellido, $segundo_apellido, $primer_nombre, $fecha_nacimiento, $sexo, $estado_nacimiento);

                    // Generar RFC
                    $rfc = $this->generateRFC($primer_apellido, $segundo_apellido, $primer_nombre, $fecha_nacimiento);

                    DB::table('evaluados')->insert([
                        'primer_nombre' => $primer_nombre,
                        'segundo_nombre' => $segundo_nombre,
                        'primer_apellido' => $primer_apellido,
                        'segundo_apellido' => $segundo_apellido,
                        'fecha_nacimiento' => $fecha_nacimiento->format('Y-m-d'),
                        'CURP' => $curp,
                        'RFC' => $rfc,
                        'sexo' => $sexo,
                        'estado_nacimiento' => $estado_nacimiento,
                        'fecha_apertura' => $fecha_apertura->format('Y-m-d'),
                        'resultado_evaluacion' => $faker->randomElement([0, 1])
                    ]);
                }
            }
        }
    }

    private function generateCURP($primer_apellido, $segundo_apellido, $primer_nombre, $fecha_nacimiento, $sexo, $estado_nacimiento)
    {
        $curp = substr($primer_apellido, 0, 1) .
                $this->getFirstVowelOrX(substr($primer_apellido, 1)) .
                substr($segundo_apellido, 0, 1) .
                substr($primer_nombre, 0, 1) .
                $fecha_nacimiento->format('ymd') .
                $sexo .
                $estado_nacimiento .
                $this->getConsonanteInterna($primer_apellido) .
                $this->getConsonanteInterna($segundo_apellido) .
                $this->getConsonanteInterna($primer_nombre) .
                strtoupper($this->sanitizeString(strval(random_int(10, 99))));

        return $curp;
    }

    private function generateRFC($primer_apellido, $segundo_apellido, $primer_nombre, $fecha_nacimiento)
    {
        $rfc = substr($primer_apellido, 0, 1) .
               $this->getFirstVowelOrX(substr($primer_apellido, 1)) .
               substr($segundo_apellido, 0, 1) .
               substr($primer_nombre, 0, 1) .
               $fecha_nacimiento->format('ymd') .
               strtoupper($this->sanitizeString(strval(random_int(100, 999))));

        return $rfc;
    }

    private function getConsonanteInterna($cadena)
    {
        preg_match('/[BCDFGHJKLMNÑPQRSTVWXYZ]/', substr($cadena, 1), $consonantes);
        return $consonantes ? $consonantes[0] : 'X';
    }

    private function getFirstVowelOrX($cadena)
    {
        preg_match('/[AEIOU]/', $cadena, $vocales);
        return $vocales ? $vocales[0] : 'X';
    }

    private function sanitizeString($string)
    {
        // Convierte a UTF-8 seguro y elimina caracteres no permitidos
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}
