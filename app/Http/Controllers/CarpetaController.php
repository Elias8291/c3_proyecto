<?php
namespace App\Http\Controllers;

use App\Models\Carpeta;
use App\Models\Evaluado;
use App\Models\Caja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    public function index()
    {
        $carpetas = Carpeta::with(['evaluado', 'caja'])->get();
        return view('carpetas.index', compact('carpetas'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'evaluado_id' => 'required|exists:evaluados,id',
        ]);

        $evaluado = Evaluado::findOrFail($request->input('evaluado_id'));
        $cajas = Caja::all(); // Pasamos todas las cajas

        return view('carpetas.crear', compact('evaluado', 'cajas'));
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'id_evaluado' => 'required|exists:evaluados,id',
            'id_caja' => 'required|exists:cajas,id',
        ]);

        Carpeta::create($request->only(['id_evaluado', 'id_caja']));

        return redirect()->route('carpetas.index')->with('success', 'Carpeta creada correctamente.');
    }
}
