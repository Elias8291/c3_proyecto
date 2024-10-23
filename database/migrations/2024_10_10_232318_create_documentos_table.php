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
            $table->integer('numero_fojas');  // Número de hojas en el documento
            $table->date('fecha_creacion');  // Fecha de creación del documento
            $table->string('motivo_evaluacion');  // Motivo de la evaluación
            $table->string('folio');  // Folio del documento
            $table->string('area_origen');  // Área de origen del documento
            $table->foreignId('evaluado_id')->constrained('evaluados')->onDelete('cascade');  // Relación con evaluados
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
