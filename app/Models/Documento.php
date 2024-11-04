<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'numero_hojas',
        'fecha_creacion',
        'motivo_evaluacion',
        'estado',
        'id_evaluado',
        'id_area',
        'id_carpeta'
    ];

    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class, 'id_carpeta');
    }
}
