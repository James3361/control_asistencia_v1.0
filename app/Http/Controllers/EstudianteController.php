<?php
namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Institucion;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    // ✅ LISTAR
    public function index()
    {
        $estudiantes = Estudiante::latest()->paginate(10);
        return view('estudiantes.index', compact('estudiantes'));
    }

    // ✅ NUEVO - FORM
    public function create()
    {
        $institucion = Institucion::first();
        return view('estudiantes.create', compact('institucion'));
    }

    // ✅ GUARDAR NUEVO
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'documento' => 'required|string|max:20|unique:estudiantes',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|unique:estudiantes',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $institucion = Institucion::first() ?? Institucion::create([
            'nombre' => 'Institución Principal',
            'rif' => 'J-00000000-0',
            'direccion' => 'Calabozo, Guárico'
        ]);

        Estudiante::create([
            ...$request->all(),
            'institucion_id' => $institucion->id
        ]);

        return redirect()->route('estudiantes.index')
                        ->with('success', '✅ Estudiante creado correctamente');
    }

    // ✅ VER DETALLE
    public function show(Estudiante $estudiante)
    {
        $estudiante->load(['matriculas']);
        return view('estudiantes.show', compact('estudiante'));
    }

    // ✅ EDITAR - FORM
    public function edit(Estudiante $estudiante)
    {
        $institucion = Institucion::first();
        return view('estudiantes.edit', compact('estudiante', 'institucion'));
    }

    // ✅ ACTUALIZAR
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'documento' => 'required|string|max:20|unique:estudiantes,documento,' . $estudiante->id,
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|unique:estudiantes,correo,' . $estudiante->id,
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')
                        ->with('success', '✅ Estudiante actualizado correctamente');
    }

    // ✅ ELIMINAR
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index')
                        ->with('success', '✅ Estudiante eliminado correctamente');
    }
}
