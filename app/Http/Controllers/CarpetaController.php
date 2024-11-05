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

        $evaluados = Evaluado::all();
        $cajas = Caja::all();

        return view('carpetas.crear', compact('evaluados', 'evaluacionAreas', 'cajas'));
    }

    public function destroy($id)
{
    $carpeta = Carpeta::findOrFail($id);
    $carpeta->delete();

    return redirect()->route('carpetas.index')->with('success', 'Carpeta eliminada correctamente.');
}


public function show($id)
{
    $carpeta = Carpeta::with('documentos', 'evaluado')->findOrFail($id);
    $areas = Area::all(); // Aquí obtienes todas las áreas para usarlas en el formulario

    return view('carpetas.show', compact('carpeta', 'areas'));
}

    public function store(Request $request)
    {
        $request->validate([
            'id_evaluado' => 'required|exists:evaluados,id',
            'id_caja' => 'required|exists:cajas,id',
            'documentos' => 'nullable|string'
        ]);

        $carpeta = Carpeta::create([
            'id_evaluado' => $request->id_evaluado,
            'id_caja' => $request->id_caja,
        ]);

        if ($request->filled('documentos')) {
            $documentos = json_decode($request->documentos, true);

            if (is_array($documentos)) {
                foreach ($documentos as $documentoData) {
                    Documento::create([
                        'id_carpeta' => $carpeta->id,
                        'numero_hojas' => $documentoData['numeroHojas'],
                        'id_area' => $documentoData['area'], // Agregar id_area aquí
                        'estado' => $documentoData['estado'],
                        'fecha_creacion' => $documentoData['fechaCreacion'],
                        'id_evaluado' => $request->id_evaluado,
                    ]);
                }
            }
        }

        return redirect()->route('carpetas.index')->with('success', 'Carpeta y documentos creados correctamente.');
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
