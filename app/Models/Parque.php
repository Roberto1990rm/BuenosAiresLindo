<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parque extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'calle', 'barrio_id'];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }

    
}
