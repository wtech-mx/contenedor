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
        'id_proveedor',
        'precio',
        'id_chasis2',
        'sueldo_viaje',
        'dinero_viaje',
    ];

    public function Camion()
    {
        return $this->belongsTo(Equipo::class, 'id_camion');
    }
    public function Chasis()
    {
        return $this->belongsTo(Equipo::class, 'id_chasis');
    }
    public function Chasis2()
    {
        return $this->belongsTo(Equipo::class, 'id_chasis2');
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
    public function Proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function Client()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
