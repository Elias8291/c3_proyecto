<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $table = 'areas'; // Asegúrate de que este es el nombre de tu tabla
    protected $fillable = ['nombre'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_area');
    }
    
}
