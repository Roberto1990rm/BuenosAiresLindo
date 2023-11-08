<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{

    protected $fillable = ['nombre', 'direccion', 'descripcion', 'latitude', 'longitude','precios', 'horario', 'barrio_id'];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }
}
