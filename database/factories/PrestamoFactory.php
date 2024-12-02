<?php

namespace Database\Factories;

use App\Models\Documento;
use App\Models\User;
use App\Models\Prestamo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class PrestamoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Genera un documento aleatorio relacionado con la tabla documentos
            'documento_id' => Documento::inRandomOrder()->first()->id,

            // Genera un usuario aleatorio que haya sido autenticado
            'usuario_id' => User::inRandomOrder()->first()->id,

            // Fecha de la solicitud: fecha y hora actuales
            'fecha_solicitud' => $this->faker->dateTimeThisYear,

            // Estado del préstamo, podemos definirlo de forma aleatoria entre 'Pendiente', 'Aprobado', 'Rechazado'
            'estado' => $this->faker->randomElement(['Pendiente', 'Aprobado', 'Rechazado']),
        ];
    }
}
