<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_cliente');
            $table->string('endereco_cliente');
            $table->string('forma_pagamento');
            $table->string('nome_produtos');
            $table->string('imagem_produtos');
            $table->text('descricao_produtos'); // Alterado para text para descrever produtos
            $table->decimal('preco_produtos', 10, 2); // Decimal para valores monetários
            $table->integer('quantidade_produtos'); // Integer para quantidades
            $table->decimal('valor_total', 10, 2); // Decimal para valor total
            $table->decimal('taxa_entrega', 10, 2); // Decimal para taxa de entrega
            $table->text('adicionais_produtos')->nullable(); // Campos opcionais
            $table->boolean('favoritos_produtos')->default(false); // Usar boolean para favoritos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};