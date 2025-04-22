<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EditarPerfilController extends Controller
{
    public function formulari()
    {
        $usuariNom = session('usuari');
        $usuari = Usuari::where('nombreUsuario', $usuariNom)->first();

        return view('perfil.editar', compact('usuari'));
    }

    //editar perfil
    public function editar(Request $request)
    {
        $usuariActual = Usuari::where('nombreUsuario', session('usuari'))->first();

        $data = $request->only(['usuari', 'correu', 'ciutat', 'imatge']);
        $errors = [];

        //comprobar si s'ha cambiat alguna dada
        if (
            $data['usuari'] == $usuariActual->nombreUsuario &&
            $data['correu'] == $usuariActual->correo &&
            $data['ciutat'] == $usuariActual->ciutat &&
            $data['imatge'] == $usuariActual->imatge
        ) {
            $errors[] = "no has modificat cap dada ❌";
        }

        //validar dades
        $validator = Validator::make($data, [
            'usuari' => 'required|max:20|unique:usuaris,nombreUsuario,' . $usuariActual->ID . ',ID',
            'correu' => 'required|email|unique:usuaris,correo,' . $usuariActual->ID . ',ID',
            'ciutat' => 'required',
            'imatge' => 'nullable|url',
        ], [
            'usuari.required' => "el nom d'usuari està buit ❌",
            'usuari.max' => "el nom no pot tenir més de 20 caràcters ❌",
            'usuari.unique' => "el nom d'usuari ja existeix ❌",
            'correu.required' => "el correu està buit ❌",
            'correu.email' => "el correu no és vàlid ❌",
            'correu.unique' => "ja hi ha un usuari vinculat a aquest correu ❌",
            'ciutat.required' => "la ciutat està buida ❌",
            'imatge.url' => "l'enllaç de la imatge no és una URL vàlida ❌",
        ]);

        $errorsCombinats = $validator->errors()->toArray();

        foreach ($errors as $error) {
            $errorsCombinats['custom'][] = $error;
        }
        
        //nomes tornar enrere si hi ha errors
        if (!empty($errorsCombinats)) {
            return back()->withErrors($errorsCombinats)->withInput();
        }

        //guardar canvis si tot es valid
        $usuariActual->nombreUsuario = $data['usuari'];
        $usuariActual->correo = $data['correu'];
        $usuariActual->ciutat = $data['ciutat'];
        $usuariActual->imatge = $data['imatge'];
        $usuariActual->save();

        //actualizar sessió
        Session::put('usuari', $data['usuari']);

        return back()->with('success', "usuari editat correctament ✅");
    }
}
