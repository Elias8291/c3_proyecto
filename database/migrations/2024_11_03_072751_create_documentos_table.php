<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();  // Llave primaria
            $table->string('numero_hojas');
            $table->date('fecha_creacion');  // Fecha de creación del documento
            $table->string('estado');  // Estado del documento
            $table->foreignId('id_evaluado')->constrained('evaluados')->onDelete('cascade');  // Llave foránea con 'evaluados'
            $table->foreignId('id_area')->constrained('areas');  // Llave foránea con 'areas'
            $table->foreignId('id_carpeta')->nullable()->constrained('carpetas')->onDelete('cascade'); // Relación con 'carpetas'
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
        Schema::dropIfExists('documentos');
    }
}
