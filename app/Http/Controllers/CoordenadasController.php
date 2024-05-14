<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordenadas;

class CoordenadasController extends Controller
{
    public function index($id){

        $coordenadas = Coordenadas::find($id);


        return view('coordendas.index',compact('coordenadas'));

    }

    public function edit(Request $request, $id){
        dd($request);
        $coordenadas = Coordenadas::find($id);
        $coordenadas->registro_puerto = $request->get('registro_puerto');
        $coordenadas->update();

        return route('coordendas.index', $id,compact('coordenadas'));

    }
}
