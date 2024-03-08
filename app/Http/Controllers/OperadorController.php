<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperadorController extends Controller
{
    public function index(){

        return view('operadpres.index');
    }
}
