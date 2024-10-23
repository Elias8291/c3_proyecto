<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluados', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->string('primer_nombre');  // Primer nombre del evaluado
            $table->string('segundo_nombre')->nullable();  // Segundo nombre (opcional)
            $table->string('primer_apellido');  // Primer apellido del evaluado
            $table->string('segundo_apellido')->nullable();  // Segundo apellido (opcional)
            $table->string('CURP');  // CURP del evaluado (obligatorio)
            $table->string('RFC');  // RFC (obligatorio)
            $table->string('CUIP');  // CUIP (obligatorio)
            $table->string('IFE');  // Identificación (obligatorio)
            $table->string('SMN')->nullable();  // Servicio Militar Nacional (opcional)
            $table->date('fecha_apertura');  // Fecha en que se abrió el expediente
            $table->char('sexo', 1);  // Sexo del evaluado ('H' para hombre, 'M' para mujer)
            $table->string('estado_nacimiento', 2);  // Estado de nacimiento (ej: 'DF' para Ciudad de México)
            $table->date('fecha_nacimiento');  // Fecha de nacimiento del evaluado
            $table->boolean('resultado_evaluacion')->default(false);  // Resultado de evaluación (true: Aprobado, false: No Aprobado)
            $table->timestamps();  // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluados');
    }
}
