<?php

namespace App\Http\Controllers;

use App\Models\CuentasBancarias;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Session;

class ProveedorController extends Controller
{
    public function index(){
        $proveedores = Proveedor::get();
        $cuentas = CuentasBancarias::get();

        return view('proveedores.index', compact('proveedores', 'cuentas'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'nombre' => 'required',
            'correo' => 'required',
            'telefono' => 'required'
        ]);

        $fechaActual = date('Y-m-d');

        $proveedor = new Proveedor;
        $proveedor->nombre = $request->get('nombre');
        $proveedor->correo = $request->get('correo');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->regimen = $request->get('regimen');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->rfc = $request->get('rfc');
        $proveedor->fecha = $fechaActual;
        $proveedor->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('index.proveedores')
            ->with('success', 'Proveedor created successfully.');

    }

    public function cuenta(Request $request){

        $banco = new CuentasBancarias;
        $banco->nombre_beneficiario = $request->get('nombre_beneficiario');
        $banco->id_proveedores = $request->get('id_proveedores');
        $banco->cuenta_bancaria = $request->get('cuenta_bancaria');
        $banco->nombre_banco = $request->get('nombre_banco');
        $banco->cuenta_clabe = $request->get('cuenta_clabe');
        $banco->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('index.proveedores')
            ->with('success', 'Proveedor created successfully.');

    }
}
