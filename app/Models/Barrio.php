<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'img', 'latitude', 'longitude'];



    public function bares()
{
    return $this->hasMany(Bar::class, 'barrio_id');
}
}
