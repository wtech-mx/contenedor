<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Client;
use App\Models\Cotizaciones;
use App\Models\Subclientes;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class ReporteriaController extends Controller
{
    public function index(){

        $clientes = Client::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        $subclientes = Subclientes::where('id_empresa' ,'=',auth()->user()->id_empresa)->orderBy('created_at', 'desc')->get();

        return view('reporteria.cotizaciones.index', compact('clientes', 'subclientes'));
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

        return view('reporteria.cotizaciones.index', compact('clientes', 'cotizaciones'));
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

        $pdf = PDF::loadView('reporteria.cotizaciones.pdf', compact('cotizaciones', 'fechaCarbon', 'bancos_oficiales', 'bancos_no_oficiales'))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return $pdf->download('cotizaciones_seleccionadas.pdf');
    }
}
