<?php

namespace App\Http\Controllers;

use App\Models\AnioEscolar;
use App\Models\Institucion;
use Illuminate\Http\Request;

class AnioEscolarController extends Controller
{
    public function index()
    {
        $anios = AnioEscolar::all();
        return view('anios.index', compact('anios'));
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
}

    
