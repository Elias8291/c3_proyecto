<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    
    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class, 'id_carpeta', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($carpeta) {
            $carpeta->documentos()->each(function ($documento) {
                $documento->delete(); // Eliminar cada documento
            });
        });
    }
    

}
