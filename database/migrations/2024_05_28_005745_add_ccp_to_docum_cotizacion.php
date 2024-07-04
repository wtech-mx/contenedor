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
        Schema::table('docum_cotizacion', function (Blueprint $table) {
            $table->text('ccp')->nullable();
            $table->text('doc_ccp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docum_cotizacion', function (Blueprint $table) {
            //
        });
    }
};
