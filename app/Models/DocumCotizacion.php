<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumCotizacion extends Model
{
    use HasFactory;
    protected $table = 'docum_cotizacion';

    protected $fillable = [
        'id_cotizacion',
        'num_contenedor',
        'terminal',
        'num_autorizacion',
        'boleta_liberacion',
        'doda',
    ];

    public function Cotizacion()
    {
        return $this->belongsTo(Cotizaciones::class, 'id_cotizacion');
    }
}
