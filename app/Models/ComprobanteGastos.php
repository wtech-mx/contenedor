<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobanteGastos extends Model
{
    use HasFactory;
    protected $table = 'comprobantes_gastos';

    protected $fillable = [
        'id_asignacion',
        'imagen',
        'tipo',
    ];

    public function Asignaciones()
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion');
    }
}
