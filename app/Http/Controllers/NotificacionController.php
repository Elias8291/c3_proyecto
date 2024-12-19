<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\User;

class NotificacionController extends Controller
{
    public function index()
    {
        // Reemplaza 1 con auth()->id() para el usuario autenticado
        $notificaciones = Notificacion::where('usuario_receptor_id', 1) // O auth()->id()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('notificaciones.index', compact('notificaciones'));
    }

    public function marcarComoLeida($id)
    {
        try {
            $notificacion = Notificacion::where('id', $id)
                ->where('usuario_receptor_id', auth()->id())
                ->firstOrFail();

            $notificacion->leida = true;
            $notificacion->save();

            return redirect()->back()->with('success', 'Notificación marcada como leída.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo marcar la notificación como leída.');
        }
    }

    public function marcarTodasComoLeidas()
    {
        try {
            Notificacion::where('usuario_receptor_id', auth()->id())
                ->where('leida', false)
                ->update(['leida' => true]);

            return redirect()->back()->with('success', 'Todas las notificaciones han sido marcadas como leídas.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudieron marcar las notificaciones como leídas.');
        }
    }

    public function eliminar($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->delete();

        return redirect()->back()->with('success', 'Notificación eliminada correctamente.');
    }

    public function enviarNotificacionArchivo(Request $request)
{
    // ID del área de archivo (id = 10)
    $areaId = 10;

    // Obtén todos los usuarios del área 'archivo'
    $usuarios = User::where('id_area', $areaId)->get();

    if ($usuarios->isEmpty()) {
        return redirect()->back()->with('error', 'No hay usuarios en el área de archivo.');
    }

    // Crea una notificación para cada usuario del área
    foreach ($usuarios as $usuario) {
        Notificacion::create([
            'usuario_emisor_id' => auth()->id(), // Usuario autenticado como emisor
            'usuario_receptor_id' => $usuario->id,
            'area_id' => $areaId,
            'mensaje' => $request->input('mensaje'),
            'leida' => false,
        ]);
    }

    return redirect()->back()->with('success', 'Notificaciones enviadas a los usuarios del área de archivo.');
}

}
