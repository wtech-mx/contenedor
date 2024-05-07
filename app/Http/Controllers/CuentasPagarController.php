<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Cotizaciones;
use Illuminate\Http\Request;
use DB;

class CuentasPagarController extends Controller
{
    public function index(){
        $cotizacionesPorCliente = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
        ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
        ->where('asignaciones.id_camion', '=', NULL)
        ->where('cotizaciones.estatus', '=', 'Aprobada')
        ->select('cotizaciones.id_cliente', DB::raw('COUNT(*) as total_cotizaciones'))
        ->groupBy('cotizaciones.id_cliente')
        ->get();

        return view('cuentas_pagar.index', compact('cotizacionesPorCliente'));
    }

    public function show($id){
        $cotizacionesPorPagar = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
        ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
        ->where('asignaciones.id_camion', '=', NULL)
        ->where('cotizaciones.estatus', '=', 'Aprobada')
        ->where('cotizaciones.id_cliente', '=', $id)
        ->select('cotizaciones.*', 'asignaciones.precio')
        ->get();

        $bancos = Bancos::get();

        return view('cuentas_pagar.show', compact('cotizacionesPorPagar', 'bancos'));
    }

    public function update(Request $request, $id){
        $cotizacion = Cotizaciones::where('id', '=', $id)->first();
        $cotizacion->prove_monto1 = $request->get('monto1');
        $cotizacion->prove_metodo_pago1 = $request->get('metodo_pago1');
        $cotizacion->id_prove_banco1 = $request->get('id_banco1');
        if ($request->hasFile("comprobante1")) {
            $file = $request->file('comprobante1');
            $path = public_path() . '/pagos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $cotizacion->prove_comprobante_pago1 = $fileName;
        }

        $cotizacion->prove_monto2 = $request->get('monto2');
        $cotizacion->prove_metodo_pago2 = $request->get('metodo_pago2');
        $cotizacion->id_prove_banco2 = $request->get('id_banco2');
        if ($request->hasFile("comprobante2")) {
            $file = $request->file('comprobante2');
            $path = public_path() . '/pagos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $cotizacion->prove_comprobante_pago2 = $fileName;
        }

        // $suma = $request->get('monto1') + $request->get('monto2');
        // $resta = $cotizacion->total - $suma;
        // $cotizacion->prove_restante = $resta;

        $cotizacion->update();

        return redirect()->back()->with('success', 'Comprobante de pago exitosamente');
    }
}
