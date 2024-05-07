<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones';

    protected $fillable = [
        'id_cliente',
        'origen',
        'destino',
        'tamano',
        'peso_contenedor',
        'precio_viaje',
        'burreo',
        'maniobra',
        'estadia',
        'otro',
        'fecha_modulacion',
        'fecha_entrega',
        'iva',
        'retencion',
        'estatus',
        'sobrepeso',
        'peso_reglamentario',
        'peso_kg',
        'precio_sobre_peso',
        'precio_tonelada',
        'id_banco1',
        'id_banco2',
        'prove_restante',
    ];

    public function Cliente()
    {
        return $this->belongsTo(Client::class, 'id_cliente');
    }

    public function DocCotizacion()
    {
        return $this->hasOne(DocumCotizacion::class, 'id_cotizacion');
    }

    public function Bancos1()
    {
        return $this->hasOne(Bancos::class, 'id_banco1');
    }

    public function Bancos2()
    {
        return $this->hasOne(Bancos::class, 'id_banco2');
    }
}
