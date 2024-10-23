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
            $table->string('mes');  // Mes de almacenamiento (por ejemplo, Enero)
            $table->year('año');  // Año de almacenamiento
            $table->string('ubicacion');  // Ubicación física de la caja
            $table->string('rango_alfabetico');  // Rango alfabético de los documentos (por ejemplo, A-C)
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
