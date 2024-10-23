<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
USE App\Models\Carpeta;

class Evaluado extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = [
        'AP',
        'AM',
        'nombre',
        'CURP',
        'RFC',
        'CUIP',
        'IFE',
        'SMN',
        'fecha_apertura',
        'sexo',
    ];
    

    /**
     * Los atributos que deberían ser tratados como fechas.
     *
     * @var array
     */
    protected $dates = [
        'fecha_apertura',  // Tratar fecha_apertura como un campo de fecha
    ];

    /**
     * Relación con la tabla de carpetas.
     * Un evaluado tiene una carpeta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function carpeta()
    {
        return $this->hasOne(Carpeta::class);
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
}
