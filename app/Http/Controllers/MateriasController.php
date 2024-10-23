<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use Illuminate\Support\Facades\DB;
class MateriasController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-materias|crear-materias|editar-materias|eliminar-materias', ['only' => ['index']]);
        $this->middleware('permission:crear-materias', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-materias', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-materias', ['only' => ['destroy']]);
    }

    public function index()
    {
        $materias = DB::table('materias')
            ->leftJoin('grupos', 'grupos.materia_id', '=', 'materias.id')
            ->select('materias.*', DB::raw('COUNT(grupos.id) as grupos_count'))
            ->groupBy('materias.id')
            ->paginate(30);
    
        return view('materias.index', compact('materias'));
    }
    public function create()
    {
        return view('materias.crear');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'clave' => 'required|string|max:50|unique:materias',
            'nombre' => 'required|string|max:255',
            'creditos' => 'required|integer',
        ]);
    
        Materia::create($validatedData);
    
        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        return view('materias.editar', compact('materia'));
    }

    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $validatedData = $request->validate([
            'clave' => 'required|string|max:50|unique:materias,clave,' . $materia->id,
            'nombre' => 'required|string|max:255',
            'creditos' => 'required|integer',
        ]);

        $materia->update($validatedData);

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente.');
    }
}