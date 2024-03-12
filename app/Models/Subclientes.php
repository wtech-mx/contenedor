<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subclientes extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'subclientes';

    protected $fillable = [
        'id_cliente',
        'nombre',
        'direccion',
        'rfc',
        'correo',
        'telefono',
        'regimen_fiscal',
        'email',
        'nombre_empresa',
        'fecha',
    ];

    public function Cliente()
    {
        return $this->belongsTo(Client::class, 'id_cliente');
    }
}
