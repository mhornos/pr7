<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{   
    public function mostrarLogin(){
        return view('auth.login');
    }   
    
    public function mostrarRegister(){
        return view('auth.register');
    }
    
    //iniciar sessio
    public function procesarLogin(Request $request)
    {
        $usuari = $request->input('usuari');
        $contrasenya = $request->input('contrasenya');
        $rememberMe = $request->has('remember_me');
        $recaptcha = $request->input('g-recaptcha-response');

        $errors = [];

        if (empty($usuari)) {
            $errors[] = "falta el nom d'usuari ❌";
        }

        if (empty($contrasenya)) {
            $errors[] = "falta la contrasenya ❌";
        }

        //si no omplim el recaptcha salta error
        if (Session::get('intentsFallats', 0) >= 3 && empty($recaptcha)) {
            $errors[] = "has de completar el reCAPTCHA ❌";
        }

        //si no hi ha errors, validem el captcha
        if (empty($errors) && Session::get('intentsFallats', 0) >= 3) {
            $clauSecreta = env('RECAPTCHA_SECRET');
            $resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clauSecreta&response=$recaptcha");
            $respostaClau = json_decode($resposta, true);

            if ($respostaClau["success"] != 1) {
                $errors[] = "el reCAPTCHA no es vàlid❌";
            }
        }

        // si no hi ha errors intentem iniciar sessió
        if (empty($errors)) {
            $usuariDades = Usuari::where('nombreUsuario', $usuari)->first();

            if ($usuariDades && password_verify($contrasenya, $usuariDades->contrasenya)) {
                Session::put('usuari', $usuari);
                crearCookie("salutacio", $usuari);

                if ($rememberMe) {
                    crearCookie("usuari", $usuari);
                    crearCookie("contrasenya", $contrasenya);
                } else {
                    eliminarCookie("usuari");
                    eliminarCookie("contrasenya");
                }

                Session::put('intentsFallats', 0);
                return redirect()->route('home');
            } else {
                $errors[] = "usuari o contrasenya incorrectes❌";
                Session::put('intentsFallats', Session::get('intentsFallats', 0) + 1);
            }
        }

        return back()->withErrors($errors)->withInput();
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
