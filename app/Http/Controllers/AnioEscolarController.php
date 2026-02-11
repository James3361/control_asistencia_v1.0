<?php

namespace App\Http\Controllers;

use App\Models\AnioEscolar;
use App\Models\Institucion;
use Illuminate\Http\Request;

class AnioEscolarController extends Controller
{
    public function index()
{
    $totalAnios = AnioEscolar::count();
    
    $anios = AnioEscolar::orderBy('id', 'desc')
                ->paginate(12);

 
                
   return view('anios.index', compact('anios', 'totalAnios'));

    
}

  public function update(Request $request, AnioEscolar $anio)
    {
        $request->validate([
            'nombre' => 'required|string|max:20|unique:anio_escolares,nombre,' . $anio->id,
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $anio->update($request->all());

        return redirect()->route('anios.index')
                        ->with('success', '✅ Año escolar actualizado correctamente');
    }


    public function create()
    {
        // Suponemos una sola institución, por ahora usamos la primera
        $institucion = Institucion::first();
        return view('anios.create', compact('institucion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after_or_equal:fecha_inicio',
            'institucion_id'=> 'required|exists:instituciones,id',
        ]);

        AnioEscolar::create($request->all());

        return redirect()->route('anios.index')->with('success', 'Año escolar creado correctamente');
    }

     public function edit(AnioEscolar $anio)
    {
        return view('anios.edit', compact('anio'));
    }

     public function destroy(AnioEscolar $anio)
    {
        $anio->delete();
        return redirect()->route('anios.index')
                        ->with('success', '✅ Año escolar eliminado correctamente');
    }
}

    
