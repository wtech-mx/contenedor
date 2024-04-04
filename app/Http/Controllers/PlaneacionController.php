<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Cotizaciones;
use App\Models\Equipo;
use App\Models\Operador;
use App\Models\Planeacion;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class PlaneacionController extends Controller
{
    public function index(){
        $cotizaciones = Cotizaciones::where('estatus', '=', 'Aprobada')->get();
        $equipo_chasis = Equipo::where('tipo', 'LIKE', '%Chasis%')->get();
        $equipo_camion = Equipo::where('tipo', 'LIKE', '%Camiones%')->get();
        $proveedores = Proveedor::where('tipo', 'Burreo')->get();

        $equipos = Equipo::all();
        $operadores = Operador::all();
        $events = [];

        $appointments = Asignaciones::get();
        foreach ($appointments as $appointment) {
            $description = 'Operador: ' . $appointment->Operador->nombre . ' - ' . $appointment->Operador->telefono . '<br>' . 'Camion: ' . $appointment->Camion->num_serie . ' - ' . $appointment->Camion->modelo . '<br>' . 'Chasis: ' . $appointment->Chasis->num_serie . ' - ' . $appointment->Chasis->modelo . '<br>';
            $description = str_replace('<br>', "\n", $description);

            $events[] = [
                'title' => 'Num contenedor: #' . $appointment->Contenedor->num_contenedor,
                'description' => $description,
                'start' => $appointment->fecha_inicio,
                'end' => $appointment->fecha_fin,
            ];
        }

        // Define la URL de la ruta
        $urlCotizaciones = route('edit.cotizaciones', ['id' => $appointment->Contenedor->id_cotizacion]);


        return view('planeacion.index', compact('equipos', 'operadores', 'events', 'urlCotizaciones', 'cotizaciones', 'equipo_chasis', 'equipo_camion', 'proveedores'));
    }

}
