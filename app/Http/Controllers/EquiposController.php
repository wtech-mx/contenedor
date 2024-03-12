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
        if($request->get('marca') != NULL){
            $proveedor->tipo = '3.A Tractos / Camiones';
            $proveedor->marca = $request->get('marca');
            $proveedor->year = $request->get('year');
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

            $proveedor->fecha = $request->get('fecha');
            $proveedor->save();
        }else if($request->get('marca_chasis') != NULL){
            $proveedor->tipo = '3.B Chasis / Plataforma';
            $proveedor->marca = $request->get('marca_chasis');
            $proveedor->year = $request->get('year_chasis');
            $proveedor->num_serie = $request->get('num_serie_chasis');
            $proveedor->modelo = $request->get('modelo_chasis');
            $proveedor->acceso = $request->get('acceso_chasis');

            if ($request->hasFile("tarjeta_circulacion_chasis")) {
                $file = $request->file('tarjeta_circulacion_chasis');
                $path = public_path() . '/equipos';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $proveedor->tarjeta_circulacion = $fileName;
            }

            if ($request->hasFile("poliza_seguro_chasis")) {
                $file = $request->file('poliza_seguro_chasis');
                $path = public_path() . '/equipos';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $proveedor->poliza_seguro = $fileName;
            }

            $proveedor->folio = $request->get('folio');
            $proveedor->fecha = $request->get('fecha_chasis');
            $proveedor->save();
        }else if($request->get('marca_doly') != NULL){
            $proveedor->tipo = 'Dolys';
            $proveedor->year = $request->get('year_doly');
            $proveedor->marca = $request->get('marca_doly');
            $proveedor->num_serie = $request->get('num_serie_doly');
            $proveedor->fecha = $request->get('fecha_doly');

            if ($request->hasFile("tarjeta_circulacion_doly")) {
                $file = $request->file('tarjeta_circulacion_doly');
                $path = public_path() . '/equipos';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $proveedor->tarjeta_circulacion = $fileName;
            }

            if ($request->hasFile("poliza_seguro_doly")) {
                $file = $request->file('poliza_seguro_doly');
                $path = public_path() . '/equipos';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $proveedor->poliza_seguro = $fileName;
            }

            $proveedor->save();
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()
            ->with('success', 'Proveedor created successfully.');

    }
}
