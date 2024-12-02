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
    
  
    public function store(Request $request, Carpeta $carpeta)
{
    // Validación de los datos
    $validated = $request->validate([
        'area_id' => 'required|exists:areas,id',
        'numero_hojas' => 'required|integer|min:1',
        'estado' => 'required|in:Disponible,Prestado,Solicitado', // Cambiado para incluir los nuevos estados
        'fecha_creacion' => 'required|date',
    ]);
    
    // Asignar el id_evaluado (aquí se asume que `Evaluado` está relacionado con `Carpeta` o que puedes obtenerlo de alguna manera)
    $id_evaluado = $carpeta->evaluado->id; // Asumimos que la relación entre Carpeta y Evaluado está definida correctamente

    // Crear el documento
    $documento = new Documento();
    $documento->numero_hojas = $validated['numero_hojas'];
    $documento->fecha_creacion = $validated['fecha_creacion'];
    $documento->estado = $validated['estado'];
    $documento->id_area = $validated['area_id'];
    $documento->id_carpeta = $carpeta->id; // Relacionar con la carpeta actual
    $documento->id_evaluado = $id_evaluado; // Asignar el evaluado

    $documento->save();

    // Redirigir a la página de la carpeta con el nuevo documento creado
    return redirect()->route('carpetas.show', $carpeta->id)
                     ->with('success', 'Documento creado exitosamente');
}

    
    public function destroy($id)
    {
        // Buscar el documento por su ID
        $documento = Documento::findOrFail($id);
    
        try {
            // Guardamos el id de la carpeta antes de eliminar el documento
            $carpetaId = $documento->id_carpeta;
    
            // Eliminar el documento
            $documento->delete();
    
            // Redirigir a la vista de la carpeta correspondiente, pasando el ID de la carpeta
            return redirect()->route('carpetas.show', ['carpeta' => $carpetaId])
                             ->with('success', 'Documento eliminado correctamente.');
        } catch (\Exception $e) {
            // Si ocurre algún error, redirigir con un mensaje de error
            return redirect()->route('carpetas.show', ['carpeta' => $documento->id_carpeta])
                             ->with('error', 'Hubo un error al eliminar el documento: ' . $e->getMessage());
        }
    }
    

    
}
