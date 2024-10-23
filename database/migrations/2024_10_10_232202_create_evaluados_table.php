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
            $table->string('AP');  // Apellido paterno
            $table->string('AM');  // Apellido materno
            $table->string('nombre');  // Nombre del evaluado
            $table->string('CURP');  // CURP del evaluado
            $table->string('RFC')->nullable();  // RFC (opcional)
            $table->string('CUIP')->nullable();  // CUIP (opcional)
            $table->string('IFE')->nullable();  // Identificación (opcional)
            $table->string('SMN')->nullable();  // Servicio Militar Nacional (opcional)
            $table->date('fecha_apertura');  // Fecha en que se abrió el expediente
            $table->char('sexo', 1);  // Sexo del evaluado
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
