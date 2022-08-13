<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto_acumulado',
        'qty_boletos',
        'habilitados',
        'facturas',
        'id_participante',
    ];
}
