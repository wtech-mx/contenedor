<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $table = 'equipos';

    protected $fillable = [
        'tipo',
        'pies',
        'marca',
        'year',
        'motor',
        'num_serie',
        'modelo',
        'acceso',
        'tarjeta_circulacion',
        'poliza_seguro',
        'folio',
        'fecha',
        'id_equipo',
    ];
}
