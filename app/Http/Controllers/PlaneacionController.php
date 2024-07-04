<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Bancos;
use App\Models\Cotizaciones;
use App\Models\Equipo;
use App\Models\Operador;
use App\Models\Planeacion;
use App\Models\Proveedor;
use App\Models\Client;
use App\Models\Subclientes;
use App\Models\Coordenadas;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Validator;

class PlaneacionController extends Controller
{
    public function index(){
        $cotizaciones = Cotizaciones::where('id_empresa' ,'=',auth()->user()->id_empresa)->where('estatus', '=', 'Aprobada')->where('estatus_planeacion', '=', NULL)->get();
        $numCotizaciones = $cotizaciones->count();
        $proveedores = Proveedor::where('id_empresa' ,'=',auth()->user()->id_empresa)
        ->where(function ($query) {
            $query->where('tipo', '=', 'servicio de burreo')
                  ->orwhere('tipo', '>=', 'servicio de viaje');
        })
        ->get();

        $equipos = Equipo::where('id_empresa' ,'=',auth()->user()->id_empresa)->get();
        $operadores = Operador::where('id_empresa' ,'=',auth()->user()->id_empresa)->get();
        $events = [];

        $appointments = Asignaciones::where('id_empresa' ,'=',auth()->user()->id_empresa)->get();


        foreach ($appointments as $appointment) {
            if($appointment->id_operador == NULL){
                $description = 'Proveedor: ' . $appointment->Proveedor->nombre . ' - ' . $appointment->Proveedor->telefono . '<br>' . 'Costo viaje: ' . $appointment->precio;
                $tipo = 'S';
            }else{
                if($appointment->Contenedor->Cotizacion->tipo_viaje == 'Sencillo'){
                    $description = 'Tipo viaje: ' . $appointment->Contenedor->Cotizacion->tipo_viaje . '<br> <br>' .
                    'Operador: ' . $appointment->Operador->nombre . ' - ' . $appointment->Operador->telefono . '<br>' .
                    'Camion: ' . ' #' . $appointment->Camion->id_equipo . ' - ' . $appointment->Camion->num_serie . ' - ' . $appointment->Camion->modelo . '<br>' .
                    'Chasis: ' . $appointment->Chasis->num_serie . ' - ' . $appointment->Chasis->modelo . '<br>';
                }elseif($appointment->Contenedor->Cotizacion->tipo_viaje == 'Full'){
                    $description = 'Tipo viaje: ' . $appointment->Contenedor->Cotizacion->tipo_viaje . '<br> <br>' .
                    'Operador: ' . $appointment->Operador->nombre . ' - ' . $appointment->Operador->telefono . '<br>' .
                    'Camion: ' . ' #' . $appointment->Camion->id_equipo . ' - ' . $appointment->Camion->num_serie . ' - ' . $appointment->Camion->modelo . '<br>' .
                    'Chasis: ' . $appointment->Chasis->num_serie . ' - ' . $appointment->Chasis->modelo . '<br>' .
                    'Chasis 2: ' . $appointment->Chasis2->num_serie . ' - ' . $appointment->Chasis2->modelo . '<br>' .
                    'Doly: ' . $appointment->Doly->num_serie . ' - ' . $appointment->Doly->modelo . '<br>';
                }
                $tipo = 'P';
            }

            $coordenadas = Coordenadas::where('id_asignacion', '=', $appointment->id)->first();

            $description = str_replace('<br>', "\n", $description);

            $isOperadorNull = $appointment->id_operador === NULL;

            $event = [
                'title' => $tipo .' / '. $appointment->Contenedor->Cotizacion->Cliente->nombre . ' / #' . $appointment->Contenedor->Cotizacion->DocCotizacion->num_contenedor,
                'description' => $description,
                'start' => $appointment->fecha_inicio,
                'end' => $appointment->fecha_fin,
                'urlId' => $appointment->id,
                'idCotizacion' => $appointment->Contenedor->id_cotizacion,
                'isOperadorNull' => $isOperadorNull,
                'nombreOperadorSub' => $appointment->nombreOperadorSub ?? '',
                'telefonoOperadorSub' => $appointment->telefonoOperadorSub ?? '',
                'placasOperadorSub' => $appointment->placasOperadorSub ?? '',
            ];


            // Verificar si $coordenadas no es null antes de acceder a su propiedad id
            if ($coordenadas !== null) {
                $event['idCoordenda'] = $appointment->id;
            }

            if ($appointment->Operador !== null) {
                $event['telOperador'] = $appointment->Operador->telefono;
            }
            // else{
            //     $event['telOperador'] = '5585314498';
            // }

            $events[] = $event;

        }

        return view('planeacion.index', compact('equipos', 'operadores', 'events',  'cotizaciones', 'proveedores', 'numCotizaciones'));
    }

