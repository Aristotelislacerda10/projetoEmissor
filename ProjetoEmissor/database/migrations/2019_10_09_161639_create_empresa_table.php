<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_emp');
            $table->string('cnpj_emp');
            $table->string('insc_estadual')->nullable($value = true);
            $table->string('cep_emp')->nullable($value = true);
            $table->string('endereco_emp', 60)->nullable($value = true);
            $table->integer('numero_end')->nullable($value = true);
            $table->string('bairro', 20)->nullable($value = true);
            $table->integer('ibge')->nullable($value = true);
            $table->string('cidade', 10)->nullable($value = true);
            $table->string('estado', 10)->nullable($value = true);
            $table->string('fone')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('Resp_emp')->nullable($value = true);
            $table->string('cpf_resp')->nullable($value = true);
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
        Schema::dropIfExists('empresa');
    }
}
