<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\AnioEscolar;
use App\Models\Seccion;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
{
    $matriculas = Matricula::with('estudiante', 'asistencias')->latest()->paginate(10);
    return view('matriculas.index', compact('matriculas'));
}

public function create()
{
    $estudiantes = Estudiante::all();
    return view('matriculas.create', compact('estudiantes'));
}

    public function store(Request $request)
{
    $request->validate([
        'estudiante_id' => 'required|exists:estudiantes,id',
        'area_formacion' => 'required|string|max:50',
        'seccion' => 'nullable|string|max:10',
        'anio_escolar' => 'nullable|string|max:9'
    ]);
    
    Matricula::create($request->all());
    return redirect()->route('matriculas.index')->with('success', '✅ Matrícula creada');
}
}
