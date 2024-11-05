<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use App\Models\Evaluado;
use App\Models\Carpeta;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index', compact('documentos'));
    }

    public function create(Request $request)
    {
        // Obtener la carpeta y el evaluado
        $carpeta = Carpeta::findOrFail($request->input('carpeta_id'));
        $evaluado = Evaluado::findOrFail($request->input('evaluado_id'));
    
        // Retornar la vista de creación de documentos
        return view('documentos.crear', compact('carpeta', 'evaluado'));
    }
    
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'numero_hojas' => 'required|string',
        'fecha_creacion' => 'required|date',
        'estado' => 'required|string',
        'id_evaluado' => 'required|exists:evaluados,id',
        'id_carpeta' => 'required|exists:carpetas,id',
    ]);

    Documento::create($validatedData);

    return redirect()->route('documentos.index')->with('success', 'Documento creado correctamente.');
}


    
}
