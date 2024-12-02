<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Log;


class PrestamoController extends Controller
{
    /**
     * Solicitar un préstamo para un documento.
     */
    public function index()
    {
        // Obtener los préstamos con paginación
        $prestamos = Prestamo::paginate(10); // 10 préstamos por página
    
        // Devolver la vista con los préstamos
        return view('prestamos.index', compact('prestamos'));
    }
    
    public function solicitar($documentoId)
    {
        // Verificar que el documento existe
        $documento = Documento::findOrFail($documentoId);
        
        // Verificar que el documento esté disponible
        if ($documento->estado !== 'Disponible') {
            return redirect()->back()->with('error', 'El documento no está disponible para préstamo.');
        }
        
        // Crear el préstamo
        $prestamo = Prestamo::create([
            'documento_id' => $documento->id,
            'usuario_id' => Auth::id(),
            'fecha_solicitud' => Carbon::now(),
            'estado' => 'Pendiente',
        ]);
        
        // Crear notificación
        Notificacion::create([
            'enviado_por_id' => Auth::id(),
            'usuario_destino_id' => 2, // ID fijo como especificado
            'mensaje' => 'Prestamo solicitado',
            'area_id' => 10, // ID fijo como especificado
            'leida' => false
        ]);
        
        // Actualizar el estado del documento
        $documento->estado = 'Solicitado';
        $documento->save();
        
        // Redirigir con éxito
        return redirect()->back()->with('success', 'Solicitud de préstamo realizada con éxito.');
    }
    public function cancelar($documentoId)
    {
        // Verificar que el documento exista
        $documento = Documento::findOrFail($documentoId);
    
        // Verificar si el documento está en estado 'Solicitado'
        if ($documento->estado !== 'Solicitado') {
            return redirect()->back()->with('error', 'No se puede cancelar un préstamo que no está en estado solicitado.');
        }
    
        // Encontrar el préstamo asociado al documento y al usuario actual
        $prestamo = Prestamo::where('documento_id', $documento->id)
                            ->where('usuario_id', Auth::id())
                            ->where('estado', 'Pendiente')
                            ->first();
    
        // Verificar si el préstamo existe
        if (!$prestamo) {
            return redirect()->back()->with('error', 'No se encontró un préstamo pendiente para este documento.');
        }
    
        // Cambiar el estado del documento a 'Disponible'
        $documento->estado = 'Disponible';
        $documento->save();
    
        // Opcionalmente, puedes actualizar el estado del préstamo a 'Cancelado' o 'Rechazado'
        $prestamo->estado = 'Cancelado';  // O 'Rechazado' si prefieres otro estado
        $prestamo->save();
    
        // Opcional: Crear una notificación de cancelación
        Notificacion::create([
            'enviado_por_id' => Auth::id(),
            'usuario_destino_id' => 2, // ID fijo como especificado
            'mensaje' => 'Solicitud de préstamo cancelada',
            'area_id' => 10, // ID fijo como especificado
            'leida' => false
        ]);
    
        // Redirigir con éxito
        return redirect()->back()->with('success', 'La solicitud de préstamo ha sido cancelada con éxito.');
    }
    
    public function aprobar($documentoId)
{
    // Verificar que el documento exista
    $documento = Documento::findOrFail($documentoId);

    // Verificar si el documento está en estado 'Solicitado'
    if ($documento->estado !== 'Solicitado') {
        return redirect()->back()->with('error', 'El documento no está en estado solicitado.');
    }

    // Encontrar el préstamo asociado al documento y al usuario actual
    $prestamo = Prestamo::where('documento_id', $documento->id)
                        ->where('usuario_id', Auth::id())
                        ->where('estado', 'Pendiente')
                        ->first();

    // Verificar si el préstamo existe
    if (!$prestamo) {
        return redirect()->back()->with('error', 'No se encontró un préstamo pendiente para este documento.');
    }

    // Cambiar el estado del documento a 'Prestado'
    $documento->estado = 'Prestado';
    $documento->save();

    // Cambiar el estado del préstamo a 'Aprobado'
    $prestamo->estado = 'Aprobado';
    $prestamo->save();

    // Opcional: Crear una notificación de aprobación
    Notificacion::create([
        'enviado_por_id' => Auth::id(),
        'usuario_destino_id' => 2, // ID fijo como especificado
        'mensaje' => 'Solicitud de préstamo aprobada',
        'area_id' => 10, // ID fijo como especificado
        'leida' => false
    ]);

    // Redirigir con éxito
    return redirect()->back()->with('success', 'La solicitud de préstamo ha sido aprobada con éxito.');
}
public function rechazar($documentoId)
{
    // Verificar que el documento exista
    $documento = Documento::findOrFail($documentoId);

    // Verificar si el documento está en estado 'Solicitado'
    if ($documento->estado !== 'Solicitado') {
        return redirect()->back()->with('error', 'El documento no está en estado solicitado.');
    }

    // Encontrar el préstamo asociado al documento y al usuario actual
    $prestamo = Prestamo::where('documento_id', $documento->id)
                        ->where('usuario_id', Auth::id())
                        ->where('estado', 'Pendiente')
                        ->first();

    // Verificar si el préstamo existe
    if (!$prestamo) {
        return redirect()->back()->with('error', 'No se encontró un préstamo pendiente para este documento.');
    }

    // Cambiar el estado del préstamo a 'Rechazado'
    $prestamo->estado = 'Rechazado';
    $prestamo->save();

    // Opcional: Crear una notificación de rechazo
    Notificacion::create([
        'enviado_por_id' => Auth::id(),
        'usuario_destino_id' => 2, // ID fijo como especificado
        'mensaje' => 'Solicitud de préstamo rechazada',
        'area_id' => 10, // ID fijo como especificado
        'leida' => false
    ]);

    // Redirigir con éxito
    return redirect()->back()->with('success', 'La solicitud de préstamo ha sido rechazada con éxito.');
}

  
}