<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use App\Models\Article; 

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //crear el usuari admin si no existeix
        if (!Usuari::where('nombreUsuario', 'admin')->exists()) {
            Usuari::create([
                'nombreUsuario' => 'admin',
                'contrasenya' => bcrypt('Admin1234_'),
                'correo' => 'admin@admin.com',
                'ciutat' => 'Barcelona',
                'imatge' => ''
            ]);
        }

        // obtenir els articles per mostrar-los a la vista
        $articles = Article::all();

        return view('home', [
            'articles' => $articles
        ]);
    }
}
