<?php

namespace App\Http\Controllers;

use App\Models\Evaluado;
use Illuminate\Http\Request;
use App\Models\Carpeta;
use App\Models\Documento;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EvaluadoController extends Controller
{
    /**
     * Mostrar la lista de evaluados.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:ver-evaluados')->only(['index', 'show']);
        $this->middleware('can:crear-evaluado')->only(['create', 'store']);
        $this->middleware('can:editar-evaluado')->only(['edit', 'update']);
        $this->middleware('can:eliminar-evaluado')->only(['destroy']);
    }
    public function index(Request $request)
    {
        $query = Evaluado::query();

        // Filtrar por búsqueda de texto
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(DB::raw("CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido)"), 'LIKE', "%$search%");
        }

        // Filtrar por año de fecha de apertura
        if ($request->has('year') && !empty($request->input('year'))) {
            $year = $request->input('year');
            $query->whereYear('fecha_apertura', $year);
        }

        // Obtener cantidad de resultados por página
        $perPage = $request->input('perPage', 10);

        // Aplicar paginación después de los filtros
        $evaluados = $query->paginate($perPage);

        return view('evaluados.index', compact('evaluados'));
    }






    /**
     * Mostrar el formulario para crear un nuevo evaluado.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Devolver la vista de creación de un nuevo evaluado
        return view('evaluados.crear');
    }

    /**
     * Almacenar un evaluado recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'CURP' => 'required|string|max:18|unique:evaluados',
            'RFC' => 'nullable|string|max:13',
            'fecha_apertura' => 'required|date',
            'sexo' => 'required|in:M,H',
            'estado_nacimiento' => 'required|string|max:2',
            'fecha_nacimiento' => 'required|date',
            'resultado_evaluacion' => 'required|boolean',
        ]);

        $evaluado = Evaluado::create($validatedData);

        // Redirigir a la lista de evaluados con un mensaje de éxito y activar el modal
        return redirect()->route('evaluados.index')->with([
            'success' => '¡Evaluado creado exitosamente!',
            'showCreateFolderModal' => true  // Activa el modal para crear carpeta
        ]);
    }

    public function carpeta()
    {
        return $this->hasOne(Carpeta::class, 'id_evaluado');
    }




    // Al final de tu EvaluadoController, antes del cierre de la clase
    public function getDatosEvaluado($id)
    {
        $evaluado = Evaluado::find($id);

        if ($evaluado) {
            // Formatear la fecha de apertura
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $fechaApertura = strtotime($evaluado->fecha_apertura);
            $mesApertura = ucfirst(strftime('%B', $fechaApertura));
            $anioApertura = date('Y', $fechaApertura);

            return response()->json([
                'primer_nombre' => $evaluado->primer_nombre,
                'segundo_nombre' => $evaluado->segundo_nombre,
                'primer_apellido' => $evaluado->primer_apellido,
                'segundo_apellido' => $evaluado->segundo_apellido,
                'fecha_apertura' => $evaluado->fecha_apertura,
                'mes_apertura' => $mesApertura,
                'anio_apertura' => $anioApertura,
            ]);
        } else {
            return response()->json(['error' => 'Evaluado no encontrado'], 404);
        }
    }


    /**
     * Mostrar los detalles de un evaluado específico.
     *
     * @param  \App\Models\Evaluado  $evaluado
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluado $evaluado)
    {
        // Mostrar la vista con los detalles del evaluado
        return view('evaluados.show', compact('evaluado'));
    }

    /**
     * Mostrar el formulario para editar un evaluado específico.
     *
     * @param  \App\Models\Evaluado  $evaluado
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluado $evaluado)
    {
        // Mostrar la vista de edición de un evaluado
        return view('evaluados.editar', compact('evaluado'));
    }

    /**
     * Actualizar un evaluado específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluado  $evaluado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluado $evaluado)
    {
        // Validar los datos actualizados
        $validatedData = $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'CURP' => 'required|string|max:18|unique:evaluados,CURP,' . $evaluado->id,
            'RFC' => 'nullable|string|max:13',
            'fecha_apertura' => 'required|date',
            'sexo' => 'required|in:M,H',
            'estado_nacimiento' => 'required|string|max:2',
            'fecha_nacimiento' => 'required|date',
            'resultado_evaluacion' => 'required|boolean',
        ]);

        // Actualizar el evaluado con los datos validados
        $evaluado->update($validatedData);

        // Redirigir a la lista de evaluados con un mensaje de éxito
        return redirect()->route('evaluados.index')->with('success', 'Evaluado actualizado exitosamente.');
    }

    // En tu controlador EvaluadoController
    // En tu controlador EvaluadoController
    public function filterByYear(Request $request)
    {
        $year = $request->input('year');
        $evaluados = Evaluado::whereYear('fecha_apertura', $year)->get();
        return response()->json($evaluados);
    }



    /**
     * Eliminar un evaluado específico de la base de datos.
     *
     * @param  \App\Models\Evaluado  $evaluado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluado $evaluado)
    {
        // Eliminar el evaluado
        $evaluado->delete();

        // Redirigir a la lista de evaluados con un mensaje de éxito
        return redirect()->route('evaluados.index')->with('success', 'Evaluado eliminado exitosamente.');
    }

    public function searchEvaluados(Request $request)
{
    $searchTerms = array_filter(explode(' ', trim($request->input('term'))));
    
    $evaluados = Evaluado::query();
    
    foreach ($searchTerms as $term) {
        $evaluados->where(function($query) use ($term) {
            $query->where('primer_nombre', 'LIKE', "%{$term}%")
                  ->orWhere('segundo_nombre', 'LIKE', "%{$term}%")
                  ->orWhere('primer_apellido', 'LIKE', "%{$term}%")
                  ->orWhere('segundo_apellido', 'LIKE', "%{$term}%");
        });
    }
    
    $results = $evaluados->with('carpetas')
                        ->limit(10)
                        ->get()
                        ->map(function($evaluado) {
                            return [
                                'id' => $evaluado->id,
                                'primer_nombre' => $evaluado->primer_nombre,
                                'segundo_nombre' => $evaluado->segundo_nombre,
                                'primer_apellido' => $evaluado->primer_apellido,
                                'segundo_apellido' => $evaluado->segundo_apellido,
                                'nombre_completo' => trim($evaluado->primer_nombre . ' ' . 
                                                        $evaluado->segundo_nombre . ' ' . 
                                                        $evaluado->primer_apellido . ' ' . 
                                                        $evaluado->segundo_apellido),
                                'tiene_carpeta' => $evaluado->carpetas->isNotEmpty(),
                                'curp' => $evaluado->CURP
                            ];
                        });
    
    return response()->json($results);
}
}
