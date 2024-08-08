<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\BancoDinero;
use App\Models\BancoDineroOpe;
use App\Models\Bancos;
use App\Models\Cotizaciones;
use App\Models\GastosGenerales;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BancosController extends Controller
{
    public function index(){
        $bancos = Bancos::where('id_empresa' ,'=',auth()->user()->id_empresa)->get();

        return view('bancos.index', compact('bancos'));
    }

    public function store(Request $request){

        $banco = new Bancos;
        $banco->nombre_beneficiario = $request->get('nombre_beneficiario');
        $banco->nombre_banco = $request->get('nombre_banco');
        $banco->cuenta_bancaria = $request->get('cuenta_bancaria');
        $banco->clabe = $request->get('clabe');
        $banco->saldo_inicial = $request->get('saldo_inicial');
        $banco->save();

        return redirect()->route('index.bancos')
            ->with('success', 'Banco creado exitosamente.');

    }

    public function edit($id){
        $banco = Bancos::where('id_empresa' ,'=',auth()->user()->id_empresa)->where('id', '=', $id)->first();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $cotizaciones = Cotizaciones::where('id_banco1', '=', $id)->orwhere('id_banco2', '=', $id)
        ->whereMonth('created_at', '=', $currentMonth)
        ->whereYear('created_at', '=', $currentYear)
        ->get();

        $proveedores = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
                    ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
                    ->where('asignaciones.id_camion', '=', NULL)
                    ->where('cotizaciones.id_prove_banco1', '=', $id)
                    ->orWhere('cotizaciones.id_prove_banco2', '=', $id)
                    ->whereMonth('cotizaciones.created_at', '=', $currentMonth)
                    ->whereYear('cotizaciones.created_at', '=', $currentYear)
                    ->select('cotizaciones.*')
                    ->get();

        $banco_dinero_entrada = BancoDinero::where('tipo', '=', 'Entrada')
        ->where(function($query) use ($id) {
            $query->where('id_banco1', '=', $id)
                  ->orWhere('id_banco2', '=', $id);
        })
        ->whereMonth('created_at', '=', $currentMonth)
        ->whereYear('created_at', '=', $currentYear)
        ->get();

        $banco_dinero_salida = BancoDinero::where('tipo', '=', 'Salida')
        ->where(function($query) use ($id) {
            $query->where('id_banco1', '=', $id)
                  ->orWhere('id_banco2', '=', $id);
        })
        ->whereMonth('created_at', '=', $currentMonth)
        ->whereYear('created_at', '=', $currentYear)
        ->get();

        $banco_dinero_salida_ope = BancoDineroOpe::where('tipo', '=', 'Salida')
        ->where('contenedores', '=', NULL)
        ->where(function($query) use ($id) {
            $query->where('id_banco1', '=', $id)
                  ->orWhere('id_banco2', '=', $id);
        })
        ->whereMonth('created_at', '=', $currentMonth)
        ->whereYear('created_at', '=', $currentYear)
        ->get();

        $banco_dinero_salida_ope_varios = BancoDineroOpe::where('tipo', '=', 'Salida')
        ->where('id_cotizacion', '=', NULL)
        ->where(function($query) use ($id) {
            $query->where('id_banco1', '=', $id)
                  ->orWhere('id_banco2', '=', $id);
        })
        ->whereMonth('created_at', '=', $currentMonth)
        ->whereYear('created_at', '=', $currentYear)
        ->get();

        $gastos_generales = GastosGenerales::where('id_banco1', '=', $id)
        ->whereMonth('created_at', '=', $currentMonth)
        ->whereYear('created_at', '=', $currentYear)
        ->get();

        return view('bancos.edit', compact('banco', 'cotizaciones', 'proveedores', 'banco_dinero_entrada', 'banco_dinero_salida', 'banco_dinero_salida_ope', 'banco_dinero_salida_ope_varios', 'gastos_generales'));
    }

    public function update(Request $request, Bancos $id)
    {

        $id->update($request->all());

        return redirect()->back()->with('success', 'Banco editado exitosamente');
    }
}
