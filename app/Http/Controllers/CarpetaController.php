<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    /**
     * Mostrar la lista de carpetas.
     */
    public function index()
    {
        $carpetas = Carpeta::all();
        return view('carpetas.index', compact('carpetas'));
    }

    /**
     * Mostrar el formulario para crear una nueva carpeta.
     */
    public function create()
    {
        return view('carpetas.crear');
    }

    /**
     * Almacenar una nueva carpeta en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'evaluado_id' => 'required|exists:evaluados,id',
            'numero_documentos' => 'required|integer',
        ]);

        Carpeta::create($validatedData);

        return redirect()->route('carpetas.index')->with('success', 'Carpeta creada exitosamente.');
    }

    /**
     * Mostrar los detalles de una carpeta.
     */
    public function show(Carpeta $carpeta)
    {
        return view('carpetas.show', compact('carpeta'));
    }

    /**
     * Mostrar el formulario para editar una carpeta existente.
     */
    public function edit(Carpeta $carpeta)
    {
        return view('carpetas.editar', compact('carpeta'));
    }

    /**
     * Actualizar una carpeta existente en la base de datos.
     */
    public function update(Request $request, Carpeta $carpeta)
    {
        $validatedData = $request->validate([
            'evaluado_id' => 'required|exists:evaluados,id',
            'numero_documentos' => 'required|integer',
        ]);

        $carpeta->update($validatedData);

        return redirect()->route('carpetas.index')->with('success', 'Carpeta actualizada exitosamente.');
    }

    /**
     * Eliminar una carpeta.
     */
    public function destroy(Carpeta $carpeta)
    {
        $carpeta->delete();
        return redirect()->route('carpetas.index')->with('success', 'Carpeta eliminada exitosamente.');
    }
}
