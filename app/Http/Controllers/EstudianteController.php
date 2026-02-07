<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Institucion;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
{
    $estudiantes = Estudiante::latest()->paginate(10);
    return view('estudiantes.index', compact('estudiantes'));
}

    public function create()
    {
        $institucion = Institucion::first();
        return view('estudiantes.create', compact('institucion'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nombres' => 'required|string|max:100',
        'apellidos' => 'required|string|max:100',
        'cedula' => 'required|string|max:20|unique:estudiantes',
        'telefono' => 'nullable|string|max:15'
    ]);
    
    Estudiante::create($request->all());
    return redirect()->route('estudiantes.index')->with('success', '✅ Estudiante creado');
}


}
