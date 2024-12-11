<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all();
        return response()->json($documentos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_hojas' => 'required|string',
            'fecha_creacion' => 'required|date',
            'estado' => 'required|string',
            'id_evaluado' => 'required|exists:evaluados,id',
            'id_area' => 'required|exists:areas,id',
            'id_carpeta' => 'nullable|exists:carpetas,id',
            'pdf_url' => 'nullable|string',
        ]);

        $documento = Documento::create($validated);
        return response()->json($documento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documento = Documento::findOrFail($id);
        return response()->json($documento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'numero_hojas' => 'nullable|string',
            'fecha_creacion' => 'nullable|date',
            'estado' => 'nullable|string',
            'id_evaluado' => 'nullable|exists:evaluados,id',
            'id_area' => 'nullable|exists:areas,id',
            'id_carpeta' => 'nullable|exists:carpetas,id',
            'pdf_url' => 'nullable|string',
        ]);

        $documento = Documento::findOrFail($id);
        $documento->update($validated);
        return response()->json($documento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();
        return response()->json(['message' => 'Documento eliminado correctamente']);
    }
}