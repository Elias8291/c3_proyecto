<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\alumno;
class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';

    // Incluir 'activo' y 'periodo_id' en el arreglo $fillable para permitir la asignación masiva
    protected $fillable = [
        'clave',
        'nombre',
        'rango_alumnos_id',
        'horario_id',
        'materia_id',
        'periodo_id', // Agregar esta línea
        'activo',
    ];

    public function rangoAlumno()
    {
        return $this->belongsTo(RangoAlumno::class, 'rango_alumnos_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'grupo_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'inscripciones', 'grupo_id', 'estudiante_id');
    }
}
