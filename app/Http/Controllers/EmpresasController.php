<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresas;
use Session;

class EmpresasController extends Controller
{
    public function index()
    {
        $empresas = Empresas::orderBy('created_at', 'desc')->get();

        return view('empresa.index', compact('empresas'));
    }


    public function create()
    {
        $empresa = new Empresas();
        return view('empresa.create', compact('empresa'));
    }


    public function store(Request $request){

        $this->validate($request, [
            'nombre' => 'required',
            'correo' => 'required',
            'telefono' => 'required'
        ]);

        $fechaActual = date('Y-m-d');

        $empresa = new Empresas;
        $empresa->nombre = $request->get('nombre');
        $empresa->correo = $request->get('correo');
        $empresa->telefono = $request->get('telefono');
        $empresa->direccion = $request->get('direccion');
        $empresa->regimen_fiscal = $request->get('regimen_fiscal');
        $empresa->rfc = $request->get('rfc');
        $empresa->fecha = $fechaActual;
        $empresa->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
            ->with('success', 'empresae created successfully.');

    }

    public function update(Request $request, Empresas $id)
    {

        $id->update($request->all());

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->route('empresas.index')
            ->with('success', 'empresa updated successfully');
    }
}
