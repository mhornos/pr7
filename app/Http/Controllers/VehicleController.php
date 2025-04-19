<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function formulari() {
        return view('vehicle.inserir');
    }

}
