<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->string('idempresa');
            $table->string('aseguradora',100);
            $table->string('version',100);
            $table->string('tipopoliza',100);
            $table->string('numpoliza',100);
            $table->string('numanexo',100);
            $table->string('numcertificado',100);
            $table->string('numriesgo',100);
            $table->string('tipodocumento',100);
            $table->date('fechaexpedicion');
            $table->string('sucursarexp',100);
            $table->string('hoursin');
            $table->date('fechavigini');
            $table->date('fechavigfin');
            $table->string('hoursfin');
            $table->string('obs',500);
            $table->integer('estado');
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
        Schema::dropIfExists('polizas');
    }
}
