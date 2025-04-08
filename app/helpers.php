<?php

use App\Models\Usuari;

if (!function_exists('obtenirImatge')) {
    function obtenirImatge($nombreUsuario)
    {
        try {
            $usuari = Usuari::where('nombreUsuario', $nombreUsuario)->first();

            if ($usuari && $usuari->imatge && $usuari->imatge !== '') {
                return $usuari->imatge;
            }

            return asset('imgs/senseFoto.png');
        } catch (\Exception $e) {
            return asset('imgs/senseFoto.png');
        }
    }
}
