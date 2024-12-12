<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('numero_hojas');
            $table->date('fecha_creacion'); // Document creation date
            $table->string('estado'); // Document status
            $table->foreignId('id_evaluado')->constrained('evaluados')->onDelete('cascade'); // Foreign key to evaluados
            $table->foreignId('id_area')->constrained('areas'); // Foreign key to areas
            $table->foreignId('id_carpeta')->nullable()->constrained('carpetas')->onDelete('cascade'); // Relation to carpetas
            $table->string('pdf_url')->nullable(); // Store the PDF file path
            $table->timestamps(); // created_at and updated_at fields
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
};