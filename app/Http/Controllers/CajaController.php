<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    public function index()
    {
        $cajas = Caja::paginate(10); // Asegúrate de usar paginate aquí
        return view('cajas.index', ['cajas' => $cajas]);
    }
    
    public function create()
    {
        return view('cajas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_caja' => 'required|integer',
            'mes' => 'required|string',
            'anio' => 'required|integer',
            'ubicacion' => 'required|string',
            'rango_alfabetico' => 'required|string',
            'maximo_carpetas' => 'required|integer',
        ]);

        Caja::create($request->all());

        return redirect()->route('cajas.index')->with('success', 'Caja creada correctamente.');
    }
}
