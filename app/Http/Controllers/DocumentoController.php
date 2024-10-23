<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Mostrar la lista de documentos.
     */
    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo documento.
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Almacenar un nuevo documento en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'evaluado_id' => 'required|exists:evaluados,id',
            'carpeta_id' => 'required|exists:carpetas,id',
            'numero_fojas' => 'required|integer',
            'fecha_creacion' => 'required|date',
            'motivo_evaluacion' => 'required|string|max:255',
            'folio' => 'required|string|max:255',
            'area_origen' => 'required|string|max:255',
        ]);

        Documento::create($validatedData);

        return redirect()->route('documentos.index')->with('success', 'Documento creado exitosamente.');
    }

    /**
     * Mostrar los detalles de un documento.
     */
    public function show(Documento $documento)
    {
        return view('documentos.show', compact('documento'));
    }

    /**
     * Mostrar el formulario para editar un documento existente.
     */
    public function edit(Documento $documento)
    {
        return view('documentos.edit', compact('documento'));
    }

    /**
     * Actualizar un documento existente en la base de datos.
     */
    public function update(Request $request, Documento $documento)
    {
        $validatedData = $request->validate([
            'evaluado_id' => 'required|exists:evaluados,id',
            'carpeta_id' => 'required|exists:carpetas,id',
            'numero_fojas' => 'required|integer',
            'fecha_creacion' => 'required|date',
            'motivo_evaluacion' => 'required|string|max:255',
            'folio' => 'required|string|max:255',
            'area_origen' => 'required|string|max:255',
        ]);

        $documento->update($validatedData);

        return redirect()->route('documentos.index')->with('success', 'Documento actualizado exitosamente.');
    }

    /**
     * Eliminar un documento.
     */
    public function destroy(Documento $documento)
    {
        $documento->delete();
        return redirect()->route('documentos.index')->with('success', 'Documento eliminado exitosamente.');
    }
}
