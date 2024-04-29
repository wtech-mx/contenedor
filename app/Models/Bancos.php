<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
    use HasFactory;

    protected $table = 'bancos';

    protected $fillable = [
        'nombre_beneficiario',
        'nombre_banco',
        'cuenta_bancaria',
        'clabe',
    ];
}
