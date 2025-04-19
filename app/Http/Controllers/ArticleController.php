<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        //filtrar nomes pels articles del usuari loguejat
        if (session()->has('usuari')) {
            $query->where('nom_usuari', session('usuari'));
    }

        //filtres de cerca
        if ($request->filled('cercaCriteri')) {
            $criteri = $request->input('cercaCriteri');
            $query->where(function ($q) use ($criteri) {
                $q->where('marca', 'like', "%$criteri%")
                  ->orWhere('model', 'like', "%$criteri%")
                  ->orWhere('matricula', 'like', "%$criteri%")
                  ->orWhere('color', 'like', "%$criteri%")
                  ->orWhere('any', 'like', "%$criteri%")
                  ->orWhere('nom_usuari', 'like', "%$criteri%");
            });
        }

        //ordenacio
        switch ($request->orden) {
            case 'any_desc': $query->orderBy('any', 'desc'); break;
            case 'marca_asc': $query->orderBy('marca', 'asc'); break;
            case 'marca_desc': $query->orderBy('marca', 'desc'); break;
            case 'model_asc': $query->orderBy('model', 'asc'); break;
            case 'model_desc': $query->orderBy('model', 'desc'); break;
            default: $query->orderBy('any', 'asc');
        }

        //paginacio
        $resultatsPerPagina = $request->get('resultatsPerPagina', 5);
        $articles = $query->paginate($resultatsPerPagina)->withQueryString();

        return view('home', compact('articles'));
    }


}
