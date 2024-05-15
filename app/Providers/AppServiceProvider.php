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
                $cotizaciones = Cotizaciones::where('id_banco1', '=', $banco->id)->orwhere('id_banco2', '=', $banco->id)->get();
                $proveedores = Cotizaciones::join('docum_cotizacion', 'cotizaciones.id', '=', 'docum_cotizacion.id_cotizacion')
                            ->join('asignaciones', 'docum_cotizacion.id', '=', 'asignaciones.id_contenedor')
                            ->where('asignaciones.id_camion', '=', NULL)
                            ->where('cotizaciones.id_prove_banco1', '=', $banco->id)
                            ->orWhere('cotizaciones.id_prove_banco2', '=', $banco->id)
                            ->select('cotizaciones.*')
                            ->get();

                $operadores_salida = Asignaciones::where('id_banco1_dinero_viaje', '=', $banco->id)->orwhere('id_banco2_dinero_viaje', '=', $banco->id)->get();

                $operadores_salida_pago = Asignaciones::where('id_banco1_dinero_viaje', '=', $banco->id)->orwhere('id_banco2_dinero_viaje', '=', $banco->id)->get();

                $total = 0;

                foreach ($cotizaciones as $item){
                    if ($item->id_banco1 == $banco->id){
                        $total += $item->monto1;
                    }elseif ($item->id_banco2 == $banco->id){
                        $total += $item->monto2;
                    }
                }

                $pagos = 0;
                $pagos_salida = 0;

                foreach ($proveedores as $item){
                    if ($item->id_prove_banco1 == $banco->id){
                        $pagos += $item->prove_monto1;
                    }elseif ($item->id_prove_banco2 == $banco->id){
                        $pagos += $item->prove_monto2;
                    }
                }

                foreach ($operadores_salida as $item){
                    if ($item->id_banco1_dinero_viaje == $banco->id){
                        $pagos_salida += $item->cantidad_banco1_dinero_viaje;
                    }elseif ($item->id_banco2_dinero_viaje == $banco->id){
                        $pagos_salida += $item->cantidad_banco2_dinero_viaje;
                    }
                }

                $total_pagos = $pagos + $pagos_salida;
                $saldo = 0;
                $saldo = ($banco->saldo_inicial + $total)- $total_pagos;

                // Actualizar el saldo del banco actual en la base de datos
                $banco->saldo = $saldo;
                $banco->save();
            }

            $view->with(['configuracion' => $configuracion]);
        });
    }
}
