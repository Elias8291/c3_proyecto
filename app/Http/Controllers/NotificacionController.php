<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    /**
     * Mostrar todas las notificaciones del usuario actual
     */
    public function index()
    {
        $notificaciones = Notificacion::where('usuario_destino_id', Auth::id())
                                      ->orderBy('created_at', 'desc')
                                      ->paginate(10); // Paginación opcional
        return view('notificaciones.index', compact('notificaciones'));
    }
    
    /**
     * Marcar una notificación como leída
     */
    public function marcarComoLeida($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        
        // Verificar que la notificación pertenezca al usuario actual
        if ($notificacion->usuario_destino_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para modificar esta notificación.');
        }
        
        $notificacion->leida = true;
        $notificacion->save();
        
        return redirect()->back()->with('success', 'Notificación marcada como leída.');
    }
    
    /**
     * Eliminar una notificación
     */
    public function eliminar($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        
        // Verificar que la notificación pertenezca al usuario actual
        if ($notificacion->usuario_destino_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar esta notificación.');
        }
        
        $notificacion->delete();
        
        return redirect()->back()->with('success', 'Notificación eliminada correctamente.');
    }
}