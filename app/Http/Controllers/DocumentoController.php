<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use App\Models\Evaluado;
use App\Models\Area;
use App\Models\Carpeta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index', compact('documentos'));
    }
    
    public function create()
    {
        $evaluados = Evaluado::all();
        $areas = Area::all();
        $carpetas = Carpeta::all();
    
        return view('documentos.create', compact('evaluados', 'areas', 'carpetas'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_hojas' => 'required|string',
            'fecha_creacion' => 'required|date',
            'estado' => 'required|string',
            'id_evaluado' => 'required|exists:evaluados,id',
            'id_area' => 'required|exists:areas,id',
            'id_carpeta' => 'nullable|exists:carpetas,id',
            'pdf_url' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        if ($request->hasFile('pdf_url')) {
            $validated['pdf_url'] = $request->file('pdf_url')->store('documentos', 'public');
        }
    
        $documento = Documento::create($validated);
    
        if ($request->id_carpeta) {
            return redirect()->route('carpetas.show', $request->id_carpeta)
                             ->with('success', 'Documento creado correctamente');
        }
    
        return redirect()->route('documentos.index')->with('success', 'Documento creado correctamente');
    }
    
    public function show($id)
    {
        $documento = Documento::findOrFail($id);
        return response()->json($documento);
    }

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

    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        
        try {
            $documento->delete();
            return redirect()->back()
                            ->with('success', 'Documento eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Error al eliminar el documento: ' . $e->getMessage());
        }
    }
}