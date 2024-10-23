<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    /**
     * Constructor para aplicar middlewares.
     */
    public function __construct()
    {
        $this->middleware('permission:ver-periodos|crear-periodos|editar-periodos|eliminar-periodos', ['only' => ['index']]);
        $this->middleware('permission:crear-periodos', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-periodos', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-periodos', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodos = Periodo::paginate(10);
        return view('periodos.index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periodos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $estatus = (now()->between($request->fecha_inicio, $request->fecha_fin)) ? 1 : 0;

        Periodo::create([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estatus' => $estatus,
        ]);

        return redirect()->route('periodos.index')->with('success', 'Periodo creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periodo $periodo)
    {
        return view('periodos.editar', compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periodo $periodo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $estatus = (now()->between($request->fecha_inicio, $request->fecha_fin)) ? 1 : 0;

        $periodo->update([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estatus' => $estatus,
        ]);

        return redirect()->route('periodos.index')->with('success', 'Periodo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodo $periodo)
    {
        $periodo->delete();

        return redirect()->route('periodos.index')->with('success', 'Periodo eliminado exitosamente.');
    }
}
