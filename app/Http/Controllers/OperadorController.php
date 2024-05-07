<?php

namespace App\Http\Controllers;

use App\Models\Operador;
use Illuminate\Http\Request;

use App\Models\Cotizaciones;
use App\Models\DocumCotizacion;
use App\Models\Asignaciones;

use Session;

class OperadorController extends Controller
{
    public function index(){
        $operadores = Operador::get();

        $asignaciones = Asignaciones::get();
        $appointments = Asignaciones::get();

        return view('operadores.index', compact('operadores','asignaciones'));
    }

    public function show($id){
        $operador = Operador::where('id', '=', $id)->first();

        return view('operadores.show', compact('operador'));
    }

    public function store(Request $request){

        $operador = new Operador;
        $operador->nombre = $request->get('nombre');
        $operador->correo = $request->get('correo');
        $operador->telefono = $request->get('telefono');
        $operador->domicilio = $request->get('domicilio');
        $operador->fecha_nacimiento = $request->get('fecha_nacimiento');
        $operador->acceso = $request->get('acceso');
        $operador->tipo_sangre = $request->get('tipo_sangre');
        $operador->nss = $request->get('nss');
        $operador->recomendacion = $request->get('recomendacion');
        $operador->foto = $request->get('foto');

        if ($request->hasFile("comprobante_domicilio")) {
            $file = $request->file('comprobante_domicilio');
            $path = public_path() . '/operador';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $operador->comprobante_domicilio = $fileName;
        }

        if ($request->hasFile("ine")) {
            $file = $request->file('ine');
            $path = public_path() . '/operador';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $operador->ine = $fileName;
        }

        if ($request->hasFile("cedula_fiscal")) {
            $file = $request->file('cedula_fiscal');
            $path = public_path() . '/operador';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $operador->cedula_fiscal = $fileName;
        }

        if ($request->hasFile("licencia_conducir")) {
            $file = $request->file('licencia_conducir');
            $path = public_path() . '/operador';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $operador->licencia_conducir = $fileName;
        }
        $operador->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
            ->with('success', 'operador created successfully.');

    }
}
