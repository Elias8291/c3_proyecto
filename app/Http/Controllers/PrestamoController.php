<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Documento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Notificacion;
use App\Models\User;

class PrestamoController extends Controller
{




    public function index(Request $request)
    {
        $estado = $request->input('estado'); // Obtiene el filtro de estado desde la solicitud.
    
        // Obtiene los préstamos con filtros aplicados.
        $prestamosQuery = Prestamo::with(['documento', 'usuario']);
    
        if ($estado && $estado !== 'Todos') {
            $prestamosQuery->where('estado', $estado);
        }
    
        $prestamos = $prestamosQuery->paginate(10); // Paginación.
    
        return view('prestamos.index', compact('prestamos', 'estado'));
    }
    

    /**
     * Solicitar un préstamo.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function solicitar(Request $request)
    {
        try {
            DB::beginTransaction();
    
            // Validar entrada
            $validator = Validator::make($request->all(), [
                'documento_id' => 'required|exists:documentos,id',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Datos inválidos.',
                    'errors' => $validator->errors(),
                ], 422);
            }
        
            // Obtener el documento
            $documento = Documento::findOrFail($request->documento_id);
        
            // Verificar el estado del documento
            if ($documento->estado !== 'Disponible') {
                return response()->json([
                    'success' => false,
                    'message' => 'El documento no está disponible para préstamo.',
                ], 400);
            }
        
            // Crear el préstamo
            $prestamo = Prestamo::create([
                'documento_id' => $documento->id,
                'usuario_id' => Auth::id(),
                'fecha_solicitud' => now(),
                'estado' => 'Pendiente',
            ]);
        
            // Cambiar estado del documento
            $documento->update(['estado' => 'Solicitado']);
        
            // Obtener los usuarios del área de archivo (ID = 10)
            $usuariosArchivo = User::where('id_area', 10)->get();
            
            if ($usuariosArchivo->isEmpty()) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'No hay usuarios disponibles en el área de archivo para procesar la solicitud.',
                ], 400);
            }
            
            // Crear notificaciones para cada usuario del área de archivo
            foreach ($usuariosArchivo as $usuario) {
                Notificacion::create([
                    'usuario_emisor_id' => Auth::id(),
                    'usuario_receptor_id' => $usuario->id,
                    'area_id' => Auth::user()->id_area,
                    'mensaje' => sprintf(
                        'Nueva solicitud de préstamo del documento %s por %s del área %s',
                        $documento->evaluado->primer_nombre,
                        Auth::user()->name,
                        Auth::user()->area->nombre
                    ),
                    'leida' => false
                ]);
            }
        
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Préstamo solicitado correctamente y notificaciones enviadas.',
                'prestamo' => $prestamo,
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la solicitud de préstamo.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Aprobar un préstamo.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function aprobar(Request $request, $id)
    {
        try {
            $prestamo = Prestamo::findOrFail($id);
            
            if ($prestamo->estado !== 'Pendiente') {
                return response()->json([
                    'success' => false,
                    'message' => 'El préstamo no puede ser aprobado.',
                ], 400);
            }
            
            DB::beginTransaction();
            
            $prestamo->update([
                'estado' => 'Aprobado',
                'fecha_aprobacion' => now(),
                'aprobador_id' => Auth::id()
            ]);
            
            // Actualizar el estado del documento
            $prestamo->documento->update(['estado' => 'Prestado']);
            // Ejemplo de uso
            $this->notificarAprobacionPrestamo($prestamo->id);
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Préstamo aprobado correctamente.',
                'prestamo' => $prestamo,
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al aprobar el préstamo.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Devolver un préstamo.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
  
     public function devolverPorDocumento($documentoId)
     {
         try {
             DB::beginTransaction();
             
             $prestamo = Prestamo::with(['documento.evaluado', 'usuario'])
                                ->where('documento_id', $documentoId)
                                ->where('estado', 'Aprobado')
                                ->latest()
                                ->firstOrFail();
         
             $prestamo->update([
                 'estado' => 'Devuelto',
                 'fecha_devolucion' => now(),
             ]);
         
             // Actualizar el estado del documento a Disponible
             Documento::where('id', $documentoId)->update([
                 'estado' => 'Disponible'
             ]);
     
             // Notificar al usuario que solicitó el préstamo
             if ($prestamo->usuario_id !== Auth::id()) {
                 Notificacion::create([
                     'usuario_emisor_id' => Auth::id(),
                     'usuario_receptor_id' => $prestamo->usuario_id,
                     'area_id' => Auth::user()->id_area,
                     'mensaje' => sprintf(
                         'El documento %s ha sido devuelto correctamente',
                         $prestamo->documento->evaluado->primer_nombre
                     ),
                     'leida' => false
                 ]);
             }
     
             // Notificar a los usuarios del área de archivo
             $usuariosArchivo = User::where('id_area', 10)->get();
             foreach ($usuariosArchivo as $usuario) {
                 if ($usuario->id !== Auth::id()) {
                     Notificacion::create([
                         'usuario_emisor_id' => Auth::id(),
                         'usuario_receptor_id' => $usuario->id,
                         'area_id' => Auth::user()->id_area,
                         'mensaje' => sprintf(
                             'El documento %s ha sido devuelto por %s del área %s',
                             $prestamo->documento->evaluado->primer_nombre,
                             Auth::user()->name,
                             Auth::user()->area->nombre
                         ),
                         'leida' => false
                     ]);
                 }
             }
             
             DB::commit();
         
             return response()->json([
                 'success' => true,
                 'message' => 'Préstamo devuelto correctamente.',
                 'prestamo' => $prestamo
             ]);
             
         } catch (\Exception $e) {
             DB::rollBack();
             return response()->json([
                 'success' => false,
                 'message' => 'Error al devolver el préstamo.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }
    


 /**
 * Cancelar un préstamo.
 *
 * @param Request $request
 * @param int $id 
 * @return \Illuminate\Http\JsonResponse
 */
public function cancelar(Request $request, $id)
{
    try {
        DB::beginTransaction();
        
        // Buscar el préstamo
        $prestamo = Prestamo::with(['documento', 'usuario'])->findOrFail($id);

        // Verificar que el préstamo esté en estado Pendiente
        if ($prestamo->estado !== 'Pendiente') {
            return response()->json([
                'success' => false,
                'message' => 'Solo se pueden cancelar préstamos pendientes.',
            ], 400);
        }

        // Actualizar el estado del préstamo a Rechazado
        $prestamo->update([
            'estado' => 'Rechazado',
            'fecha_cancelacion' => now()
        ]);

        // Actualizar el estado del documento a Disponible
        $prestamo->documento->update(['estado' => 'Disponible']);

        // Crear notificación para el solicitante del préstamo
        Notificacion::create([
            'usuario_emisor_id' => Auth::id(),
            'usuario_receptor_id' => $prestamo->usuario_id,
            'area_id' => Auth::user()->id_area,
            'mensaje' => sprintf(
                'Tu solicitud de préstamo para el documento %s ha sido cancelada por %s',
                $prestamo->documento->evaluado->primer_nombre,
                Auth::user()->name
            ),
            'leida' => false
        ]);

        // Crear notificaciones para los usuarios del área de archivo
        $usuariosArchivo = User::where('id_area', 10)->get();
        foreach ($usuariosArchivo as $usuario) {
            if ($usuario->id !== Auth::id()) { // No enviar notificación al usuario que cancela si es del área de archivo
                Notificacion::create([
                    'usuario_emisor_id' => Auth::id(),
                    'usuario_receptor_id' => $usuario->id,
                    'area_id' => Auth::user()->id_area,
                    'mensaje' => sprintf(
                        'La solicitud de préstamo del documento %s de %s ha sido cancelada por %s',
                        $prestamo->documento->evaluado->primer_nombre,
                        $prestamo->usuario->name,
                        Auth::user()->name
                    ),
                    'leida' => false
                ]);
            }
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Préstamo cancelado correctamente.',
            'prestamo' => $prestamo
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error al cancelar el préstamo.',
            'error' => $e->getMessage()
        ], 500);
    }
}

