<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Session;

class EquiposController extends Controller
{
    public function index(){
        $fechaActual = date('Y-m-d');
        $equipos = Equipo::get();

        return view('equipos.index', compact('equipos', 'fechaActual'));
    }

    public function store(Request $request){

        $proveedor = new Equipo;
        if($request->get('marca') == NULL){
            $tipo = '3.B Chasis /  Plataforma';
        }else{
            $tipo = '3.A Tractos /  Camiones';
        }
        $proveedor->tipo = $tipo;
        $proveedor->marca = $request->get('marca');
        $proveedor->year = $request->get('year');
        $proveedor->motor = $request->get('motor');
        $proveedor->num_serie = $request->get('num_serie');
        $proveedor->modelo = $request->get('modelo');
        $proveedor->acceso = $request->get('acceso');

        if ($request->hasFile("tarjeta_circulacion")) {
            $file = $request->file('tarjeta_circulacion');
            $path = public_path() . '/equipos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $proveedor->tarjeta_circulacion = $fileName;
        }

        if ($request->hasFile("poliza_seguro")) {
            $file = $request->file('poliza_seguro');
            $path = public_path() . '/equipos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $proveedor->poliza_seguro = $fileName;
        }

        $proveedor->folio = $request->get('folio');
        $proveedor->fecha = $request->get('fecha');
        $proveedor->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
            ->with('success', 'Proveedor created successfully.');

    }
}
