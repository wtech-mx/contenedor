<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Cotizaciones;
use App\Models\Equipo;
use App\Models\Operador;
use App\Models\Planeacion;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use DB;
use Session;

class PlaneacionController extends Controller
{
    public function index(){
        $cotizaciones = Cotizaciones::where('estatus', '=', 'Aprobada')->get();
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

            // Define la URL de la ruta dentro del bucle para evitar errores cuando no hay asignaciones
            $urlCotizaciones = route('edit.cotizaciones', ['id' => $appointment->Contenedor->id_cotizacion]);
        }

        // Verifica si hay algún $appointment antes de asignar $urlCotizaciones
        if (!isset($urlCotizaciones)) {
            $urlCotizaciones = null; // O asigna un valor predeterminado si prefieres
        }

        return view('planeacion.index', compact('equipos', 'operadores', 'events', 'urlCotizaciones', 'cotizaciones', 'proveedores'));
    }

    public function equipos(Request $request){
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        if($fechaInicio  &&  $fechaFin){
            $camionesAsignados = Asignaciones::
            where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('fecha_inicio', '<=', $fechaFin)
                    ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->pluck('id_camion')
            ->toArray();

            $camionesNoAsignados = Equipo::
                where('tipo', 'LIKE', '%Camiones%')
                ->whereNotIn('id', $camionesAsignados)
                ->get();

            $chasisAsignados = Asignaciones::
            where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('fecha_inicio', '<=', $fechaFin)
                    ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->pluck('id_chasis')
            ->toArray();

            $chasisNoAsignados = Equipo::
                where('tipo', 'LIKE', '%Chasis%')
                ->whereNotIn('id', $chasisAsignados)
                ->get();

            $operadorAsignados = Asignaciones::
            where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('fecha_inicio', '<=', $fechaFin)
                    ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->pluck('id_operador')
            ->toArray();

            $operadorNoAsignados = Operador::
                whereNotIn('id', $operadorAsignados)
                ->get();


            return view('planeacion.resultado_equipos', ['camionesNoAsignados' => $camionesNoAsignados, 'chasisNoAsignados' => $chasisNoAsignados, 'operadorNoAsignados' => $operadorNoAsignados]);

        }
    }

    public function store(Request $request){

        $asignaciones = new Asignaciones;
        $asignaciones->fecha_inicio = $request->get('fecha_inicio');
        $asignaciones->fecha_fin = $request->get('fecha_fin');
        $asignaciones->id_chasis = $request->get('chasis');
        $asignaciones->id_camion = $request->get('camion');
        $asignaciones->id_contenedor = $request->get('num_contenedor');
        $asignaciones->id_operador = $request->get('operador');
        $asignaciones->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
            ->with('success', 'Asignacion created successfully.');

    }

}
