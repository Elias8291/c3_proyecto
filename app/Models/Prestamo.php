<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Prestamo extends Model
{
    use HasFactory;


    protected $fillable = [
        'documento_id',
        'usuario_id', // Cambiado de 'solicitante_id' a 'usuario_id'
        'aprobador_id',
        'fecha_solicitud',
        'fecha_aprobacion',
        'fecha_devolucion',
        'estado',
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_aprobacion' => 'datetime',
        'fecha_devolucion' => 'datetime',
    ];

    /**
     * Relación con el modelo Documento.
     */
    public function documento()
{
    return $this->belongsTo(Documento::class, 'documento_id');
}


    /**
     * Relación con el usuario que solicitó el préstamo.
     */
    public function usuario() // Cambiado de 'solicitante' a 'usuario'
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }


    /**
     * Relación con el usuario que aprobó el préstamo.
     */
    public function aprobador()
    {
        return $this->belongsTo(User::class, 'aprobador_id');
    }
}
