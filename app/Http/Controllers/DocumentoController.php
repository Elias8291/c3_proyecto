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
        // Obtiene todos los documentos de la base de datos
        $documentos = Documento::all();
        
        // Retorna la vista con la lista de documentos
        return view('documentos.index', compact('documentos'));
    }

    public function create(Request $request)
    {
        // Obtener la carpeta y el evaluado utilizando los IDs pasados por el formulario
        $carpeta = Carpeta::findOrFail($request->input('carpeta_id'));
        $evaluado = Evaluado::findOrFail($request->input('evaluado_id'));
    
        // Retorna la vista de creación de documentos con la carpeta y el evaluado
        return view('documentos.crear', compact('carpeta', 'evaluado'));
    }
    
    public function store(Request $request)
    {
        // Validación de los datos recibidos desde el formulario
        $validatedData = $request->validate([
            'numero_hojasC' => 'required|string',
            'fecha_creacion' => 'required|date',
            'estado' => 'required|string',
            'evaluado_id' => 'required|exists:evaluados,id', // Verifica que el evaluado exista en la tabla 'evaluados'
            'carpeta_id' => 'required|exists:carpetas,id', // Verifica que la carpeta exista en la tabla 'carpetas'
            'area_id' => 'required|exists:areas,id', // Aquí debe coincidir con el campo del formulario
        ]);
    
        // Creación del nuevo documento en la base de datos
        Documento::create([
            'numero_hojas' => $validatedData['numero_hojas'],
            'fecha_creacion' => $validatedData['fecha_creacion'],
            'estado' => $validatedData['estado'],
            'evaluado_id' => $validatedData['evaluado_id'],  // Cambié a 'evaluado_id' para que coincida
            'carpeta_id' => $validatedData['carpeta_id'],    // Cambié a 'carpeta_id' para que coincida
            'area_id' => $validatedData['area_id'],          // Cambié a 'area_id' para que coincida
        ]);
    
        // Redirige al índice de documentos para la carpeta específica con un mensaje de éxito
        return redirect()->route('carpetas.show', $validatedData['carpeta_id'])
                         ->with('success', 'Documento creado correctamente.');
    }
    
    public function destroy($id)
    {
        // Buscar el documento por su ID
        $documento = Documento::findOrFail($id);
    
        try {
            // Eliminar el documento de la base de datos
            $documento->delete();
    
            // Redirigir a la vista de la carpeta, con un mensaje de éxito
            return redirect()->route('carpetas.show', $documento->carpeta_id)
                             ->with('success', 'Documento eliminado correctamente.');
        } catch (\Exception $e) {
            // Si ocurre algún error, redirigir con un mensaje de error
            return redirect()->route('carpetas.show', $documento->carpeta_id)
                             ->with('error', 'Hubo un error al eliminar el documento: ' . $e->getMessage());
        }
    }
    

}
