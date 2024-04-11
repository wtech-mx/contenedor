<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Cotizaciones;
use App\Models\DocumCotizacion;
use App\Models\Equipo;
use App\Models\GastosExtras;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Session;

class CotizacionesController extends Controller
{
    public function index(){

        $cotizaciones = Cotizaciones::where('estatus','=','Pendiente')->get();
        $cotizaciones_aprovadas = Cotizaciones::where('estatus','=','Aprobada')->where('estatus_planeacion','=', NULL)->get();
        $cotizaciones_canceladas = Cotizaciones::where('estatus','=','Cancelada')->get();


        return view('cotizaciones.index', compact('cotizaciones','cotizaciones_aprovadas','cotizaciones_canceladas'));
    }

    public function create(){
        $clientes = Client::get();

        return view('cotizaciones.create',compact('clientes'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'origen' => 'required',
            'destino' => 'required',
            'tamano' => 'required'
        ]);

        if($request->get('nombre_cliente') == NULL){
            $cliente = $request->get('id_cliente');
        }else{
            $cliente = new Client;
            $cliente->nombre = $request->get('nombre_cliente');
            $cliente->correo = $request->get('correo_cliente');
            $cliente->telefono = $request->get('telefono_cliente');
            $cliente->save();

            $cliente = $cliente->id;
        }

        $cotizaciones = new Cotizaciones;
        $cotizaciones->id_cliente = $cliente;
        $cotizaciones->origen = $request->get('origen');
        $cotizaciones->destino = $request->get('destino');
        $cotizaciones->tamano = $request->get('tamano');
        $cotizaciones->peso_contenedor = $request->get('peso_contenedor');
        $cotizaciones->precio_viaje = $request->get('precio_viaje');
        $cotizaciones->burreo = $request->get('burreo');
        $cotizaciones->maniobra = $request->get('maniobra');
        $cotizaciones->estadia = $request->get('estadia');
        $cotizaciones->otro = $request->get('otro');
        $cotizaciones->fecha_modulacion = $request->get('fecha_modulacion');
        $cotizaciones->fecha_entrega = $request->get('fecha_entrega');
        $cotizaciones->iva = $request->get('iva');
        $cotizaciones->retencion = $request->get('retencion');
        $cotizaciones->precio_sobre_peso = $request->get('precio_sobre_peso');
        $cotizaciones->precio_tonelada = $request->get('precio_tonelada');
        $cotizaciones->estatus = 'Pendiente';
        $cotizaciones->save();

        $docucotizaciones = new DocumCotizacion;
        $docucotizaciones->id_cotizacion = $cotizaciones->id;
        $docucotizaciones->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('index.cotizaciones')
            ->with('success', 'Cotizacion created successfully.');

    }

    public function update_estatus(Request $request, $id){
        $this->validate($request, [
            'estatus' => 'required',
        ]);

        $cotizaciones = Cotizaciones::find($id);
        $cotizaciones->estatus = $request->get('estatus');
        $cotizaciones->update();

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->route('index.cotizaciones')
            ->with('success', 'Estatus updated successfully');
    }

    public function edit($id){
        $cotizacion = Cotizaciones::where('id', '=', $id)->first();
        $documentacion = DocumCotizacion::where('id_cotizacion', '=', $cotizacion->id)->first();
        $gastos_extras = GastosExtras::where('id_cotizacion', '=', $cotizacion->id)->get();
        $clientes = Client::get();

        return view('cotizaciones.edit', compact('cotizacion', 'documentacion', 'clientes','gastos_extras'));
    }

    public function update(Request $request, $id){

        $cotizaciones = DocumCotizacion::where('id_cotizacion', '=', $id)->first();
        $cotizaciones->num_contenedor = $request->get('num_contenedor');
        $cotizaciones->terminal = $request->get('terminal');
        $cotizaciones->num_autorizacion = $request->get('num_autorizacion');

        if ($request->hasFile("boleta_liberacion")) {
            $file = $request->file('boleta_liberacion');
            $path = public_path() . '/cotizaciones/cotizacion'. $id;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $cotizaciones->boleta_liberacion = $fileName;
        }

        if ($request->hasFile("doda")) {
            $file = $request->file('doda');
            $path = public_path() . '/cotizaciones/cotizacion'. $id;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $cotizaciones->doda = $fileName;
        }

        $cotizaciones->update();

        $cotizaciones = Cotizaciones::where('id', '=', $id)->first();
        $cotizaciones->id_cliente = $request->get('id_cliente');
        $cotizaciones->origen = $request->get('cot_origen');
        $cotizaciones->destino = $request->get('cot_destino');
        $cotizaciones->burreo = $request->get('cot_burreo');
        $cotizaciones->estadia = $request->get('cot_estadia');
        $cotizaciones->fecha_modulacion = $request->get('cot_fecha_modulacion');
        $cotizaciones->fecha_entrega = $request->get('cot_fecha_entrega');
        $cotizaciones->precio_viaje = $request->get('cot_precio_viaje');
        $cotizaciones->tamano = $request->get('cot_tamano');
        $cotizaciones->peso_contenedor = $request->get('cot_peso_contenedor');
        $cotizaciones->maniobra = $request->get('cot_maniobra');
        $cotizaciones->otro = $request->get('cot_otro');
        $cotizaciones->iva = $request->get('cot_iva');
        $cotizaciones->retencion = $request->get('cot_retencion');
        $cotizaciones->update();

        $gasto_descripcion = $request->input('gasto_descripcion');
        $gasto_monto = $request->input('gasto_monto');
        $ticket_ids = $request->input('ticket_id');

        for ($count = 0; $count < count($gasto_descripcion); $count++) {
            $data = array(
                'id_cotizacion' => $cotizaciones->id,
                'descripcion' => $gasto_descripcion[$count],
                'monto' => $gasto_monto[$count],
            );

            if (isset($ticket_ids[$count])) {
                // Actualizar el ticket existente
                $ticket = GastosExtras::findOrFail($ticket_ids[$count]);
                $ticket->update($data);
            } elseif($gasto_descripcion[$count] != NULL) {
                // Crear un nuevo ticket
                GastosExtras::create($data);
            }
        }

        // SUMA TOTAL DE COTIZACION
        $suma = $cotizaciones->maniobra + $cotizaciones->burreo + $cotizaciones->otro + $cotizaciones->estadia + $cotizaciones->precio_viaje + $cotizaciones->iva;

        foreach ($gasto_monto as $monto) {
            $suma += $monto;
        }
        $resta = $suma - $cotizaciones->retencion;
        $cotizaciones->total = $resta;
        $cotizaciones->update();

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->back()
            ->with('success', 'Estatus updated successfully');
    }
}
