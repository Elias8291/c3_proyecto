<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carpeta;

class Evaluado extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = [
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'CURP', 'RFC', 'fecha_apertura', 'sexo', 'estado_nacimiento', 'fecha_nacimiento', 'resultado_evaluacion'
    ];
    
    /**
     * Los atributos que deberían ser tratados como fechas.
     *
     * @var array
     */
    protected $dates = [
        'fecha_apertura',  // Tratar fecha_apertura como un campo de fecha
        'fecha_nacimiento',  // Tratar fecha_nacimiento como un campo de fecha
    ];

    /**
     * Relación con la tabla de carpetas.
     * Un evaluado tiene una carpeta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // En el modelo Evaluado.php
    public function carpetas()
    {
        return $this->hasMany(Carpeta::class, 'id_evaluado'); // Clave foránea en la tabla 'carpetas'
    }
    

    /**
     * Relación con la tabla de documentos.
     * Un evaluado puede tener muchos documentos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
    public function getNombreCompletoAttribute()
{
    return trim($this->primer_nombre . ' ' . $this->segundo_nombre . ' ' . $this->primer_apellido . ' ' . $this->segundo_apellido);
}

}
