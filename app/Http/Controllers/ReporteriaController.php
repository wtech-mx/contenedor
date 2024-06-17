<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Bancos;
use App\Models\Client;
use App\Models\Cotizaciones;
use App\Models\Proveedor;
use App\Models\Subclientes;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

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

        $cotizaciones = [];

        if ($id_client !== null) {
            $cotizaciones = Cotizaciones::where('id_cliente', $id_client)
            ->where(function($query){
                $query->where('estatus', '=', 'Aprobada')
                       ->orWhere('estatus', '=', 'Finalizado');
            })
            ->where('restante', '>', 0)
            ->get();
        }

        return view('reporteria.cxc.index', compact('clientes', 'cotizaciones'));
    }

    public function export(Request $request){
        $fecha = date('Y-m-d');
        $fechaCarbon = Carbon::parse($fecha);

        $cotizacionIds = $request->input('cotizacion_ids', []);
        if (empty($cotizacionIds)) {
            return redirect()->back()->with('error', 'No se seleccionaron cotizaciones.');
        }

        $cotizaciones = Cotizaciones::whereIn('id', $cotizacionIds)->get();
        $bancos_oficiales = Bancos::where('tipo', '=', 'Oficial')->get();
        $bancos_no_oficiales = Bancos::where('tipo', '=', 'No Oficial')->get();

        $pdf = PDF::loadView('reporteria.cxc.pdf', compact('cotizaciones', 'fechaCarbon', 'bancos_oficiales', 'bancos_no_oficiales'))->setPaper([0, 0, 595, 1200], 'landscape');
        return $pdf->stream();
        // return $pdf->download('cotizaciones_seleccionadas.pdf');
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

        $pdf = PDF::loadView('reporteria.cxp.pdf', compact('cotizaciones', 'fechaCarbon', 'bancos_oficiales', 'bancos_no_oficiales'))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return $pdf->download('cotizaciones_seleccionadas.pdf');
    }
}
