<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ocio extends Model
{
    protected $table = 'ocio'; // Especifica el nombre de la tabla
    protected $fillable = ['nombre', 'descripcion', 'imagen']; // Especifica las columnas que se pueden llenar masivamente
}

