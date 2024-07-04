<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


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
        'id_empresa',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($empresa) {
            $empresa->id_empresa = Auth::user()->id_empresa;
        });

        static::updating(function ($empresa) {
            $empresa->id_empresa = Auth::user()->id_empresa;
        });
    }
}
