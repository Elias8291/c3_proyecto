<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    public function __construct()
    {
        // Middleware para verificar permisos
        $this->middleware('can:ver-cajas')->only(['index', 'show']);
        $this->middleware('can:crear-caja')->only(['create', 'store']);
        $this->middleware('can:editar-caja')->only(['edit', 'update']);
        $this->middleware('can:eliminar-caja')->only(['destroy']);
    }
    
    public function index(Request $request)
{
    $perPage = $request->input('per_page', 10); // Valor predeterminado de 10
    $cajas = Caja::paginate($perPage);

    return view('cajas.index', compact('cajas', 'perPage'));
}
    

    public function create()
    {
        return view('cajas.crear');
    }
    public function show($id)
    {
        $caja = Caja::with('carpetas.evaluado', 'carpetas.documentos')->findOrFail($id);
        return view('cajas.show', compact('caja'));
    }
    
    // En el controlador correspondiente
    public function getCajasDisponibles($evaluadoId, Request $request)
    {
        $anioApertura = $request->anio;
        $mesApertura = strtolower($request->mes);
    
        // Filtrar las cajas que coincidan con el año y mes de apertura
        $cajas = Caja::where('anio', $anioApertura)
            ->whereRaw('LOWER(mes) = ?', [$mesApertura])
            ->select('id', 'numero_caja', 'mes', 'anio')
            ->get();
    
        return response()->json($cajas);
    }
    public function store(Request $request)
    {
        $request->validate([
            'numero_caja' => 'required|integer|min:1',
            'mes' => 'required|string',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'ubicacion' => 'required|string',
            'rango_alfabetico' => 'required|string|regex:/^[A-Z]-[A-Z]?$/',
            'maximo_carpetas' => 'required|integer|min:1',
        ]);

        Caja::create($request->all());

        return redirect()->route('cajas.index')->with('success', 'Caja creada correctamente.');
    }
    public function edit($id)
    {
        // Obtén la caja que se desea editar
        $caja = Caja::findOrFail($id);

        // Retorna la vista de edición y pasa los datos de la caja a la vista
        return view('cajas.editar', compact('caja'));
    }

    // Método para actualizar los datos de la caja
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'numero_caja' => 'required|integer|min:1',
            'mes' => 'required|string',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'ubicacion' => 'required|string',
            'rango_alfabetico' => 'required|string|regex:/^[A-Z]-[A-Z]?$/',
            'maximo_carpetas' => 'required|integer|min:1',
        ]);

        // Encontrar la caja por ID y actualizar sus datos
        $caja = Caja::findOrFail($id);
        $caja->update($request->all());

        // Redirigir al índice de cajas con un mensaje de éxito
        return redirect()->route('cajas.index')->with('success', 'Caja actualizada correctamente.');
    }
    public function destroy($id)
    {
        // Buscar la caja por ID y eliminarla
        $caja = Caja::findOrFail($id);
        $caja->delete();

        return redirect()->route('cajas.index')->with('success', 'Caja eliminada correctamente.');
    } 

    
}