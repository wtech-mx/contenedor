<?php

namespace App\Providers;

use App\Models\Asignaciones;
use App\Models\Bancos;
use App\Models\Configuracion;
use App\Models\Cotizaciones;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $configuracion = Configuracion::first();

            $bancos = Bancos::all();

            foreach ($bancos as $banco) {
                // Calcular total de ingresos de cotizaciones para el banco actual
                $totalIngresos = Cotizaciones::where('id_banco1', $banco->id)
                    ->orWhere('id_banco2', $banco->id)
                    ->sum('monto1') + Cotizaciones::where('id_banco2', $banco->id)
                    ->sum('monto2');

                // Calcular total de pagos a proveedores para el banco actual
                $totalPagosProveedores = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
                    ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
                    ->where('asignaciones.id_camion', NULL)
                    ->where('cotizaciones.id_prove_banco1', $banco->id)
                    ->orWhere('cotizaciones.id_prove_banco2', $banco->id)
                    ->sum('cotizaciones.prove_monto1') + Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
                    ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
                    ->where('asignaciones.id_camion', NULL)
                    ->where('cotizaciones.id_prove_banco2', $banco->id)
                    ->sum('cotizaciones.prove_monto2');

                // Calcular total de pagos a operadores de salida para el banco actual
                $totalPagosOperadoresSalida = Asignaciones::where('id_banco1_dinero_viaje', $banco->id)
                    ->orWhere('id_banco2_dinero_viaje', $banco->id)
                    ->sum('cantidad_banco1_dinero_viaje') + Asignaciones::where('id_banco2_dinero_viaje', $banco->id)
                    ->sum('cantidad_banco2_dinero_viaje');

                // Calcular el saldo del banco actual
                $saldo =( $banco->saldo_inicial + $totalIngresos) - ($totalPagosProveedores + $totalPagosOperadoresSalida);

                // Actualizar el saldo del banco actual en la base de datos
                $banco->saldo = $saldo;
                $banco->save();
            }

            $view->with(['configuracion' => $configuracion]);
        });
    }
}
