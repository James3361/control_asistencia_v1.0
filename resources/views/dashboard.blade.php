@extends('layouts.app')

@section('title', 'Dashboard Principal')

@section('styles')
<style>
    /* ESTADÍSTICAS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }
    .stat-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(25px);
        border-radius: 25px;
        padding: 45px 30px;
        text-align: center;
        box-shadow: 0 25px 60px rgba(0,0,0,0.2);
        border: 3px solid rgba(255,255,255,0.4);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #3498db, #2ecc71, #e74c3c);
    }
    .stat-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 35px 80px rgba(0,0,0,0.3);
    }
    .stat-number {
        font-size: 56px;
        font-weight: 900;
        margin-bottom: 15px;
        line-height: 1;
    }
    .stat-total {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .stat-presente { color: #27ae60; }
    .stat-asistencias { color: #3498db; }
    .stat-estudiantes { color: #e74c3c; }

    /* SECCIONES */
    .sections-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 50px;
    }
    .section {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(25px);
        border-radius: 25px;
        padding: 45px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.2);
        border: 3px solid rgba(255,255,255,0.4);
    }
    .section-title {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 35px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* CARDS ESTUDIANTES */
    .estudiantes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 25px;
    }
    .estudiante-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        display: flex;
        align-items: center;
        gap: 25px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-left: 5px solid #3498db;
    }
    .estudiante-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    }
    .estudiante-foto {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        font-weight: 800;
        flex-shrink: 0;
    }
    .estudiante-info h4 {
        color: #2c3e50;
        font-size: 22px;
        margin-bottom: 8px;
        font-weight: 700;
    }
    .estudiante-meta {
        color: #7f8c8d;
        font-size: 15px;
        margin-bottom: 10px;
    }
    .porcentaje {
        font-size: 38px;
        font-weight: 900;
        margin-left: auto;
        line-height: 1;
    }
    .verde { color: #27ae60; border-left-color: #27ae60 !important; }
    .amarillo { color: #f39c12; border-left-color: #f39c12 !important; }
    .rojo { color: #e74c3c; border-left-color: #e74c3c !important; }

    /* ACCIONES */
    .acciones {
        text-align: center;
        padding: 40px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        margin-top: 40px;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 18px 40px;
        border: none;
        border-radius: 30px;
        font-size: 18px;
        font-weight: 700;
        text-decoration: none;
        margin: 0 15px 20px 0;
        transition: all 0.4s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .btn-primary {
        background: linear-gradient(45deg, #3498db, #2980b9);
        color: white;
    }
    .btn-success {
        background: linear-gradient(45deg, #27ae60, #229954);
        color: white;
    }
    .btn-warning {
        background: linear-gradient(45deg, #f39c12, #e67e22);
        color: white;
    }
    .btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(0,0,0,0.3);
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .sections-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
        .estudiante-card { flex-direction: column; text-align: center; }
        .porcentaje { margin-left: 0; margin-top: 20px; }
        .btn { display: block; width: 100%; max-width: 300px; margin: 10px auto; }
    }
</style>
@endsection

@section('content')
<!-- HERO -->
<div style="text-align: center; margin-bottom: 60px; padding: 60px 20px; background: rgba(255,255,255,0.1); backdrop-filter: blur(25px); border-radius: 30px; border: 2px solid rgba(255,255,255,0.2);">
    <h1 style="font-size: 48px; background: linear-gradient(45deg, #fff, rgba(255,255,255,0.8)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 20px; font-weight: 900;">
        🚀 Dashboard Principal
    </h1>
    <p style="font-size: 22px; color: rgba(255,255,255,0.95); margin-bottom: 10px;">Sistema de Control Escolar</p>
    <p style="font-size: 18px; color: rgba(255,255,255,0.8);">Estadísticas actualizadas - {{ now()->format('d M Y \a\l\ \h:ia') }}</p>
</div>

<!-- ESTADÍSTICAS PRINCIPALES -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number stat-estudiantes">{{ $totalEstudiantes }}</div>
        <div class="stat-total">Estudiantes Total</div>
    </div>
    <div class="stat-card">
        <div class="stat-number stat-asistencias">{{ $totalAsistencias }}</div>
        <div class="stat-total">Asistencias Registradas</div>
    </div>
    <div class="stat-card">
        <div class="stat-number stat-presente">{{ $totalPresentes }}</div>
        <div class="stat-total">
            @if($totalAsistencias > 0)
                {{ number_format(($totalPresentes/$totalAsistencias)*100, 1) }}% Presentes
            @else
                0% Presentes
            @endif
        </div>
    </div>
</div>

<!-- SECCIONES TOP Y ALERTAS -->
<div class="sections-grid">
    <!-- TOP 5 ESTUDIANTES -->
    <div class="section">
        <h2 class="section-title">🏆 Top 5 Estudiantes <span style="font-size: 18px; color: #7f8c8d;">(Mejor asistencia)</span></h2>
        <div class="estudiantes-grid">
            @forelse($topEstudiantes as $index => $estudiante)
            <div class="estudiante-card {{ $estudiante->porcentaje >= 90 ? 'verde' : ($estudiante->porcentaje >= 70 ? 'amarillo' : 'rojo') }}">
                <div class="estudiante-foto">
                    {{ substr($estudiante->nombres, 0, 1) }}{{ substr($estudiante->apellidos, 0, 1) }}
                </div>
                <div style="flex: 1;">
                    <h4>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</h4>
                    <div class="estudiante-meta">{{ $estudiante->presentes }} de {{ $estudiante->total_clases }} clases</div>
                </div>
                <div class="porcentaje {{ $estudiante->porcentaje >= 90 ? 'verde' : ($estudiante->porcentaje >= 70 ? 'amarillo' : 'rojo') }}">
                    {{ $estudiante->porcentaje }}%
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: #7f8c8d;">
                <h3>📊 Sin datos</h3>
                <p>Registra asistencias para ver el ranking</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- ALERTAS RIESGO -->
    <div class="section">
        <h2 class="section-title">🚨 Estudiantes en Riesgo <span style="font-size: 18px; color: #7f8c8d;">(&lt;70% asistencia)</span></h2>
        @if(count($alertas) > 0)
        <div style="max-height: 550px; overflow-y: auto;">
            @foreach($alertas as $alerta)
            <div class="estudiante-card rojo">
                <div class="estudiante-foto" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                    {{ substr($alerta->nombres, 0, 1) }}{{ substr($alerta->apellidos, 0, 1) }}
                </div>
                <div style="flex: 1;">
                    <h4 style="color: #c0392b; font-weight: 700;">{{ $alerta->nombres }} {{ $alerta->apellidos }}</h4>
                </div>
                <div class="porcentaje rojo">{{ $alerta->porcentaje }}%</div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align: center; padding: 80px 40px; color: #27ae60;">
            <div style="font-size: 80px; margin-bottom: 20px;">✅</div>
            <h3 style="font-size: 28px; margin-bottom: 15px;">¡Excelente!</h3>
            <p style="font-size: 18px;">Todos los estudiantes tienen buena asistencia</p>
        </div>
        @endif
    </div>
</div>

<!-- ACCIONES RÁPIDAS -->
<div class="acciones">
    <h3 style="color: white; margin-bottom: 30px; font-size: 24px;">⚡ Acciones Rápidas</h3>
    <a href="{{ route('asistencias.index') }}" class="btn btn-primary">📋 Ver Asistencias</a>
    <a href="{{ route('asistencias.create') }}" class="btn btn-success">➕ Nueva Asistencia</a>
    <a href="{{ route('reporte.estudiantes') }}" class="btn btn-warning">📈 Ver Reporte Completo</a>
</div>
@endsection
