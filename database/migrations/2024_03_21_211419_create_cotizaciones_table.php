<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
                ->references('id')->on('clients')
                ->inDelete('set null');

            $table->text('origen');
            $table->text('destino');
            $table->text('tamano');
            $table->text('peso_contenedor');
            $table->float('precio_viaje');
            $table->text('burreo');
            $table->text('maniobra');
            $table->text('estadia');
            $table->text('otro');
            $table->date('fecha_modulacion');
            $table->date('fecha_entrega');
            $table->float('iva');
            $table->text('retencion');
            $table->text('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
};
