<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangoAlumno extends Model
{
    protected $table = 'rango_alumnos'; // Especifica el nombre de la tabla

    protected $fillable = ['min_alumnos', 'max_alumnos']; // Campos asignables de manera masiva

    // Los campos timestamps están habilitados por defecto
}