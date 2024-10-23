<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'estudiantes';

    // Desactiva los timestamps si tu tabla no tiene las columnas created_at y updated_at
    public $timestamps = true;

    // Especifica qué campos pueden ser asignados masivamente
    protected $fillable = [
        'numeroDeControl',
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'semestre',
    ];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'estudiante_id');
    }
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'inscripciones', 'estudiante_id', 'grupo_id');
    }
    // Aquí puedes definir relaciones, scopes, y otros comportamientos del modelo
}
