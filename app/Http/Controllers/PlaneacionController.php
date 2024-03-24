<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\Equipo;
use App\Models\Planeacion;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class PlaneacionController extends Controller
{
    public function index(){
        $cotizaciones = Cotizaciones::where('estatus', 'Aprovada')->get();
        $equipo_chasis = Equipo::where('tipo', 'LIKE', '%Chasis%')->get();
        $equipo_camion = Equipo::where('tipo', 'LIKE', '%Camiones%')->get();
        $proveedores = Proveedor::where('tipo', 'Burreo')->get();

        return view('planeacion.index', compact('cotizaciones', 'equipo_chasis', 'equipo_camion', 'proveedores'));
    }
}
