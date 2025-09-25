<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DolarCotizacion extends Model
{
    protected $fillable = [
        'type',
        'nombre',       
        'compra',
        'venta',
        'cotizacion_date',
    ];
}
