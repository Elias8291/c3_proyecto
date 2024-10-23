<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $fillable = ['nombre'];

    /**
     * Relación: un área tiene muchos usuarios.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_area');
    }
}
