<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_carpeta',
        'id_evaluado',
        'id_area',
        'numero_hojas',
        'estado',
        'fecha_creacion',
        'pdf_url'  // Asegúrate de que este campo esté aquí
    ];

    /**
     * Obtener el evaluado asociado con el documento.
     */
    public function evaluado()
    {
        return $this->belongsTo(Evaluado::class, 'id_evaluado');
    }

    /**
     * Obtener el área asociada con el documento.
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    /**
     * Obtener la carpeta asociada con el documento.
     */
    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class, 'id_carpeta');
    }
}
