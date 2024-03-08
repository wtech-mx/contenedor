<?php

namespace App\Http\Controllers;

use App\Models\CuentasBancarias;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Session;

class ProveedorController extends Controller
{
    public function index(){

        return view('proveedores.index');
    }

    public function store(Request $request)
    {
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
        $proveedor->fecha = $fechaActual;

        if ($request->hasFile("regimen")) {
            $file = $request->file('regimen');
            $path = public_path() . '/regimen_proveedores';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $proveedor->regimen = $fileName;
        }

        $proveedor->save();

        $banco = new CuentasBancarias;
        $banco->id_proveedores = $proveedor->id;
        $banco->cuenta_bancaria = $request->get('cuenta_bancaria');
        $banco->nombre_banco = $request->get('nombre_banco');
        $banco->cuenta_clabe = $request->get('cuenta_clabe');
        $banco->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('index.proveedores')
            ->with('success', 'Proveedor created successfully.');

    }
}
