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
        'estado',
        'id_evaluado',
        'id_area',
        'id_carpeta'
    ];

    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class, 'id_carpeta');
    }


    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
    public function show($id)
{
    $caja = Caja::with('carpetas.evaluado', 'carpetas.documentos')->findOrFail($id);
    return view('cajas.show', compact('caja'));
}

}
