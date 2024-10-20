<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class PedidosController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $pedidos = Pedido::all();

        return view('pedidos.pedidos', [
            'nomeDoUsuario' => $usuario->nome,
            'pedidos' => $pedidos
        ]);
    }
}
