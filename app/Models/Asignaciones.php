<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    use HasFactory;
    protected $table = 'asignaciones';

    protected $fillable = [
        'id_camion',
        'id_chasis',
        'id_dolys',
        'id_contenedor',
        'id_operador',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function Camion()
    {
        return $this->belongsTo(Equipo::class, 'id_camion');
    }
    public function Chasis()
    {
        return $this->belongsTo(Equipo::class, 'id_chasis');
    }
    public function Doly()
    {
        return $this->belongsTo(Equipo::class, 'id_dolys');
    }
    public function Contenedor()
    {
        return $this->belongsTo(DocumCotizacion::class, 'id_contenedor');
    }
    public function Operador()
    {
        return $this->belongsTo(Operador::class, 'id_operador');
    }
}
