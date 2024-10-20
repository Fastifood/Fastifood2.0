<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_cliente',
        'endereco_cliente',
        'forma_pagamento',
        'nome_produtos',
        'imagem_produtos',
        'descricao_produtos',
        'preco_produtos',
        'quantidade_produtos',
        'favoritos_produtos',
        'adicionais_produtos',
        'valor_total',
        'taxa_entrega',
    ];

    protected $table = 'pedidos'; // Se o nome da tabela for diferente

    protected $casts = [
        'favoritos_produtos' => 'boolean',
        'preco_produtos' => 'decimal:2',
        'valor_total' => 'decimal:2',
        'taxa_entrega' => 'decimal:2',
    ];

    public function itens()
    {
        return $this->hasMany(Item::class);
    }
}