    public function equipos(Request $request){
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        if($fechaInicio  &&  $fechaFin){
            $camionesAsignados = Asignaciones::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->whereNotNull('id_camion')
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('fecha_inicio', '<=', $fechaFin)
                      ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->pluck('id_camion');

            $camionesNoAsignados = Equipo::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->where('tipo', 'LIKE', '%Camiones%')
            ->whereNotIn('id', $camionesAsignados)
            ->orWhereNotIn('id', function ($query) {
                $query->select('id_camion')->from('asignaciones')->whereNull('id_camion');
            })
            ->get();

            $chasisAsignados = Asignaciones::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->whereNotNull('id_chasis')
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('fecha_inicio', '<=', $fechaFin)
                      ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->pluck('id_chasis');

            $chasisNoAsignados = Equipo::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->where('tipo', 'LIKE', '%Chasis%')
                ->whereNotIn('id', $chasisAsignados)
                ->orWhereNotIn('id', function ($query) {
                    $query->select('id_chasis')->from('asignaciones')->whereNull('id_chasis');
                })
                ->get();

            $dolysAsignados = Asignaciones::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->whereNotNull('id_camion')
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('fecha_inicio', '<=', $fechaFin)
                        ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->pluck('id_camion');

            $dolysNoAsignados = Equipo::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->where('tipo', 'LIKE', '%Dolys%')
                ->whereNotIn('id', $dolysAsignados)
                ->orWhereNotIn('id', function ($query) {
                    $query->select('id_camion')->from('asignaciones')->whereNull('id_camion');
                })
                ->get();

            $operadorAsignados = Asignaciones::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->whereNotNull('id_operador')
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->where('fecha_inicio', '<=', $fechaFin)
                        ->where('fecha_fin', '>=', $fechaInicio);
            })
            ->pluck('id_operador');

            $operadorNoAsignados = Operador::where('id_empresa' ,'=',auth()->user()->id_empresa)
            ->whereNotIn('id', $operadorAsignados)
                ->orWhereNotIn('id', function ($query) {
                    $query->select('id_operador')->from('asignaciones')->whereNull('id_operador');
                })
                ->get();


            $bancos = Bancos::where('id_empresa' ,'=',auth()->user()->id_empresa)->where('saldo', '>', '0')->get();

