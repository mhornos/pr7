<?php

use App\Models\Usuari;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('obtenirImatge')) {
    function obtenirImatge($nombreUsuario)
    {
        try {
            $usuari = Usuari::where('nombreUsuario', $nombreUsuario)->first();

            //si l'usuari existeix i te una imatge
            if ($usuari && $usuari->imatge && $usuari->imatge !== '') {
                return $usuari->imatge;
            }
            //si l'usuari no existeix o no te imatge, retornem la imatge per defecte
            return asset('img/senseFoto.png');
        } catch (\Exception $e) {
            //en cas d'error, retornem la imatge per defecte
            return asset('img/senseFoto.png');
        }
    }
}

// funció per establir una cookie
function crearCookie($nom, $valor, $durada = 86400 * 30) {
    Cookie::queue(Cookie::make($nom, $valor, $durada / 60));
}

// funció per eliminar una cookie
function eliminarCookie($nom) {
    Cookie::queue(Cookie::forget($nom));
}

// funció per obtenir el valor d'una cookie
function obtenirCookie($nom) {
    return request()->cookie($nom);
}