/**
 * Cancelar un préstamo por ID de documento.
 *
 * @param Request $request
 * @param int $documentoId
 * @return \Illuminate\Http\JsonResponse
 */
public function cancelarPorDocumento($documentoId)
{
    try {
        DB::beginTransaction();

        // Buscar el préstamo pendiente más reciente para este documento
        $prestamo = Prestamo::with(['documento', 'usuario'])
                           ->where('documento_id', $documentoId)
                           ->where('estado', 'Pendiente')
                           ->latest()
                           ->first();

        if (!$prestamo) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró una solicitud de préstamo pendiente para este documento.',
            ], 404);
        }

        // Verificar que el usuario actual sea quien solicitó el préstamo
        if ($prestamo->usuario_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permiso para cancelar este préstamo.',
            ], 403);
        }

        // Actualizar el estado del préstamo
        $prestamo->update([
            'estado' => 'Rechazado',
            'fecha_cancelacion' => now()
        ]);

        // Actualizar el estado del documento
        Documento::where('id', $documentoId)->update([
            'estado' => 'Disponible'
        ]);

        // Notificar a los usuarios del área de archivo
        $usuariosArchivo = User::where('id_area', 10)->get();
        foreach ($usuariosArchivo as $usuario) {
            Notificacion::create([
                'usuario_emisor_id' => Auth::id(),
                'usuario_receptor_id' => $usuario->id,
                'area_id' => Auth::user()->id_area,
                'mensaje' => sprintf(
                    'El usuario %s ha cancelado su solicitud de préstamo para el documento %s',
                    Auth::user()->name,
                    $prestamo->documento->evaluado->primer_nombre
                ),
                'leida' => false
            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Solicitud de préstamo cancelada correctamente.',
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error al cancelar la solicitud de préstamo.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function rechazar(Request $request, $id)
{
    $prestamo = Prestamo::findOrFail($id);

    if ($prestamo->estado !== 'Pendiente') {
        return response()->json([
            'success' => false,
            'message' => 'El préstamo no puede ser rechazado.',
        ], 400);
    }

    $prestamo->update([
        'estado' => 'Rechazado',
    ]);

    // Cambiar estado del documento relacionado
    $prestamo->documento->update(['estado' => 'Disponible']);

    return redirect()->back()->with('success', 'Préstamo rechazado correctamente.');
}



public function detalles($id)
{
    try {
        $prestamo = Prestamo::with(['usuario', 'documento.evaluado', 'documento.area'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'prestamo' => $prestamo
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener los detalles del préstamo'
        ], 500);
    }
}


public function misDocumentosPrestados()
{
    try {
        // Obtener préstamos aprobados con documentos asociados del usuario autenticado
        $prestamos = Prestamo::with('documento')
            ->where('usuario_id', Auth::id()) // Filtra por el ID del usuario autenticado
            ->where('estado', 'Aprobado')     // Filtra los préstamos en estado 'Aprobado'
            ->get();

        return view('prestamos.mis_documentos', compact('prestamos'));
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener tus documentos prestados.',
            'error' => $e->getMessage()
        ], 500);
    }
}


public function notificarAprobacionPrestamo($prestamoId)
{
    try {
        $prestamo = Prestamo::with(['documento.evaluado', 'usuario', 'documento.area'])
            ->findOrFail($prestamoId);

        // Verificar que el préstamo esté aprobado
        if ($prestamo->estado !== 'Aprobado') {
            return response()->json([
                'success' => false,
                'message' => 'El préstamo no está aprobado.',
            ], 400);
        }

        // Crear notificación para el usuario que solicitó el préstamo
        Notificacion::create([
            'usuario_emisor_id' => Auth::id(),
            'usuario_receptor_id' => $prestamo->usuario_id,
            'area_id' => Auth::user()->id_area,
            'mensaje' => sprintf(
                'Tu solicitud de préstamo para el documento %s ha sido aprobada. Ya puedes pasar a recogerlo al área de archivo.',
                $prestamo->documento->evaluado->primer_nombre
            ),
            'leida' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Notificación de aprobación enviada correctamente.',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al enviar la notificación de aprobación.',
            'error' => $e->getMessage()
        ], 500);
    }
}
}