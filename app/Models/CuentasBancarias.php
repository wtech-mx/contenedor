<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasBancarias extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'cuentas_bancarias';

    protected $fillable = [
        'id_proveedores',
        'cuenta_bancaria',
        'nombre_banco',
        'cuenta_clabe',
    ];

    public function Proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedores');
    }
}
