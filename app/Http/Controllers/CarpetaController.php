<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use App\Models\Evaluado;
use App\Models\Documento;
use App\Models\Caja;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; 


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
        try {
            DB::beginTransaction();
            
            // Log inicio del proceso
            Log::info('Iniciando eliminación de carpeta ID: ' . $id);
            
            // Buscar la carpeta con sus relaciones
            $carpeta = Carpeta::with(['documentos'])->findOrFail($id);
            
            // Verificar si la carpeta existe
            if (!$carpeta) {
                throw new \Exception('Carpeta no encontrada');
            }
            
            // Log información de la carpeta
            Log::info('Carpeta encontrada:', [
                'id' => $carpeta->id,
                'num_documentos' => $carpeta->documentos->count()
            ]);
    
            // Eliminar documentos uno por uno
            foreach ($carpeta->documentos as $documento) {
                Log::info('Procesando documento ID: ' . $documento->id);
                
                // Eliminar archivo PDF si existe
                if ($documento->pdf_url) {
                    try {
                        $path = str_replace('storage/', '', $documento->pdf_url);
                        if (Storage::disk('public')->exists($path)) {
                            Storage::disk('public')->delete($path);
                            Log::info('Archivo PDF eliminado: ' . $path);
                        } else {
                            Log::warning('Archivo PDF no encontrado: ' . $path);
                        }
                    } catch (\Exception $e) {
                        Log::error('Error al eliminar archivo PDF: ' . $e->getMessage());
                        // Continuar con el proceso incluso si falla la eliminación del archivo
                    }
                }
                
                // Eliminar registro del documento
                try {
                    $documento->delete();
                    Log::info('Documento eliminado correctamente de la base de datos');
                } catch (\Exception $e) {
                    Log::error('Error al eliminar documento de la base de datos: ' . $e->getMessage());
                    throw $e;
                }
            }
    
            // Eliminar la carpeta
            try {
                $carpeta->delete();
                Log::info('Carpeta eliminada correctamente');
            } catch (\Exception $e) {
                Log::error('Error al eliminar carpeta: ' . $e->getMessage());
                throw $e;
            }
    
            DB::commit();
            Log::info('Transacción completada exitosamente');
    
            return redirect()->route('carpetas.index')
                            ->with('success', 'Carpeta y todos sus documentos eliminados correctamente.');
                            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en el proceso de eliminación: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->route('carpetas.index')
                            ->with('error', 'Error al eliminar la carpeta: ' . $e->getMessage());
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
        try {
            // Validación más específica
            $validated = $request->validate([
                'id_evaluado' => 'required|integer|exists:evaluados,id',
                'id_caja' => 'required|integer|exists:cajas,id',
                'documentos' => 'nullable|string'
            ]);
    
            DB::beginTransaction();
    
            // Verificar si el evaluado ya tiene una carpeta
            $existingCarpeta = Carpeta::where('id_evaluado', $validated['id_evaluado'])->first();
            if ($existingCarpeta) {
                return response()->json([
                    'success' => false,
                    'message' => 'El evaluado ya tiene una carpeta asignada'
                ], 422);
            }
    
            // Crear la carpeta
            $carpeta = Carpeta::create([
                'id_evaluado' => $validated['id_evaluado'],
                'id_caja' => $validated['id_caja'],
                'fecha_creacion' => now() // Asegurarse de registrar la fecha de creación
            ]);
    
            // Procesar documentos si existen
            if ($request->filled('documentos')) {
                $documentos = json_decode($request->documentos, true);
    
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Error al decodificar los documentos');
                }
    
                if (is_array($documentos)) {
                    foreach ($documentos as $documentoData) {
                        Documento::create([
                            'id_carpeta' => $carpeta->id,
                            'numero_hojas' => $documentoData['numeroHojas'] ?? 0,
                            'id_area' => $documentoData['area'],
                            'estado' => $documentoData['estado'] ?? 'activo',
                            'fecha_creacion' => $documentoData['fechaCreacion'] ?? now(),
                            'id_evaluado' => $validated['id_evaluado'],
                        ]);
                    }
                }
            }
    
            DB::commit();
    
            // Retornar respuesta exitosa
            return response()->json([
                'success' => true,
                'message' => 'Carpeta creada exitosamente',
                'id' => $carpeta->id
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear carpeta: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la carpeta: ' . $e->getMessage()
            ], 500);
        }
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
