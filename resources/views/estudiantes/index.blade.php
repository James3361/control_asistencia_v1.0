@extends('layouts.app')

@section('title', 'Gestión de Estudiantes')

@section('styles')
<style>
    /* Hero igual que asistencias */
    .hero { /* copy from asistencias/index */ }
    
    /* Tabla responsive igual */
    .tabla-container { /* copy from asistencias/index */ }
    
    .tabla-responsive { /* copy from asistencias/index */ }
    
    /* Campos específicos estudiantes */
    .estudiante-avatar {
        width: 50px; height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white; font-weight: 800; font-size: 18px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    
    .cedula { font-family: monospace; font-weight: 700; color: #3498db; }
    .telefono { color: #27ae60; }
    
    .acciones-superiores {
        display: flex; gap: 25px; justify-content: center;
        flex-wrap: wrap; margin-bottom: 50px;
    }
    .btn { /* copy from asistencias */ }
</style>
@endsection

@section('content')
<div class="hero">
    <h1>👥 Estudiantes Registrados</h1>
    <div class="hero-count">Total: <strong>{{ $estudiantes->count() }}</strong></div>
</div>

<div class="acciones-superiores">
    <a href="{{ route('estudiantes.create') }}" class="btn btn-success">➕ Nuevo Estudiante</a>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">📊 Dashboard</a>
</div>

<div class="tabla-container">
    @if($estudiantes->count() > 0)
        <div class="tabla-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre Completo</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estudiantes as $estudiante)
                    <tr>
                        <td>
                            <div class="estudiante-avatar">
                                {{ substr($estudiante->nombres, 0, 1) }}{{ substr($estudiante->apellidos, 0, 1) }}
                            </div>
                        </td>
                        <td>
                            <strong style="font-size: 18px;">
                                {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
                            </strong>
                        </td>
                        <td><span class="cedula">V-{{ $estudiante->cedula }}</span></td>
                        <td><span class="telefono">{{ $estudiante->telefono }}</span></td>
                        <td class="acciones">
                            <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn-accion btn-editar">✏️</a>
                            <form method="POST" action="{{ route('estudiantes.destroy', $estudiante) }}" style="display: inline;" onsubmit="return confirm('¿Eliminar estudiante?')">
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
            {{ $estudiantes->links() }}
        </div>
    @else
        <div class="vacio">
            <h3>📭 No hay estudiantes</h3>
            <a href="{{ route('estudiantes.create') }}" class="btn btn-success">➕ Primer Estudiante</a>
        </div>
    @endif
</div>
@endsection
