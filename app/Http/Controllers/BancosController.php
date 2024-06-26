<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\BancoDinero;
use App\Models\BancoDineroOpe;
use App\Models\Bancos;
use App\Models\Cotizaciones;
use Session;
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
        $cotizaciones = Cotizaciones::where('id_banco1', '=', $id)->orwhere('id_banco2', '=', $id)->get();
        $proveedores = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
                    ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
                    ->where('asignaciones.id_camion', '=', NULL)
                    ->where('cotizaciones.id_prove_banco1', '=', $id)
                    ->orWhere('cotizaciones.id_prove_banco2', '=', $id)
                    ->select('cotizaciones.*')
                    ->get();

        $banco_dinero_entrada = BancoDinero::where('tipo', '=', 'Entrada')
        ->where(function($query) use ($id) {
            $query->where('id_banco1', '=', $id)
                  ->orWhere('id_banco2', '=', $id);
        })
        ->get();

        $banco_dinero_salida = BancoDinero::where('tipo', '=', 'Salida')
        ->where(function($query) use ($id) {
            $query->where('id_banco1', '=', $id)
                  ->orWhere('id_banco2', '=', $id);
        })
        ->get();

        $banco_dinero_salida_ope = BancoDineroOpe::where('tipo', '=', 'Salida')
        ->where(function($query) use ($id) {
            $query->where('id_banco1', '=', $id)
                  ->orWhere('id_banco2', '=', $id);
        })
        ->get();

        return view('bancos.edit', compact('banco', 'cotizaciones', 'proveedores', 'banco_dinero_entrada', 'banco_dinero_salida', 'banco_dinero_salida_ope'));
    }

    public function update(Request $request, Bancos $id)
    {

        $id->update($request->all());

        return redirect()->back()->with('success', 'Banco editado exitosamente');
    }
}
