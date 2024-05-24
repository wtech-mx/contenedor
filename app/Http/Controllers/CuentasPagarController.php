<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Client;
use App\Models\Cotizaciones;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use DB;

class CuentasPagarController extends Controller
{
    public function index(){
        $cotizacionIds = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
        ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
        ->whereNull('asignaciones.id_camion')
        ->where('cotizaciones.estatus', '=', 'Aprobada')
        ->where('cotizaciones.prove_monto1', '=', NULL)
        ->select('cotizaciones.id')
        ->pluck('cotizaciones.id');

        $cotizacionesPorCliente = Cotizaciones::whereIn('id', $cotizacionIds)
            ->with(['DocCotizacion.Asignaciones.Proveedor']) // Carga las relaciones necesarias
            ->get()
            ->groupBy('DocCotizacion.Asignaciones.id_proveedor')
            ->map(function ($group) {
                return [
                    'id_proveedor' => $group->first()->DocCotizacion->Asignaciones->id_proveedor,
                    'total_cotizaciones' => $group->count(),
                    'proveedor' => $group->first()->DocCotizacion->Asignaciones->Proveedor,
                ];
        });
        return view('cuentas_pagar.index', compact('cotizacionesPorCliente'));
    }

    public function show($id){

        $cotizacionesPorPagar = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
        ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
        ->where('asignaciones.id_camion', '=', NULL)
        ->where('cotizaciones.estatus', '=', 'Aprobada')
        ->where('asignaciones.id_proveedor', '=', $id)
        ->where('cotizaciones.prove_monto1', '=', NULL)
        ->select('asignaciones.*', 'docum_cotizacion.num_contenedor', 'docum_cotizacion.id_cotizacion')
        ->get();

        $bancos = Bancos::get();
        $cliente = Proveedor::where('id', '=', $id)->first();

        return view('cuentas_pagar.show', compact('cotizacionesPorPagar', 'bancos', 'cliente'));
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
