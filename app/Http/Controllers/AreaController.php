<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-area|crear-area|editar-area|eliminar-area', ['only' => ['index']]);
        $this->middleware('permission:crear-area', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-area', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-area', ['only' => ['destroy']]);
    }

    // Mostrar la lista de áreas
    public function index()
    {
        $areas = Area::paginate(10); // Paginación de áreas
        return view('areas.index', compact('areas'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('areas.crear');
    }

    // Guardar una nueva área en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:areas',
        ]);

        Area::create($validatedData);

        return redirect()->route('areas.index')->with('success', 'Área creada exitosamente.');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $area = Area::find($id);
        return view('areas.editar', compact('area'));
    }

    // Actualizar el área existente en la base de datos
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:areas,nombre,' . $id,
        ]);

        $area = Area::find($id);
        $area->update($validatedData);

        return redirect()->route('areas.index')->with('success', 'Área actualizada exitosamente.');
    }

    // Eliminar un área de la base de datos
    public function destroy($id)
    {
        Area::find($id)->delete();
        return redirect()->route('areas.index')->with('success', 'Área eliminada exitosamente.');
    }
}
