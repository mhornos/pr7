<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use Illuminate\Support\Facades\Hash;

class CanviarPasswordController extends Controller
{
    public function form()
    {
        return view('auth.canviarPassw');
    }

    public function update(Request $request)
    {
        $request->validate([
            'contrasenya' => 'required',
            'contrasenyaNova1' => 'required|min:8|regex:/[0-9]/|regex:/[A-Z]/|regex:/[a-z]/',
            'contrasenyaNova2' => 'same:contrasenyaNova1',
        ], [
            'contrasenya.required' => 'has d\'introduir la contrasenya actual ❌',
            'contrasenyaNova1.required' => 'has d\'introduir la nova contrasenya ❌',
            'contrasenyaNova1.min' => 'la nova contrasenya ha de tenir almenys 8 caràcters ❌',
            'contrasenyaNova1.regex' => 'la nova contrasenya ha de contenir almenys una majúscula, una minúscula i un número ❌',
            'contrasenyaNova2.required' => 'has de confirmar la nova contrasenya ❌',
            'contrasenyaNova2.same' => 'les dues contrasenyes noves no coincideixen ❌',
        ]);

        $usuari = Usuari::where('nombreUsuario', session('usuari'))->first();

        if (!$usuari || !Hash::check($request->contrasenya, $usuari->contrasenya)) {
            return back()->withErrors(['la contrasenya actual no és correcta ❌']);
        }

        $usuari->contrasenya = bcrypt($request->contrasenyaNova1);
        $usuari->save();

        return back()->with('success', "contrasenya canviada correctament ✅");
    }
}
