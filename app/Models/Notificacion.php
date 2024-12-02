<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notificacions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'enviado_por_id',
        'usuario_destino_id',
        'mensaje',
        'area_id',
        'leida'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'leida' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relación con el usuario que envía la notificación
     */
    public function enviadoPor()
    {
        return $this->belongsTo(User::class, 'enviado_por_id');
    }

    /**
     * Relación con el usuario destinatario de la notificación
     */
    public function usuarioDestino()
    {
        return $this->belongsTo(User::class, 'usuario_destino_id');
    }

    /**
     * Relación con el área
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}