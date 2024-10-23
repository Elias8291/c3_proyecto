<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'estudiante_id',
        'grupo_id',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    // Eventos de modelo para actualizar el contador de inscripciones
    protected static function booted()
    {
        static::created(function ($inscripcion) {
            // Incrementar el contador cuando se crea una inscripción
            $inscripcion->grupo->increment('inscripciones_totales');
        });
    }
}
