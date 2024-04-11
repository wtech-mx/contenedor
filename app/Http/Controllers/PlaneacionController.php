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
        $cotizaciones = Cotizaciones::where('estatus', '=', 'Aprobada')->where('estatus_planeacion', '=', NULL)->get();
        $numCotizaciones = $cotizaciones->count();
        $proveedores = Proveedor::where('tipo', 'Burreo')->get();

        $equipos = Equipo::all();
        $operadores = Operador::all();
        $events = [];

        $appointments = Asignaciones::get();

        foreach ($appointments as $appointment) {

            if($appointment->id_operador == NULL){
                $description = 'Proveedor: ' . $appointment->Proveedor->nombre . ' - ' . $appointment->Proveedor->telefono . '<br>' . 'Costo viaje: ' . $appointment->precio;
            }else{
                $description = 'Operador: ' . $appointment->Operador->nombre . ' - ' . $appointment->Operador->telefono . '<br>' . 'Camion: ' . $appointment->Camion->num_serie . ' - ' . $appointment->Camion->modelo . '<br>' . 'Chasis: ' . $appointment->Chasis->num_serie . ' - ' . $appointment->Chasis->modelo . '<br>';
            }

            $description = str_replace('<br>', "\n", $description);

            $events[] = [
                'title' => 'Num contenedor: #' . $appointment->Contenedor->num_contenedor,
                'description' => $description,
                'start' => $appointment->fecha_inicio,
                'end' => $appointment->fecha_fin,
                'urlId' => $appointment->Contenedor->id_cotizacion,
            ];

        }

        return view('planeacion.index', compact('equipos', 'operadores', 'events',  'cotizaciones', 'proveedores', 'numCotizaciones'));
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

    public function asignacion(Request $request){

        $asignaciones = new Asignaciones;
        $asignaciones->fecha_inicio = $request->get('fecha_inicio');
        $asignaciones->fecha_fin = $request->get('fecha_fin');
        $asignaciones->id_chasis = $request->get('chasis');
        $asignaciones->id_camion = $request->get('camion');
        $asignaciones->id_contenedor = $request->get('num_contenedor');
        $asignaciones->id_operador = $request->get('operador');
        $asignaciones->id_proveedor = $request->get('id_proveedor');
        $asignaciones->precio = $request->get('precio');
        $asignaciones->save();

        $cotizacion = Cotizaciones::where('id', '=',  $request->get('cotizacion'))->first();
        $cotizacion->estatus_planeacion = 1;
        $cotizacion->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
            ->with('success', 'Asignacion created successfully.');

    }

}
