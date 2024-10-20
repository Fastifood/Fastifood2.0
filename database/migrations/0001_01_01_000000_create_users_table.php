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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Nome do usuário
            $table->string('sobrenome'); // Sobrenome do usúario
            $table->string('telefone'); // Telefone
            $table->string('email')->unique(); // Email único
            $table->string('password'); // password
            $table->string('cpf')->unique(); // cpf
            $table->string('cep'); // cep
            $table->string('rua'); // rua
            $table->string('numero_casa'); // rua
            $table->string('ponto_referencia'); // ponto de referencia
            $table->string('bairro'); // bairro
            $table->string('cidade'); // cidade
            $table->string('estado'); // estado
            $table->string('status');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamp('email_verified_at')->nullable(); // Verificação do email
            $table->rememberToken(); // Token de "lembrar-me"
            $table->timestamps(); // Timestamps (criado_em e atualizado_em)
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email como chave primária
            $table->string('token'); // Token de redefinição de senha
            $table->timestamp('created_at')->nullable(); // Data de criação
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
