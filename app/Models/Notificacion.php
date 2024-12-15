<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'usuario_emisor_id',
        'usuario_receptor_id',
        'area_id',
        'mensaje',
        'leida',
    ];

    public function emisor()
    {
        return $this->belongsTo(User::class, 'usuario_emisor_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'usuario_receptor_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
