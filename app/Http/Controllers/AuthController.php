<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;

class AuthController extends Controller
{
    public function mostrarLogin(){
        return view('auth.login');
    }   
    
    public function mostrarRegister(){
        return view('auth.register');
    }
    
    public function procesarRegister(Request $request){
    //validar les dades del formulari
    $request->validate([
        'nombreUsuario' => 'required|string|unique:usuaris,nombreUsuario',
        'correo' => 'required|email|unique:usuaris,correo',
        'ciutat' => 'required|string',
        'contrasenya' => 'required|string|min:6',
    ]);

    //crear el usuari
    $usuari = Usuari::create([
        'nombreUsuario' => $request->nombreUsuario,
        'correo' => $request->correo,
        'ciutat' => $request->ciutat,
        'contrasenya' => bcrypt($request->contrasenya),
    ]);

    //guardar el usuari a la sessio
    session(['usuari' => $usuari->nombreUsuario]);

    //redirigir a la pagina d'inici
    return redirect()->route('home');
}
}
