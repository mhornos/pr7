<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function editar()
{
    return view('perfil.editar');
}
}
