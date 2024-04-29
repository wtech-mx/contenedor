<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
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
        $banco->save();

        return redirect()->route('index.bancos')
            ->with('success', 'Banco creado exitosamente.');

    }

    public function update(Request $request, Bancos $id)
    {

        $id->update($request->all());

        return redirect()->back()->with('success', 'Banco editado exitosamente');
    }
}
