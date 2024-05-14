<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordenadasController extends Controller
{
    public function index(){

        return view('coordenadas.index')
    }
}
