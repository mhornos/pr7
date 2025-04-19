<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{   
    //includes
    public function mostrarLogin(){
        return view('auth.login');
    }   
    
    public function mostrarRegister(){
        return view('auth.register');
    }
    
    //crear compte
    public function procesarRegister(Request $request){
        //validar les dades del formulari
        $request->validate([
            'nombreUsuario' => [
                'required',
                'max:20',
                'unique:usuaris,nombreUsuario'
            ],
            'correo' => [
                'required',
                'email',
                'unique:usuaris,correo'
            ],
            'ciutat' => ['required'],
            'imatge' => ['nullable', 'url'],
            'contrasenya' => [
                'required',
                'min:8',
                'same:contrasenya2',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/'
            ],
            'contrasenya2' => ['required'],
        ], [
            //missatges d'error personalitzats
            'nombreUsuario.required' => 'falta el nom d\'usuari ❌',
            'nombreUsuario.max' => 'el nom no pot tenir més de 20 caràcters ❌',
            'nombreUsuario.unique' => 'el nom d\'usuari ja existeix ❌',
            'correo.required' => 'falta el correu ❌',
            'correo.email' => 'el correu no és vàlid ❌',
            'correo.unique' => 'ja hi ha un usuari vinculat a aquest correu ❌',
            'ciutat.required' => 'falta la ciutat ❌',
            'imatge.url' => 'l\'enllaç de la imatge no és una URL vàlida ❌',
            'contrasenya.required' => 'falta la contrasenya ❌',
            'contrasenya.same' => 'les contrasenyes no coincideixen ❌',
            'contrasenya.min' => 'la contrasenya ha de tenir almenys 8 caràcters ❌',
            'contrasenya.regex' => 'la contrasenya ha de contenir majúscula, minúscula i número ❌',
            'contrasenya2.required' => 'has de repetir la contrasenya ❌',
        ]);

        //crear el usuari
        Usuari::create([
            'nombreUsuario' => $request->nombreUsuario,
            'contrasenya' => Hash::make($request->contrasenya),
            'correo' => $request->correo,
            'ciutat' => $request->ciutat,
            'imatge' => $request->imatge,
        ]);

        //guardar el usuari a la sessio
        session(['usuari' => $request->nombreUsuario]);

        //redirigir a la pagina d'inici
        return redirect()->route('home')->with('success', 'usuari creat correctament ✅');
    }

    //tancar sessio
    public function logout(){
        session()->forget('usuari');
        return redirect()->route('home');
    }
}
