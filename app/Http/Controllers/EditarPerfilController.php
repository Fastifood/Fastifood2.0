<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditarPerfilController extends Controller
{
    public function index()
    {
        $usuarios = Auth::user();

        return view('editar_perfil.editar-perfil', [
            'nomeDoUsuario' => $usuarios->nome
        ]);
    }
}
