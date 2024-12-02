<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionsTable extends Migration
{
    public function up()
    {
        Schema::create('notificacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enviado_por_id')->constrained('users');  // ID del usuario que envía la notificación (quien hace la solicitud o cancelación)
            $table->foreignId('usuario_destino_id')->constrained('users'); // ID del usuario al que va dirigida la notificación
            $table->string('mensaje');  // Mensaje de la notificación
            $table->foreignId('area_id')->nullable()->constrained('areas')->onDelete('set null');  // Relación con el área (en este caso será "Archivo")
            $table->boolean('leida')->nullable();  // Si la notificación ha sido leída o no
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notificacions');
    }
}
