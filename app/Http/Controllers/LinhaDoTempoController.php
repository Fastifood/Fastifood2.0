<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinhaDoTempoController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        return view('linha_do_tempo.linha-do-tempo', [
            'nomeDoUsuario' => $usuario->nome]
        );
    }
}
