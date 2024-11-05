<?php
namespace App\Http\Controllers;

use App\Models\Carpeta;
use App\Models\Evaluado;
use App\Models\Caja;
use App\Models\Documento;
use App\Models\Area; // Importar el modelo Area
use Carbon\Carbon;
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
        $evaluados = Evaluado::all(); // Obtener todos los evaluados
        $areas = Area::all(); // Obtener todas las áreas
        
        return view('carpetas.crear', compact('evaluados', 'areas'));
    }
    
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_evaluado' => 'required|exists:evaluados,id',
            'id_caja' => 'required|exists:cajas,id',
            'numero_hojas' => 'required|string',
            'fecha_creacion' => 'required|date',
            'motivo_evaluacion' => 'required|string',
            'estado' => 'required|string',
        ]);
    
        // Crear la carpeta
        $carpeta = Carpeta::create([
            'id_evaluado' => $validatedData['id_evaluado'],
            'id_caja' => $validatedData['id_caja'],
        ]);
    
        // Crear el documento asociado a la carpeta
        Documento::create([
            'numero_hojas' => $validatedData['numero_hojas'],
            'fecha_creacion' => $validatedData['fecha_creacion'],
            'motivo_evaluacion' => $validatedData['motivo_evaluacion'],
            'estado' => $validatedData['estado'],
            'id_evaluado' => $validatedData['id_evaluado'],
            'id_carpeta' => $carpeta->id, // Relacionar el documento con la carpeta creada
        ]);
    
        return redirect()->route('carpetas.index')->with('success', 'Carpeta y documento creados correctamente.');
    }
}
