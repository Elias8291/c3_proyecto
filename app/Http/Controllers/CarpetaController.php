<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use App\Models\Evaluado;
use App\Models\Documento;
use App\Models\Caja;
use App\Models\Area;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{

    public function __construct()
    {
        // Middleware para verificar permisos
        $this->middleware('can:ver-carpetas')->only(['index', 'show']);
        $this->middleware('can:crear-carpeta')->only(['create', 'store']);
        $this->middleware('can:editar-carpeta')->only(['edit', 'update']);
        $this->middleware('can:eliminar-carpeta')->only(['destroy']);
    }
    public function index()
    {
        $carpetas = Carpeta::with(['evaluado', 'caja'])->get();
        return view('carpetas.index', compact('carpetas'));
    }


    public function create()
    {
        // Obtener solo las áreas de evaluación incluyendo Perfiles y Programación
        $evaluacionAreas = Area::whereIn('nombre_area', [
            'Psicométrico',
            'Psicológico',
            'Médico',
            'Toxicológico',
            'Poligráfico',
            'Investigación Socioeconómica',
            'Perfiles',
            'Programación'
        ])->get();

        // Eager load de la relación 'carpetas' para cada Evaluado
        $evaluados = Evaluado::with('carpetas')->get();

        $cajas = Caja::all();

        return view('carpetas.crear', compact('evaluados', 'evaluacionAreas', 'cajas'));
    }


    public function destroy($id)
    {
        // Busca el documento por su ID
        $documento = Documento::findOrFail($id);
    
        try {
            // Elimina el documento de la base de datos
            $documento->delete();
    
            // Redirige a la vista de la carpeta asociada, pasando el ID de la carpeta
            return redirect()->route('carpetas.show', ['carpeta' => $documento->carpeta_id])
                             ->with('success', 'Documento eliminado correctamente.');
        } catch (\Exception $e) {
            // Si ocurre algún error, redirige a la vista de la carpeta con el error
            return redirect()->route('carpetas.show', ['carpeta' => $documento->carpeta_id])
                             ->with('error', 'Hubo un error al eliminar el documento: ' . $e->getMessage());
        }
    }
    



    public function show($id)
    {
        $carpeta = Carpeta::with('documentos.area', 'evaluado')->findOrFail($id);
        $areas = Area::all(); // Para el formulario de agregar documento

        return view('carpetas.show', compact('carpeta', 'areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_evaluado' => 'required|exists:evaluados,id',
            'id_caja' => 'required|exists:cajas,id',
            'documentos' => 'nullable|string'
        ]);
    
        // Crear la carpeta
        $carpeta = Carpeta::create([
            'id_evaluado' => $request->id_evaluado,
            'id_caja' => $request->id_caja,
        ]);
    
        // Si hay documentos, guardarlos en la base de datos
        if ($request->filled('documentos')) {
            $documentos = json_decode($request->documentos, true);
    
            if (is_array($documentos)) {
                foreach ($documentos as $documentoData) {
                    Documento::create([
                        'id_carpeta' => $carpeta->id,
                        'numero_hojas' => $documentoData['numeroHojas'],
                        'id_area' => $documentoData['area'], // Asegúrate de que esto coincide con el modelo
                        'estado' => $documentoData['estado'],
                        'fecha_creacion' => $documentoData['fechaCreacion'],
                        'id_evaluado' => $request->id_evaluado,
                    ]);
                }
            }
        }
    
        // Redirigir al detalle de la carpeta creada
        return redirect()->route('carpetas.show', $carpeta->id)
                         ->with('success', 'Carpeta y documentos creados correctamente.');
    }
    


    public function edit($id)
    {
        $carpeta = Carpeta::with('documentos', 'evaluado', 'caja')->findOrFail($id);
        $evaluados = Evaluado::all();
        $cajas = Caja::all();
        $areas = Area::all();

        return view('carpetas.editar', compact('carpeta', 'evaluados', 'cajas', 'areas'));
    }

    public function update(Request $request, $id)
    {
        $carpeta = Carpeta::findOrFail($id);

        $request->validate([
            'id_evaluado' => 'required|exists:evaluados,id',
            'id_caja' => 'required|exists:cajas,id',
        ]);

        $carpeta->update([
            'id_evaluado' => $request->id_evaluado,
            'id_caja' => $request->id_caja,
        ]);

        return redirect()->route('carpetas.show', $id)->with('success', 'Carpeta actualizada exitosamente.');
    }
}
