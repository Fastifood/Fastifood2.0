<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoPedidosController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        return view('pedidos.historico-pedidos', [
            'nomeDoUsuario' => $usuario->nome
        ]);
    }
}
