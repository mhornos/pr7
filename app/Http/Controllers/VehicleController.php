<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Article;

class VehicleController extends Controller
{
    public function formulariInserir(Request $request) {
        $articles = $this->obtenirArticlesFiltrats($request);
        return view('vehicle.inserir', compact('articles'));
    }

    //inserir nou vehicle
    public function inserir(Request $request){
        $usuari = session('usuari');

        $validator = Validator::make($request->all(), [
            'marca' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'any' => 'required|integer|max:' . now()->year,
            'color' => 'required|string|max:50',
            'matricula' => 'required|string|max:12|unique:article,matricula',
            'imatge' => 'nullable|url',
        ], [
            'marca.required' => 'has d’introduir la marca del vehicle ❌',
            'model.required' => 'has d’introduir el model del vehicle ❌',
            'any.required' => 'has d’introduir l’any del vehicle ❌',
            'any.numeric' => "l'any ha de ser un número ❌",
            'any.max' => "l'any no pot ser superior a l'actual ❌",
            'color.required' => 'has d’introduir el color del vehicle ❌',
            'matricula.required' => 'has d’introduir la matrícula del vehicle ❌',
            'matricula.max' => 'la matrícula no pot tenir més de 12 caràcters ❌',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Article::create([
            'marca' => $request->marca,
            'model' => $request->model,
            'any' => $request->any,
            'color' => $request->color,
            'matricula' => $request->matricula,
            'imatge' => $request->imatge,
            'nom_usuari' => $usuari,
        ]);

        return back()->with('success', 'article inserit correctament ✅');
    }

    public function formulariModificar(Request $request) {
        $articles = $this->obtenirArticlesFiltrats($request);
        return view('vehicle.modificar', compact('articles'));
    }

    //modificar vehicle
    public function modificar(Request $request) {
        $usuari = session('usuari');

        $request->validate([
            'id' => 'required|numeric',
            'matricula' => 'nullable|string|max:12',
        ], [
            'id.required' => 'has d’introduir l’ID del vehicle ❌',
            'matricula.max' => 'la matrícula no pot tenir més de 12 caràcters ❌',
        ]);

        $article = Article::find($request->id);

        if (!$article) {
            return back()->withErrors(['no s\'ha trobat cap article amb aquest ID ❌']);
        }

        if ($article->nom_usuari !== $usuari) {
            return back()->withErrors(['no tens permís per modificar aquest article ❌']);
        }

        if ($request->matricula && Article::where('matricula', $request->matricula)->where('id', '!=', $article->id)->exists()) {
            return back()->withErrors(["la matrícula '{$request->matricula}' ja existeix en un altre article ❌"]);
        }

        $article->fill(array_filter([
            'marca' => $request->marca,
            'model' => $request->model,
            'any' => $request->any,
            'color' => $request->color,
            'matricula' => $request->matricula,
            'imatge' => $request->imatge,
        ]));

        if ($article->isDirty()) {
            $article->save();
            return back()->with('success', "article amb ID {$article->id} modificat correctament ✅");
        } else {
            return back()->withErrors(['no s\'han proporcionat dades per modificar ❌']);
        }
    }


    public function formulariEsborrar(Request $request) {
        $articles = $this->obtenirArticlesFiltrats($request);
        return view('vehicle.esborrar', compact('articles'));
    }

    //esborrar vehicle
    public function esborrar(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ], [
            'id.required' => "falta l'ID ❌",
        ]);
    
        $usuari = session('usuari');
        $id = $request->input('id');
    
        $article = Article::find($id);
    
        if (!$article) {
            return back()->withErrors(["no s'ha trobat cap article amb aquest ID ❌"]);
        }
    
        if ($article->nom_usuari !== $usuari) {
            return back()->withErrors(["no tens permís per eliminar aquest article ❌"]);
        }
    
        $article->delete();
    
        return back()->with('success', "article amb ID $id eliminat correctament ✅");
    }
    

    //obtenir llista d'articles per tornar-la a mostrar-la sota cada formulari
    private function obtenirArticlesFiltrats(Request $request){
        $query = Article::with('usuari');

        if ($request->filled('cercaCriteri')) {
            $criteri = $request->input('cercaCriteri');
            $query->where(function ($q) use ($criteri) {
                $q->where('marca', 'like', "%$criteri%")
                  ->orWhere('model', 'like', "%$criteri%")
                  ->orWhere('matricula', 'like', "%$criteri%");
            });
        }

        //filtro per usuari logat
        if (session('usuari')) {
            $query->where('nom_usuari', session('usuari'));
        }

        //ordenacio
        $orden = $request->input('orden');
        switch ($orden) {
            case 'any_desc': $query->orderBy('any', 'desc'); break;
            case 'marca_asc': $query->orderBy('marca', 'asc'); break;
            case 'marca_desc': $query->orderBy('marca', 'desc'); break;
            case 'model_asc': $query->orderBy('model', 'asc'); break;
            case 'model_desc': $query->orderBy('model', 'desc'); break;
            default: $query->orderBy('any', 'asc');
        }

        $resultatsPerPagina = $request->get('resultatsPerPagina', 5);

        return $query->paginate($resultatsPerPagina)->withQueryString();
    }


}
