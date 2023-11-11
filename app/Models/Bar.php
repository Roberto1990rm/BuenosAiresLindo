<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\BaresController;
class Bar extends Model
{

    protected $fillable = ['nombre', 'direccion', 'descripcion', 'latitude', 'longitude','precios', 'horario', 'barrio_id','image1','image2','image3','image4',];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }
}
