<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        // Realiza la consulta inicial que incluirá todos los registros
        $query = Caja::query();
    
        // Filtrar por término de búsqueda en toda la base de datos
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('numero_caja', 'LIKE', "%$search%")
                  ->orWhere('anio', 'LIKE', "%$search%")
                  ->orWhere('mes', 'LIKE', "%$search%")
                  ->orWhere('ubicacion', 'LIKE', "%$search%")
                  ->orWhere('rango_alfabetico', 'LIKE', "%$search%");
            });
        }
    
        // Paginar los resultados después de aplicar el filtro de búsqueda
        $cajas = $query->paginate(20);
    
        return view('cajas.index', compact('cajas'));
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
        $mesApertura = $request->mes;

        // Filtrar las cajas que coincidan con el año y mes de apertura
        $cajas = Caja::where('anio', $anioApertura)
            ->where('mes', $mesApertura)
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
}

