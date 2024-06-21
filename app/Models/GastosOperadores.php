<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastosOperadores extends Model
{
    use HasFactory;
    protected $table = 'gastos_operadores';

    protected $fillable = [
        'id_asignacion',
        'id_operador',
        'otros',
        'casetas',
        'gasolina',
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
