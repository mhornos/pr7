<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function mostrarFormulari(){
        return view('perfil.canviar-password');
    }

}
