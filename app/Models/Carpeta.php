<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    use HasFactory;

    protected $table = 'carpetas';

    protected $fillable = ['id_evaluado', 'id_caja'];

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'id_caja');
    }
    public function evaluado()
    {
        return $this->belongsTo(Evaluado::class, 'id_evaluado');
    }
    
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'id_carpeta');
    }

    

}
