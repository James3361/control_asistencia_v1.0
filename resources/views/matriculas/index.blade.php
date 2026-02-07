@extends('layouts.app')

@section('title', 'Gestión de Matrículas')

@section('styles')
<style>
    /* Copiar CSS base de estudiantes/index */
    .hero, .tabla-container, .tabla-responsive, .btn { /* igual que estudiantes */ }
    
    /* Específico para matrículas */
    .matricula-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 14px;
        display: inline-block;
    }
    .area-informatica { background: linear-gradient(135deg, #3498db, #2980b9); color: white; }
    .area-matematicas { background: linear-gradient(135deg, #e74c3c, #c0392b); color: white; }
    .area-idiomas { background: linear-gradient(135deg, #27ae60, #229954); color: white; }
    .area-general { background: linear-gradient(135deg, #95a5a6, #7f8c8d); color: white; }
    
    .seccion-badge {
        background: rgba(52,152,219,0.1);
        color: #3498db;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="hero">
    <h1>🎓 Matrículas Activas</h1>
    <div class="hero-count">Total: <strong>{{ $matriculas->count() }}</strong></div>
</div>

<div class="acciones-superiores">
    <a href="{{ route('matriculas.create') }}" class="btn btn-success">➕ Nueva Matrícula</a>
    <a href="{{ route('estudiantes.index') }}" class="btn btn-primary">👥 Estudiantes</a>
</div>

<div class="tabla-container">
    @if($matriculas->count() > 0)
        <div class="tabla-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Área Formación</th>
                        <th>Sección</th>
                        <th>Año Escolar</th>
                        <th>Asistencias</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matriculas as $matricula)
                    <tr>
                        <td>
                            <strong>{{ $matricula->estudiante->nombres }} {{ $matricula->estudiante->apellidos }}</strong>
                        </td>
                        <td>
                            <span class="matricula-badge area-{{ strtolower(str_replace(' ', '-', $matricula->area_formacion)) }}">
                                {{ $matricula->area_formacion }}
                            </span>
                        </td>
                        <td><span class="seccion-badge">{{ $matricula->seccion ?? 'N/A' }}</span></td>
                        <td style="font-weight: 600; color: #2c3e50;">
                            {{ $matricula->anio_escolar ?? 'Actual' }}
                        </td>
                        <td style="text-align: center;">
                            {{ $matricula->asistencias()->count() }}
                        </td>
                        <td class="acciones">
                            <a href="{{ route('matriculas.edit', $matricula) }}" class="btn-accion btn-editar">✏️</a>
                            <form method="POST" action="{{ route('matriculas.destroy', $matricula) }}" style="display: inline;" onsubmit="return confirm('¿Eliminar matrícula?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-accion btn-eliminar">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 50px; text-align: center;">
            {{ $matriculas->links() }}
        </div>
    @else
        <div class="vacio">
            <h3>📭 Sin matrículas</h3>
            <a href="{{ route('matriculas.create') }}" class="btn btn-success">➕ Primera Matrícula</a>
        </div>
    @endif
</div>
@endsection
