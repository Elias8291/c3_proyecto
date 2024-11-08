<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cajas';

    protected $fillable = [
        'numero_caja',
        'mes',
        'anio',
        'ubicacion',
        'rango_alfabetico',
        'maximo_carpetas'
    ];

    public function carpetas()
    {
        return $this->hasMany(Carpeta::class, 'id_caja');
    }
    
}
