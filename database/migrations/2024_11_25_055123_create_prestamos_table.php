<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id(); // ID único del préstamo
            $table->foreignId('documento_id')->constrained('documentos')->onDelete('cascade'); // Documento asociado
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // Usuario que solicita el préstamo
            $table->foreignId('aprobador_id')->nullable()->constrained('users')->onDelete('cascade'); // Usuario que aprueba el préstamo
            $table->timestamp('fecha_solicitud'); // Fecha de solicitud
            $table->timestamp('fecha_aprobacion')->nullable(); // Fecha de aprobación (opcional)
            $table->timestamp('fecha_devolucion')->nullable(); // Fecha de devolución (opcional)
            $table->enum('estado', ['Pendiente', 'Aprobado', 'Devuelto', 'Rechazado']); // Estado del préstamo
            $table->timestamps(); // Fechas de creación y última actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
