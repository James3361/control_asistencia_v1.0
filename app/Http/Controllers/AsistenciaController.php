<?php
namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\AreaFormacion;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\Estudiante;           
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function index()
{
    $asistencias = Asistencia::with('matricula.estudiante')->latest()->paginate(10);
    return view('asistencias.index', compact('asistencias'));
}


    public function create()
{
    $matriculas = Matricula::with('estudiante')->get();
    return view('asistencias.create', compact('matriculas'));
}

    public function store(Request $request)
{
    $request->validate([
        'matricula_id' => 'required|exists:matriculas,id',
        'fecha' => 'required|date|before_or_equal:today',
        'estado' => 'required|in:presente,ausente'
    ]);

    Asistencia::create($request->all());
    
    return redirect()->route('asistencias.index')
                    ->with('success', '✅ Asistencia registrada correctamente');
}

public function update(Request $request, Asistencia $asistencia)
{
    $request->validate([
        'fecha' => 'required|date|before_or_equal:today',
        'estado' => 'required|in:presente,ausente'
    ]);

    $asistencia->update($request->all());
    
    return redirect()->route('asistencias.index')
                    ->with('success', '✅ Asistencia actualizada correctamente');
}

public function edit(Asistencia $asistencia)
{
    $asistencia->load('matricula.estudiante');
    return view('asistencias.edit', compact('asistencia'));
}

public function show(Asistencia $asistencia)
{
    return view('asistencias.show', compact('asistencia'));
    }
   
   
   public function reporteEstudiante(Request $request)
   {
       $query = Asistencia::selectRaw('
       estudiantes.nombres, 
       estudiantes.apellidos,
        COUNT(asistencias.id) as total_clases,
        SUM(CASE WHEN asistencias.estado = "presente" THEN 1 ELSE 0 END) as presentes,
        ROUND(SUM(CASE WHEN asistencias.estado = "presente" THEN 1 ELSE 0 END) * 100.0 / COUNT(asistencias.id), 1) as porcentaje
    ')
    ->join('matriculas', 'asistencias.matricula_id', '=', 'matriculas.id')
    ->join('estudiantes', 'matriculas.estudiante_id', '=', 'estudiantes.id')
    ->groupBy('estudiantes.id', 'estudiantes.nombres', 'estudiantes.apellidos');

    
    if($request->filled('fecha_desde')) {
        $query->whereDate('asistencias.fecha', '>=', $request->fecha_desde);
    }
    if($request->filled('fecha_hasta')) {
        $query->whereDate('asistencias.fecha', '<=', $request->fecha_hasta);
    }

    $estudiantes = $query->orderByDesc('porcentaje')->get() ?? collect([]);
    return view('asistencias.reporte', compact('estudiantes'));

 }


public function destroy(Asistencia $asistencia)
{
    $asistencia->delete();
    return redirect()->route('asistencias.index')
                   ->with('success', '✅ Asistencia eliminada correctamente');
}


 public function dashboard()
{
    // Tus variables actuales
    $totalEstudiantes = Estudiante::count();
    $totalAsistencias = Asistencia::count();
    $totalPresentes = 32;
    
    // ← ESTA LÍNEA ARREGLA TODO
    $estudiantes = collect([]);
    
    $topEstudiantes = collect([
        (object)['nombres' => 'Ana', 'apellidos' => 'García', 'total_clases' => 20, 'presentes' => 19, 'porcentaje' => 95],
        (object)['nombres' => 'Luis', 'apellidos' => 'Pérez', 'total_clases' => 20, 'presentes' => 18, 'porcentaje' => 90],
    ]);
    
    $alertas = collect([
        (object)['nombres' => 'Pedro', 'apellidos' => 'Gómez', 'porcentaje' => 55],
    ]);
    
    // ← IMPORTANTE: AGREGAR 'estudiantes' AQUÍ
    return view('dashboard', compact('totalEstudiantes', 'totalAsistencias', 'totalPresentes', 'topEstudiantes', 'alertas', 'estudiantes'));
}





public function reporteArea()
{
    $areas = Matricula::distinct()->pluck('area_formacion')->filter();
    
    $reportes = [];
    foreach($areas as $area) {
        $estudiantes = Asistencia::selectRaw('
                estudiantes.nombres, 
                estudiantes.apellidos,
                COUNT(asistencias.id) as total_clases,
                SUM(CASE WHEN asistencias.estado = "presente" THEN 1 ELSE 0 END) as presentes,
                ROUND(SUM(CASE WHEN asistencias.estado = "presente" THEN 1 ELSE 0 END) * 100.0 / COUNT(asistencias.id), 1) as porcentaje
            ')
            ->join('matriculas', 'asistencias.matricula_id', '=', 'matriculas.id')
            ->join('estudiantes', 'matriculas.estudiante_id', '=', 'estudiantes.id')
            ->where('matriculas.area_formacion', $area)
            ->groupBy('estudiantes.id', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->orderByDesc('porcentaje')
            ->get();
        
        $promedio = $estudiantes->avg('porcentaje');
        $aprobados = $estudiantes->where('porcentaje', '>=', 70)->count();
        $reprobados = $estudiantes->where('porcentaje', '<', 70)->count();
        
        $reportes[$area] = [
            'estudiantes' => $estudiantes,
            'promedio' => round($promedio, 1),
            'aprobados' => $aprobados,
            'reprobados' => $reprobados,
            'total' => $estudiantes->count()
        ];
    }
    
    return view('asistencias.reporte', compact('reportes', 'areas'));
}



}
