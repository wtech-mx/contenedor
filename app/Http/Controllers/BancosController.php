<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Bancos;
use App\Models\Cotizaciones;
use Session;
use Illuminate\Http\Request;

class BancosController extends Controller
{
    public function index(){
        $bancos = Bancos::get();

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
        $banco = Bancos::where('id', '=', $id)->first();
        $cotizaciones = Cotizaciones::where('id_banco1', '=', $id)->orwhere('id_banco2', '=', $id)->get();
        $proveedores = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
                    ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
                    ->where('asignaciones.id_camion', '=', NULL)
                    ->where('cotizaciones.id_prove_banco1', '=', $id)
                    ->orWhere('cotizaciones.id_prove_banco2', '=', $id)
                    ->select('cotizaciones.*')
                    ->get();

        $operadores_salida = Asignaciones::where('id_banco1_dinero_viaje', '=', $id)->orwhere('id_banco2_dinero_viaje', '=', $id)->get();

        $operadores_salida_pago = Asignaciones::where('id_banco1_pago_operador', '=', $id)->orwhere('id_banco2_pago_operador', '=', $id)->get();

        return view('bancos.edit', compact('banco', 'cotizaciones', 'proveedores', 'operadores_salida', 'operadores_salida_pago'));
    }

    public function update(Request $request, Bancos $id)
    {

        $id->update($request->all());

        return redirect()->back()->with('success', 'Banco editado exitosamente');
    }
}
