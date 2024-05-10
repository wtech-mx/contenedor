<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Client;
use App\Models\Cotizaciones;
use App\Models\Subclientes;
use Illuminate\Http\Request;
use DB;

class CuentasCobrarController extends Controller
{
    public function index(){
        $cotizacionesPorCliente = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
        ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
        ->where('cotizaciones.estatus_pago', '=', '0')
        ->where('cotizaciones.restante', '>', 0)
        ->where('cotizaciones.estatus', '=', 'Aprobada')
        ->select('cotizaciones.id_cliente', DB::raw('COUNT(*) as total_cotizaciones'))
        ->groupBy('cotizaciones.id_cliente')
        ->get();

        return view('cuentas_cobrar.index', compact('cotizacionesPorCliente'));
    }

    public function show($id){
        $cliente = Client::where('id', '=', $id)->first();
        $cotizacionesPorPagar = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
        ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
        ->where('cotizaciones.estatus_pago', '=', '0')
        ->where('cotizaciones.restante', '>', 0)
        ->where('cotizaciones.estatus', '=', 'Aprobada')
        ->where('cotizaciones.id_cliente', '=', $id)
        ->select('cotizaciones.*')
        ->get();

        $bancos = Bancos::get();

        return view('cuentas_cobrar.show', compact('cotizacionesPorPagar', 'bancos', 'cliente'));
    }

    public function update(Request $request, $id){
        $cotizacion = Cotizaciones::where('id', '=', $id)->first();
        $cotizacion->monto1 = $request->get('monto1');
        $cotizacion->metodo_pago1 = $request->get('metodo_pago1');
        $cotizacion->id_banco1 = $request->get('id_banco1');
        if ($request->hasFile("comprobante1")) {
            $file = $request->file('comprobante1');
            $path = public_path() . '/pagos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $cotizacion->comprobante_pago1 = $fileName;
        }

        $cotizacion->monto2 = $request->get('monto2');
        $cotizacion->metodo_pago2 = $request->get('metodo_pago2');
        $cotizacion->id_banco2 = $request->get('id_banco2');
        if ($request->hasFile("comprobante2")) {
            $file = $request->file('comprobante2');
            $path = public_path() . '/pagos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $cotizacion->comprobante_pago2 = $fileName;
        }

        $suma = $request->get('monto1') + $request->get('monto2');
        $resta = $cotizacion->total - $suma;
        $cotizacion->restante = $resta;

        $cotizacion->update();

        return redirect()->back()->with('success', 'Comprobante de pago exitosamente');
    }
}
