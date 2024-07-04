<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastosOperadoresComprobantes extends Model
{
    use HasFactory;
    protected $table = 'gastos_operadores_comprobantes';

    protected $fillable = [
        'id_asignacion',
        'id_operador',
        'otros',
        'casetas',
        'gasolina',
        'comprobantes',
    ];

    public function Asignaciones()
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion');
    }

    public function Operador()
    {
        return $this->belongsTo(Operador::class, 'id_operador');
    }
}
