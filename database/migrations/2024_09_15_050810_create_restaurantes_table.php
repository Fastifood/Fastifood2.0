<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_pessoa', ['fisica', 'juridica']);
            $table->string('nome_estabelecimento');
            $table->string('cpf_responsavel')->unique();
            $table->string('email_restaurante')->unique();
            $table->string('password');
            $table->string('url_restaurante')->unique();
            $table->string('cnpj', 18)->nullable()->unique();
            $table->string('razao_social')->nullable()->unique();

            $table->string('nome');
            $table->string('sobrenome');
            $table->string('email_responsavel')->unique();
            $table->string('telefone');

            $table->string('cep', 8);
            $table->string('rua');
            $table->string('numero_casa');
            $table->string('ponto_referencia');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado', 2);
            $table->boolean('status_pagamento')->default(0);
            $table->string('horario_funcionamento')->nullable();

            $table->decimal('latitude', 10, 8); // 10 dígitos no total, 8 após a vírgula
            $table->decimal('longitude', 11, 8); // 11 dígitos no total, 8 após a vírgula
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
        Schema::dropIfExists('restaurantes');
    }
}
