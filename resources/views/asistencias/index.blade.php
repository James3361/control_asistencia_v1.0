@extends('layouts.app')

@section('title', 'Listado de Asistencias')

@section('styles')
<style>
    /* HERO */
    .hero {
        text-align: center;
        margin-bottom: 60px;
        padding: 70px 40px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        border: 2px solid rgba(255,255,255,0.2);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .hero h1 {
        font-size: clamp(32px, 5vw, 48px);
        background: linear-gradient(45deg, #fff, rgba(255,255,255,0.9));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
        font-weight: 900;
    }
    .hero-count {
        font-size: clamp(18px, 3vw, 22px);
        color: rgba(255,255,255,0.95);
        margin-bottom: 15px;
    }

    /* BOTONES */
    .acciones-superiores {
        display: flex;
        gap: 25px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 50px;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 20px 45px;
        border: none;
        border-radius: 30px;
        font-size: clamp(16px, 2.5vw, 18px);
        font-weight: 800;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 12px 35px rgba(0,0,0,0.2);
        white-space: nowrap;
        flex: 1;
        max-width: 350px;
        justify-content: center;
    }
    .btn-primary { background: linear-gradient(45deg, #3498db, #2980b9); color: white; }
    .btn-success { background: linear-gradient(45deg, #27ae60, #229954); color: white; }
    .btn-warning { background: linear-gradient(45deg, #f39c12, #e67e22); color: white; }
    .btn:hover { transform: translateY(-6px); box-shadow: 0 25px 50px rgba(0,0,0,0.3); }

    /* CONTENEDOR TABLA */
    .tabla-container {
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.25);
        border: 3px solid rgba(255,255,255,0.4);
        overflow: hidden;
        margin-bottom: 50px;
    }

    /* ESTADÍSTICAS MINI */
    .tabla-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
        padding: 30px;
        background: rgba(255,255,255,0.6);
        border-radius: 20px;
    }
    .stat-mini {
        text-align: center;
        padding: 25px 15px;
        background: white;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .stat-mini-number { font-size: clamp(20px, 4vw, 28px); font-weight: 800; color: #2c3e50; }
    .stat-mini-label { color: #7f8c8d; font-size: clamp(12px, 2vw, 14px); text-transform: uppercase; letter-spacing: 0.5px; }

    /* TABLA RESPONSIVE */
    .tabla-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        min-width: 680px;
        border-collapse: collapse;
        background: white;
        border-radius: 20px;
        overflow: hidden;
    }
    th {
        background: linear-gradient(135deg, #34495e, #2c3e50);
        color: white;
        padding: clamp(15px, 3vw, 25px) clamp(12px, 2vw, 30px);
        text-align: left;
        font-weight: 800;
        font-size: clamp(13px, 2vw, 16px);
        letter-spacing: 0.5px;
        white-space: nowrap;
    }
    td {
        padding: clamp(15px, 3vw, 22px) clamp(12px, 2vw, 30px);
        border-bottom: 1px solid #ecf0f1;
        vertical-align: middle;
        font-size: clamp(14px, 2.5vw, 16px);
    }
    tr:hover td { background: #f8f9fa; }

    /* ESTADOS */
    .estado-presente {
        background: linear-gradient(135deg, #d5f4e6, #c3e6cb);
        color: #27ae60;
        padding: clamp(6px, 1.5vw, 8px) clamp(12px, 2vw, 20px);
        border-radius: 25px;
        font-weight: 700;
        text-align: center;
        display: inline-block;
        white-space: nowrap;
        min-width: 90px;
        font-size: clamp(12px, 2vw, 14px);
    }
    .estado-ausente {
        background: linear-gradient(135deg, #fadbd8, #f5b7b1);
        color: #e74c3c;
        padding: clamp(6px, 1.5vw, 8px) clamp(12px, 2vw, 20px);
        border-radius: 25px;
        font-weight: 700;
        text-align: center;
        display: inline-block;
        white-space: nowrap;
        min-width: 90px;
        font-size: clamp(12px, 2vw, 14px);
    }

    /* ACCIONES */
    .acciones {
        white-space: nowrap;
        text-align: center;
    }
    .btn-accion {
        padding: clamp(8px, 2vw, 10px) clamp(10px, 2vw, 15px);
        margin: 0 3px;
        border: none;
        border-radius: 12px;
        font-size: clamp(12px, 2vw, 14px);
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s;
        white-space: nowrap;
    }
    .btn-editar { background: linear-gradient(45deg, #3498db, #2980b9); color: white; }
    .btn-eliminar { background: linear-gradient(45deg, #e74c3c, #c0392b); color: white; }
    .btn-accion:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.2); }

    /* VACÍO */
    .vacio {
        text-align: center;
        padding: clamp(80px, 20vw, 120px) 80px;
        color: #7f8c8d;
    }
    .vacio h3 { font-size: clamp(24px, 5vw, 36px); margin-bottom: 25px; color: #34495e; }

    /* RESPONSIVE ESPECIAL */
    @media (max-width: 768px) {
        .tabla-responsive { margin: 0 -15px; padding: 15px; }
        .acciones { 
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
        }
        .btn-accion { width: 100%; max-width: 120px; justify-content: center; }
        th:nth-child(2), td:nth-child(2) { /* Estudiante */ display: none; }
    }
    @media (max-width: 480px) {
        th:nth-child(1), td:nth-child(1) { /* Fecha */ display: none; }
        th:nth-child(4), td:nth-child(4) { /* Hora */ display: none; }
    }
</style>
@endsection

@section('content')
<!-- HERO -->
<div class="hero">
<h1 class="text-3xl font-bold text-gray-800 bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent mb-6">
  Asistencias
</h1>
    <div class="hero-count">
        Total: <strong>{{ $asistencias->count() }}</strong> registros encontrados
        @if($asistencias->hasPages())
            - Página {{ $asistencias->currentPage() }} de {{ $asistencias->lastPage() }}
        @endif
    </div>
</div>

<!-- BOTONES SUPERIORES -->
<div class="acciones-superiores">
    <a href="{{ route('asistencias.create') }}" class="btn btn-success">
        ➕ Nueva Asistencia
    </a>
    <a href="{{ route('reporte.estudiantes') }}" class="btn btn-warning">
        📈 Ver Reporte Completo
    </a>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">
        📊 Dashboard Principal
    </a>
</div>

<!-- TABLA PRINCIPAL -->
<div class="tabla-container">
    <!-- STATS RÁPIDAS -->
    <div class="tabla-stats">
        <div class="stat-mini">
            <div class="stat-mini-number">{{ $asistencias->where('estado', 'presente')->count() }}</div>
            <div class="stat-mini-label">Presentes</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-number">{{ $asistencias->count() }}</div>
            <div class="stat-mini-label">Total</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-number">{{ $asistencias->where('estado', 'ausente')->count() }}</div>
            <div class="stat-mini-label">Ausentes</div>
        </div>
    </div>

    @if($asistencias->count() > 0)
        <!-- CONTENEDOR SCROLL HORIZONTAL -->
        <div class="tabla-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Estudiante</th>
                        <th style="text-align: center;">Estado</th>
                        <th style="text-align: center;">Hora</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asistencias as $asistencia)
                    <tr>
                        <td style="font-weight: 700;">
                            {{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}
                        </td>
                        <td>
                            <strong>{{ $asistencia->matricula->estudiante->nombres ?? 'N/A' }} 
                            {{ $asistencia->matricula->estudiante->apellidos ?? '' }}</strong>
                        </td>
                        <td style="text-align: center;">
                            @if($asistencia->estado == 'presente')
                                <span class="estado-presente">✅ Presente</span>
                            @else
                                <span class="estado-ausente">❌ Ausente</span>
                            @endif
                        </td>
                        <td style="text-align: center; color: #7f8c8d; font-size: 0.9em;">
                            {{ $asistencia->created_at->format('H:i') }}
                        </td>
                        <td class="acciones">
                            <a href="{{ route('asistencias.edit', $asistencia) }}" class="btn-accion btn-editar" title="Editar">
                                ✏️
                            </a>
                            <form method="POST" action="{{ route('asistencias.destroy', $asistencia) }}" 
                                  style="display: inline;" onsubmit="return confirm('¿Eliminar esta asistencia?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-accion btn-eliminar" title="Eliminar">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- PAGINACIÓN -->
        <div style="margin-top: 50px; text-align: center;">
            {{ $asistencias->appends(request()->query())->links() }}
        </div>
    @else
        <div class="vacio">
            <h3>📭 Sin asistencias registradas</h3>
            <p>¡Sé el primero en registrar una asistencia!</p>
            <a href="{{ route('asistencias.create') }}" class="btn btn-success" style="margin-top: 30px;">
                🚀 Nueva Asistencia
            </a>
        </div>
    @endif
</div>
@endsection
