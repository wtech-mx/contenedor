<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Bancos;
use App\Models\Client;
use App\Models\Cotizaciones;
use App\Models\Proveedor;
use App\Models\Subclientes;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ReporteriaController extends Controller
{
    public function index(){

        $clientes = Client::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        $subclientes = Subclientes::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        return view('reporteria.cxc.index', compact('clientes', 'subclientes'));
    }

    public function advance(Request $request) {
        $clientes = Client::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();
        $id_client = $request->id_client;
        $id_subcliente = $request->id_subcliente;

        $cotizaciones = [];

        if ($id_client !== null) {
            $query = Cotizaciones::where('id_cliente', $id_client)
                ->where(function($query){
                    $query->where('estatus', '=', 'Aprobada')
                          ->orWhere('estatus', '=', 'Finalizado');
                })
                ->where('restante', '>', 0);

            if ($id_subcliente !== null && $id_subcliente !== '') {
                $query->where('id_subcliente', $id_subcliente);
            }

            $cotizaciones = $query->get();
        }

        return view('reporteria.cxc.index', compact('clientes', 'cotizaciones'));
    }

    public function getSubclientes($clienteId){
        $subclientes = Subclientes::where('id_cliente', $clienteId)->get();
        return response()->json($subclientes);
    }

    public function export(Request $request)
    {
        $fecha = date('Y-m-d');
        $fechaCarbon = Carbon::parse($fecha);

        $cotizacionIds = $request->input('selected_ids', []);
        if (empty($cotizacionIds)) {
            return redirect()->back()->with('error', 'No se seleccionaron cotizaciones.');
        }

        $cotizacion = Cotizaciones::where('id', $cotizacionIds)->first();
        $user = User::where('id', '=', auth()->user()->id)->first();

        $cotizaciones = Cotizaciones::whereIn('id', $cotizacionIds)->get();
        $bancos_oficiales = Bancos::where('tipo', '=', 'Oficial')->get();
        $bancos_no_oficiales = Bancos::where('tipo', '=', 'No Oficial')->get();

        $pdf = PDF::loadView('reporteria.cxc.pdf', compact('cotizaciones', 'fechaCarbon', 'bancos_oficiales', 'bancos_no_oficiales', 'cotizacion', 'user'))->setPaper([0, 0, 595, 1200], 'landscape');


        // Generar el nombre del archivo
        $fileName = 'cotizaciones_' . implode('_', $cotizacionIds) . '.pdf';
    // Guardar el PDF en la carpeta storage
    $pdf->save(storage_path('app/public/' . $fileName));

    // Devolver el archivo PDF como respuesta
    $filePath = storage_path('app/public/' . $fileName);
    return Response::download($filePath, $fileName)->deleteFileAfterSend(true);
    }


    // ==================== C U E N T A S  P O R  P A G A R ====================
    public function index_cxp(){

        $proveedores = Proveedor::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        return view('reporteria.cxp.index', compact('proveedores'));
    }

    public function advance_cxp(Request $request) {
        $proveedores = Proveedor::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();
        $id_proveedor = $request->id_proveedor;

        if ($id_proveedor !== null) {
            $cotizaciones = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
            ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
            ->where('asignaciones.id_camion', '=', NULL)
            ->where(function($query) {
                $query->where('cotizaciones.estatus', '=', 'Aprobada')
                    ->orWhere('cotizaciones.estatus', '=', 'Finalizado');
            })
            ->where('asignaciones.id_proveedor', '=', $id_proveedor)
            ->where('cotizaciones.prove_restante', '>', 0)
            ->select('asignaciones.*', 'docum_cotizacion.num_contenedor', 'docum_cotizacion.id_cotizacion', 'cotizaciones.origen', 'cotizaciones.destino', 'cotizaciones.estatus', 'cotizaciones.prove_restante')
            ->get();

            $proveedor = Proveedor::where('id', '=', $id_proveedor)->first();
        }

        return view('reporteria.cxp.index', compact('proveedores', 'cotizaciones', 'proveedor'));
    }

    public function export_cxp(Request $request){
        $fecha = date('Y-m-d');
        $fechaCarbon = Carbon::parse($fecha);

        $cotizacionIds = $request->input('cotizacion_ids', []);
        if (empty($cotizacionIds)) {
            return redirect()->back()->with('error', 'No se seleccionaron cotizaciones.');
        }

        $cotizaciones = Asignaciones::whereIn('id', $cotizacionIds)->get();
        $bancos_oficiales = Bancos::where('tipo', '=', 'Oficial')->get();
        $bancos_no_oficiales = Bancos::where('tipo', '=', 'No Oficial')->get();

        $cotizacion = Asignaciones::where('id', $cotizacionIds)->first();
        $user = User::where('id', '=', auth()->user()->id)->first();

        $pdf = PDF::loadView('reporteria.cxp.pdf', compact('cotizaciones', 'fechaCarbon', 'bancos_oficiales', 'bancos_no_oficiales', 'cotizacion', 'user'))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return $pdf->download('cotizaciones_seleccionadas.pdf');
    }

    // ==================== V I A J E S ====================
    public function index_viajes(){

        $clientes = Client::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        $subclientes = Subclientes::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        return view('reporteria.asignaciones.index', compact('clientes', 'subclientes'));
    }

    public function advance_viajes(Request $request) {
        $clientes = Client::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();
        $subclientes = Subclientes::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        $id_client = $request->id_client;
        $id_subcliente = $request->id_subcliente;

        $asignaciones = Asignaciones::
        join('docum_cotizacion', 'asignaciones.id_contenedor', '=', 'docum_cotizacion.id') // Unir con la tabla 'docum_cotizacion' primero
        ->join('cotizaciones', 'docum_cotizacion.id_cotizacion', '=', 'cotizaciones.id') // Luego unir con 'cotizaciones'
        ->where('cotizaciones.id_empresa' ,'=', auth()->user()->id_empresa)
        ->select('asignaciones.*');

        if ($request->fecha_de && $request->fecha_hasta) {
            $inicio = $request->fecha_de;
            $fin = $request->fecha_hasta ; // Corrige el formato de tiempo final para incluir todo el día
            $asignaciones = $asignaciones->where('asignaciones.fecha_inicio', '>=', $inicio)
                                         ->where('asignaciones.fecha_fin', '<=', $fin);
        }

        if ($id_client !== null) {
            $asignaciones = $asignaciones->where('cotizaciones.id_cliente', $id_client);

            if ($id_subcliente !== null && $id_subcliente !== '') {
                $asignaciones = $asignaciones->where('cotizaciones.id_subcliente', $id_subcliente);
            }
        }

        if ($request->estatus) {
            $asignaciones = $asignaciones->where('cotizaciones.estatus', '=', $request->estatus);
        }

        $asignaciones = $asignaciones->get();

        return view('reporteria.asignaciones.index', compact('asignaciones', 'clientes', 'subclientes'));
    }

    public function export_viajes(Request $request){
        $fecha = date('Y-m-d');
        $fechaCarbon = Carbon::parse($fecha);

        $cotizacionIds = $request->input('cotizacion_ids', []);
        if (empty($cotizacionIds)) {
            return redirect()->back()->with('error', 'No se seleccionaron cotizaciones.');
        }

        $cotizaciones = Asignaciones::whereIn('id', $cotizacionIds)->get();
        $bancos_oficiales = Bancos::where('tipo', '=', 'Oficial')->get();
        $bancos_no_oficiales = Bancos::where('tipo', '=', 'No Oficial')->get();

        $cotizacion = Asignaciones::where('id', $cotizacionIds)->first();
        $user = User::where('id', '=', auth()->user()->id)->first();

        $pdf = PDF::loadView('reporteria.asignaciones.pdf', compact('cotizaciones', 'fechaCarbon', 'bancos_oficiales', 'bancos_no_oficiales', 'cotizacion', 'user'))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return $pdf->download('cotizaciones_seleccionadas.pdf');
    }
}
