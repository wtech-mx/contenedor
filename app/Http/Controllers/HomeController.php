<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizaciones;
use App\Models\Asignaciones;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $cotizaciones = Cotizaciones::where('estatus','=','Pendiente')->get();
        $events = [];
        $appointments = Asignaciones::get();


        foreach ($appointments as $appointment) {
            if($appointment->id_operador == NULL){
                $description = 'Proveedor: ' . $appointment->Proveedor->nombre . ' - ' . $appointment->Proveedor->telefono . '<br>' . 'Costo viaje: ' . $appointment->precio;
            }else{
                $description = 'Operador: ' . $appointment->Operador->nombre . ' - ' . $appointment->Operador->telefono . '<br>' . 'Camion: ' . $appointment->Camion->num_serie . ' - ' . $appointment->Camion->modelo . '<br>' . 'Chasis: ' . $appointment->Chasis->num_serie . ' - ' . $appointment->Chasis->modelo . '<br>';
            }

            $description = str_replace('<br>', "\n", $description);

            $events[] = [
                'title' => 'Num contenedor: #' . $appointment->Contenedor->num_contenedor,
                'description' => $description,
                'start' => $appointment->fecha_inicio,
                'end' => $appointment->fecha_fin,
            ];


            // Define la URL de la ruta dentro del bucle para evitar errores cuando no hay asignaciones
            $urlCotizaciones = route('edit.cotizaciones',  $appointment->Contenedor->id_cotizacion);
        }

        // Verifica si hay algún $appointment antes de asignar $urlCotizaciones
        if (!isset($urlCotizaciones)) {
            $urlCotizaciones = null; // O asigna un valor predeterminado si prefieres
        }

        return view('dashboard', compact('cotizaciones','events','urlCotizaciones'));

    }
}
