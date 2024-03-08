<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    use HasFactory;
    protected $table = 'operadores';

    protected $fillable = [
        'nombre',
        'domicilio',
        'fecha_nacimiento',
        'comprobante_domicilio',
        'ine',
        'cedula_fiscal',
        'licencia_conducir',
        'acceso',
        'correo',
        'telefono',
        'tipo_sangre',
        'nss',
        'recomendacion',
        'foto',
    ];
}
