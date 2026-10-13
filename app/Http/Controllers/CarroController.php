<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;

class CarroController extends Controller
{
    public function index()
    {
        $carros = Carro::all();
        return view('carros.index', compact('carros'));
    }

    public function carro($id)
    {
        $carro = Carro::with('cliente.pessoa')->findOrFail($id);
        return view('carros.carro', compact('carro'));
    }
}
