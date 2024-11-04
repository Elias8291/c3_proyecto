<?php

namespace App\Http\Controllers;

use App\Models\Evaluado;
use Illuminate\Http\Request;
use App\Models\Carpeta;
use App\Models\Documento;
use Illuminate\Support\Str;

class EvaluadoController extends Controller
{
    /**
     * Mostrar la lista de evaluados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los evaluados con paginación
        $evaluados = Evaluado::paginate(100);  // Cambia '100' por la cantidad de registros por página que desees

        // Retornar la vista con los evaluados paginados
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
            'IFE' => 'nullable|string|size:13|regex:/^[A-Z0-9]{13}$/',
            'SMN' => 'nullable|string|max:13',
            'fecha_apertura' => 'required|date',
            'sexo' => 'required|in:M,H',
            'estado_nacimiento' => 'required|string|max:2',
            'fecha_nacimiento' => 'required|date',
            'resultado_evaluacion' => 'required|boolean',
        ]);

        $evaluado = Evaluado::create($validatedData);

        // Redirigir a la vista de creación de carpeta, pasando el ID del evaluado
        return redirect()->route('carpetas.create', ['evaluado_id' => $evaluado->id]);
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
            'IFE' => 'required|string|size:13|regex:/^[A-Z0-9]{13}$/',  // Obligatorio

            'SMN' => 'nullable|string|max:13',  // SMN es opcional
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
    
}
