<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use App\Models\Evaluado;
use App\Models\Area;
use App\Models\Carpeta;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all(); // Obtener todos los documentos
        return view('documentos.index', compact('documentos')); // Pasar los datos a la vista
    }
    
    public function create()
    {
        $evaluados = Evaluado::all(); // Asegúrate de tener el modelo Evaluado
        $areas = Area::all(); // Asegúrate de tener el modelo Area
        $carpetas = Carpeta::all(); // Asegúrate de tener el modelo Carpeta
    
        return view('documentos.create', compact('evaluados', 'areas', 'carpetas'));
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
            'pdf_url' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        // Manejar el archivo PDF si se proporciona
        if ($request->hasFile('pdf_url')) {
            $validated['pdf_url'] = $request->file('pdf_url')->store('documentos', 'public');
        }
    
        // Crear el documento
        $documento = Documento::create($validated);
    
        // Redirigir a la vista de la carpeta asociada
        if ($request->id_carpeta) {
            return redirect()->route('carpetas.show', $request->id_carpeta)
                             ->with('success', 'Documento creado correctamente');
        }
    
        // Redirigir al índice si no se especifica una carpeta
        return redirect()->route('documentos.index')->with('success', 'Documento creado correctamente');
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
