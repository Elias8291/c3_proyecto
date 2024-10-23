<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    public function create()
    {
        return view('inscripcion.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numeroDeControl' => 'required|exists:estudiantes,numeroDeControl',
            'grupo_clave' => 'required|exists:grupos,clave',
        ]);

        // Assuming 'inscripciones' table has a model named Inscripcion
        DB::table('inscripciones')->insert([
            'estudiantes_numeroDeControl' => $validatedData['numeroDeControl'],
            'grupo_clave' => $validatedData['grupo_clave'],
        ]);

        return back()->with('success', 'Alumno inscrito correctamente en el grupo.');
    }
}
