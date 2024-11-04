<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpetas', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->foreignId('id_evaluado')->constrained('evaluados')->onDelete('cascade');  // Llave foránea con 'evaluados'
            $table->foreignId('id_caja')->constrained('cajas')->onDelete('cascade');  // Llave foránea con 'cajas'
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
        Schema::dropIfExists('carpetas');
    }
}
