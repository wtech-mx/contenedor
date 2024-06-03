<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'direccion',
        'rfc',
        'correo',
        'telefono',
        'regimen_fiscal',
        'email',
        'fecha',
    ];


}
