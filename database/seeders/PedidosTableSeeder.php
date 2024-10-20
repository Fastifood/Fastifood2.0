<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Insere 10 registros de pedidos falsos
        for ($i = 0; $i < 10; $i++) {
            DB::table('pedidos')->insert([
                'nome_cliente' => $faker->name,
                'endereco_cliente' => $faker->address,
                'forma_pagamento' => $faker->word,
                'descricao_produtos' => $faker->sentence,
                'preco_produtos' => $faker->randomFloat(2, 1, 100),
                'quantidade_produtos' => $faker->numberBetween(1, 10),
                'valor_total' => $faker->randomFloat(2, 10, 500),
                'taxa_entrega' => $faker->randomFloat(2, 1, 20),
                'adicionais_produtos' => $faker->text,
                'favoritos_produtos' => $faker->boolean,
            ]);
        }
    }
}