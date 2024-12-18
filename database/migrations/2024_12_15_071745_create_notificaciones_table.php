<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();

            // Claves foráneas con ON DELETE CASCADE
            $table->foreignId('usuario_emisor_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('usuario_receptor_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('area_id')
                  ->constrained('areas')
                  ->onDelete('cascade');

            // Otros atributos
            $table->string('mensaje');
            $table->boolean('leida')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}
