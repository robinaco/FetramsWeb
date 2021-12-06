<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombreusuario',100);
            $table->string('tipodocto',50);
            $table->string('documento',50);
            $table->string('direccion',50);
            $table->string('email',50);
            $table->string('presidente',50);
            $table->string('municipio',50);
            $table->string('telefono',50);
            $table->string('habilitacion',50);
            $table->string('permiso',50);
            $table->integer('estado');
            $table->string('numpermiso',50);
            $table->string('numhabilitacion',50);
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
        Schema::dropIfExists('empresas');
    }
}
