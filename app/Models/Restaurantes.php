<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurantes extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = [
        'tipo_pessoa',
        'nome_estabelecimento',
        'cpf_responsavel',
        'email_restaurante',
        'url_restaurante',
        'password',

        'nome',
        'sobrenome',
        'email_responsavel',
        'telefone',

        'cep',
        'rua',
        'numero_casa',
        'ponto_referencia',
        'bairro',
        'cidade',
        'estado',
        'cnpj',
        'razao_social',
        'status_pagamento',
        'horario_funcionamento',
        'latitude',
        'longitude',
    ];
}

