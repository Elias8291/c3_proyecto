<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion', // Otros campos necesarios según tu lógica
    ];

    // Relación 1 a N con Documento
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    // Otras relaciones o métodos según tu lógica
}
