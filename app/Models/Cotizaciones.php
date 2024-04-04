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
    ];

    public function Cliente()
    {
        return $this->belongsTo(Client::class, 'id_cliente');
    }

    public function DocCotizacion()
    {
        return $this->hasOne(DocumCotizacion::class, 'id_cotizacion');
    }
}
