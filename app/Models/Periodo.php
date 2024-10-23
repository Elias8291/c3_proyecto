<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    // Definir la tabla asociada con el modelo (opcional si sigue la convención de nombres)
    protected $table = 'periodos';

    // Definir los atributos que pueden ser asignados en masa
    protected $fillable = [
        'nombre',  // Agregar campo nombre
        'fecha_inicio',
        'fecha_fin',
        'estatus',
    ];

    /**
     * Obtener los grupos asociados con el periodo.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
