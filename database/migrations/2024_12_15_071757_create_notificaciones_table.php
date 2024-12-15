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
            $table->foreignId('usuario_emisor_id')->constrained('users');
            $table->foreignId('usuario_receptor_id')->constrained('users');
            $table->foreignId('area_id')->constrained('areas');
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