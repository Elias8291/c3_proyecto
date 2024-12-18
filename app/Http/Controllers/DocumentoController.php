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
    public function agregarPdf(Request $request, $id)
    {
        try {
            $request->validate([
                'pdf_url' => 'required|file|mimes:pdf|max:2048'
            ]);
    
            $documento = Documento::findOrFail($id);
    
            // Eliminar el PDF anterior si existe
            if ($documento->pdf_url) {
                Storage::disk('public')->delete($documento->pdf_url);
            }
    
            // Guardar el nuevo PDF
            $pdfPath = $request->file('pdf_url')->store('documentos', 'public');
            $documento->update(['pdf_url' => $pdfPath]);
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'PDF actualizado correctamente',
                    'pdf_url' => Storage::url($pdfPath)
                ]);
            }
    
            return redirect()->back()->with('success', 'PDF agregado correctamente');
    
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al procesar el archivo: ' . $e->getMessage()
                ], 422);
            }
    
            return redirect()->back()->with('error', 'Error al procesar el archivo: ' . $e->getMessage());
        }
    }

    public function buscar(Request $request)
{
    $query = $request->input('query');
    $evaluados = Evaluado::where('primer_nombre', 'like', '%' . $query . '%')
        ->orWhere('segundo_nombre', 'like', '%' . $query . '%')
        ->orWhere('primer_apellido', 'like', '%' . $query . '%')
        ->orWhere('segundo_apellido', 'like', '%' . $query . '%')
        ->get();

    return response()->json($evaluados);
}

public function datos($id)
{
    $evaluado = Evaluado::findOrFail($id);
    return response()->json($evaluado);
}

}