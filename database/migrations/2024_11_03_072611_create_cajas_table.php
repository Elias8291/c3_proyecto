<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->integer('numero_caja');  // Número de caja
            $table->string('mes');  // Mes asociado a la caja
            $table->year('anio');  // Año asociado a la caja
            $table->string('ubicacion');  // Ubicación de la caja
            $table->string('rango_alfabetico');  // Rango alfabético de documentos en la caja
            $table->integer('maximo_carpetas')->default(0);  // Máximo de carpetas permitidas en la caja
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
        Schema::dropIfExists('cajas');
    }
}
