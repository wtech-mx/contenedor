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
        Schema::create('gastos_operadores_comprobantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_asignacion');
            $table->foreign('id_asignacion')
                ->references('id')->on('asignaciones')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_operador');
            $table->foreign('id_operador')
                ->references('id')->on('operadores')
                ->inDelete('set null');

            $table->text('otros')->nullable();
            $table->text('casetas')->nullable();
            $table->text('gasolina')->nullable();
            $table->text('comprobantes')->nullable();
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
        Schema::dropIfExists('gastos_operadores_comprobantes');
    }
};
