<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;

class AdminController extends Controller
{
    public function index() {
        // només admin pot accedir
        if (session('usuari') !== 'admin') {
            return redirect()->route('home');
        }

        $usuaris = Usuari::where('nombreUsuario', '!=', 'admin')->get();
        return view('admin.usuaris', compact('usuaris'));
    }

    //elimina un usuari del sistema
    public function eliminar(Request $request) {
        //si ha dit "No", no fem res
        if ($request->input('confirmar') === 'No') {
            return redirect()->route('usuaris.gestionar')->with('success', 'Eliminació cancel·lada ✅');
        }

        $usuari = Usuari::findOrFail($request->id);

        if ($usuari->nombreUsuario === 'admin') {
            return back()->withErrors(['No pots eliminar l\'usuari admin ❌']);
        }

        $usuari->delete();

        return redirect()->route('usuaris.gestionar')->with('success', "Usuari amb ID {$usuari->ID} eliminat correctament ✅");
    }

    //confirmar eliminació d'un usuari
    public function confirmarEliminacio(Request $request) {
        $usuari = Usuari::findOrFail($request->id);

        if ($usuari->nombreUsuario === 'admin') {
            return redirect()->back()->withErrors(['no pots eliminar l\'usuari admin ❌']);
        }

        return view('admin.confirmar_eliminar', ['usuari' => $usuari]);
    }   
}
