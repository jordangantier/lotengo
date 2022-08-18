<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ci_nit',
        'fecha_nac',
        'telefono',
        'email',
        'created_at',
    ];
}
