<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'nombre',
        'direccion',
        'rfc',
        'correo',
        'telefono',
        'regimen_fiscal',
        'email',
        'nombre_empresa',
        'fecha',
        'id_empresa',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            $client->id_empresa = Auth::user()->id_empresa;
        });

        static::updating(function ($client) {
            $client->id_empresa = Auth::user()->id_empresa;
        });
    }

}
