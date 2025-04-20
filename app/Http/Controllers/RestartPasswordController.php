<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;

class RestartPasswordController extends Controller
{
    public function showForm($token) {
        return view('auth.restart', ['token' => $token]);
    }

    public function processar(Request $request, $token)
    {
        $request->validate([
            'contrasenya' => 'required|min:8|regex:/[0-9]/|regex:/[A-Z]/|regex:/[a-z]/',
            'contrasenya2' => 'same:contrasenya',
        ], [
            'contrasenya.regex' => 'la contrasenya ha de contenir almenys una majúscula, una minúscula i un número ❌',
            'contrasenya2.same' => 'les contrasenyes no coincideixen ❌',
        ]);

        $usuari = Usuari::where('token', $token)->first();

        if (!$usuari || now()->greaterThan($usuari->expiracio_token)) {
            return back()->withErrors(['el token no es valid o ha caducat ❌']);
        }

        $usuari->contrasenya = bcrypt($request->contrasenya);
        $usuari->token = null;
        $usuari->expiracio_token = null;
        $usuari->save();

        return redirect()->route('login')->with('status', "la contrasenya s'ha actualitzat correctament ✅");
    }
}
