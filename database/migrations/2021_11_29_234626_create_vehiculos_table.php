<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca', 50);
            $table->string('idempresa', 50);
            $table->string('modelo', 50);
            $table->string('placa', 50);
            $table->string('kilometros', 50);
            $table->string('chasis', 50);
            $table->string('motor', 50);
            $table->string('numatricula', 50);
            $table->string('tservicio', 50);
            $table->string('tecnomec', 50);
            $table->string('numsoat', 50);
            $table->string('lconduccion', 50);
            $table->string('propietario', 50);
            $table->string('docpropietario', 50);
            $table->string('celular', 50);
            $table->string('observaciones', 500);
            $table->string('polizas', 500);
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
        Schema::dropIfExists('vehiculos');
    }
}
