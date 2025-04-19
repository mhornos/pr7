<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function formulariInserir() {
        return view('vehicle.inserir');
    }

    public function formulariModificar() {
        return view('vehicle.modificar');
    }

    public function formulariEsborrar() {
        return view('vehicle.esborrar');
    }

}