            return view('planeacion.resultado_equipos', ['bancos' => $bancos, 'dolysNoAsignados' => $dolysNoAsignados, 'camionesNoAsignados' => $camionesNoAsignados, 'chasisNoAsignados' => $chasisNoAsignados, 'operadorNoAsignados' => $operadorNoAsignados]);

        }
    }

    public function asignacion(Request $request){

        $validator = Validator::make($request->all(), [
            'id_proveedor' => 'required_if:viaje,Camion Subcontratado',
            'precio_proveedor' => 'required_if:viaje,Camion Subcontratado',

            'camion' => 'required_if:viaje,Camion Propio',
            'operador' => 'required_if:viaje,Camion Propio',
            'chasis' => 'required_if:viaje,Camion Propio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $asignaciones = new Asignaciones;
        $asignaciones->id_chasis = $request->get('chasis');
        $asignaciones->id_chasis2 = $request->get('chasisAdicional1');
        $asignaciones->id_dolys = $request->get('nuevoCampoDoly');
        $asignaciones->id_camion = $request->get('camion');
        $asignaciones->id_contenedor = $request->get('num_contenedor');
        $asignaciones->id_operador = $request->get('operador');
        $asignaciones->id_proveedor = $request->get('id_proveedor');
        $asignaciones->sueldo_viaje = $request->get('sueldo_viaje');
        $asignaciones->estatus_pagado = 'Pendiente Pago';
        $asignaciones->dinero_viaje = $request->get('dinero_viaje');
        if($request->get('id_proveedor') == NULL){
            $asignaciones->fecha_inicio = $request->get('fecha_inicio');
            $asignaciones->fecha_fin = $request->get('fecha_fin') . ' 23:00:00';
        }else{
            $asignaciones->fecha_inicio = $request->get('fecha_inicio_proveedor');
            $asignaciones->fecha_fin = $request->get('fecha_fin_proveedor') . ' 23:00:00';
        }

        $asignaciones->precio = $request->get('precio_proveedor');
        $asignaciones->burreo = $request->get('burreo_proveedor');
        $asignaciones->maniobra = $request->get('maniobra_proveedor');
        $asignaciones->estadia = $request->get('estadia_proveedor');
        $asignaciones->otro = $request->get('otro_proveedor');
        $asignaciones->iva = $request->get('iva_proveedor');
        $asignaciones->retencion = $request->get('retencion_proveedor');
        $asignaciones->total_proveedor = $request->get('total_proveedor');

        $asignaciones->id_banco1_dinero_viaje = $request->get('id_banco1_dinero_viaje');
        $asignaciones->cantidad_banco1_dinero_viaje = $request->get('cantidad_banco1_dinero_viaje');
        $asignaciones->id_banco2_dinero_viaje = $request->get('id_banco2_dinero_viaje');
        $asignaciones->cantidad_banco2_dinero_viaje = $request->get('cantidad_banco2_dinero_viaje');
        $asignaciones->save();

        $cotizacion = Cotizaciones::where('id', '=',  $request->get('cotizacion'))->first();
        if($request->get('id_proveedor') == NULL){
        }else{
            $cotizacion->prove_restante = $asignaciones->total_proveedor;
        }
        $cotizacion->estatus_planeacion = 1;
        $cotizacion->tipo_viaje = $request->get('tipo');
        $cotizacion->update();

        $coordenada = new Coordenadas;
        $coordenada->id_cotizacion = $cotizacion->id;
        $coordenada->id_asignacion = $asignaciones->id;
        $coordenada->save();


        $cotizacion_data = [
            "tipo_viaje" => $cotizacion->tipo_viaje,
        ];

        return response()->json(['success' => true, 'cotizacion_data' => $cotizacion_data]);
    }

    public function edit_fecha(Request $request)
    {
        $id = $request->get('urlId');
        $idCoordenda = $request->get('idCoordenda');

        $cotizaciones = Cotizaciones::find($idCoordenda);
        $cotizaciones->estatus = $request->get('finzalizar_vieje');
        $cotizaciones->update();


        $asignaciones = Asignaciones::find($id);

        if($request->get('finzalizar_vieje') == 'Finalizado'){
            $asignaciones->fecha_inicio = null;
            $asignaciones->fecha_fin = null;
        }else{
            $asignaciones->fecha_inicio = $request->get('nuevaFechaInicio');
            $asignaciones->fecha_fin = $request->get('nuevaFechaFin');
        }

        $asignaciones->nombreOperadorSub = $request->get('nombreOperadorSub');
        $asignaciones->telefonoOperadorSub = $request->get('telefonoOperadorSub');
        $asignaciones->placasOperadorSub = $request->get('placasOperadorSub');

        $asignaciones->update();

        // Devuelve una respuesta, por ejemplo:
        return response()->json(['message' => 'Fechas actualizadas correctamente']);
    }


}
