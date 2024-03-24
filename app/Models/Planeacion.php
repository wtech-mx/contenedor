<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planeacion extends Model
{
    use HasFactory;
    protected $table = 'planeacion';

    protected $fillable = [
        'id_cotizacion',
        'camion_servicio',
        'chasis_servicio',
        'id_proveedor',
        'precio',
    ];
}
