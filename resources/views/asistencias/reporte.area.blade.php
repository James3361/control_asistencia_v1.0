@extends('layouts.app')

@section('title', 'Reporte por Área de Formación')

@section('styles')
<style>
    .hero { /* igual que otros */ }
    .areas-grid {
        display: grid;
        gap: 40px;
        margin-bottom: 60px;
    }
    .area-section {
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.25);
        border: 3px solid rgba(255,255,255,0.4);
    }
    .area-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 3px solid #ecf0f1;
    }
    .area-titulo {
        font-size: 32px;
        font-weight: 800;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .area-stats {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }
    .stat-area {
        text-align: center;
        padding: 25px 30px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        min-width: 140px;
    }
    .stat-numero { font-size: 32px; font-weight: 900; color: #27ae60; }
    .stat-rojo { color: #e74c3c !important; }
    
    .estudiantes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 25px;
    }
    .estudiante-area {
        background: white;
        border-radius: 20px;
        padding: 30px;
        display: flex;
        align-items: center;
        gap: 25px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        transition: all 0.4s;
        border-left: 5px solid #3498db;
    }
    .estudiante-area:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    }
    /* resto igual que dashboard */
</style>
@endsection

@section('content')
<div class="hero">
    <h1>📚 Reporte por Área de Formación</h1>
    <p>Aprobación/Reprobación anual por especialidad</p>
</div>

<a href="{{ route('asistencias.index') }}" class="btn btn-secondary" style="display: block; max-width: 300px; margin: 0 auto 50px;">
    ← Volver al Listado
</a>

<div class="areas-grid">
    @foreach($reportes as $area => $datos)
    <div class="area-section">
        <div class="area-header">
            <h2 class="area-titulo">🎓 {{ $area }}</h2>
            <div class="area-stats">
                <div class="stat-area">
                    <div class="stat-numero">{{ $datos['total'] }}</div>
                    <div style="color: #7f8c8d; font-weight: 600;">Estudiantes</div>
                </div>
                <div class="stat-area">
                    <div class="stat-numero {{ $datos['promedio'] >= 70 ? '' : 'stat-rojo' }}">{{ $datos['promedio'] }}%</div>
                    <div style="color: #7f8c8d; font-weight: 600;">Promedio</div>
                </div>
                <div class="stat-area">
                    <div class="stat-numero">{{ $datos['aprobados'] }}</div>
                    <div style="color: #27ae60; font-weight: 600;">Aprobados</div>
                </div>
                <div class="stat-area">
                    <div class="stat-numero stat-rojo">{{ $datos['reprobados'] }}</div>
                    <div style="color: #e74c3c; font-weight: 600;">Reprobados</div>
                </div>
            </div>
        </div>
        
        <div class="estudiantes-grid">
            @foreach($datos['estudiantes'] as $estudiante)
            <div class="estudiante-area {{ $estudiante->porcentaje >= 90 ? 'verde' : ($estudiante->porcentaje >= 70 ? 'amarillo' : 'rojo') }}">
                <div class="estudiante-foto">
                    {{ substr($estudiante->nombres, 0, 1) }}{{ substr($estudiante->apellidos, 0, 1) }}
                </div>
                <div style="flex: 1;">
                    <h4>{{ $estudiante->n Cumple 100% con SEMANA 6 del plan! 🎓
                    
                    **¡PRUEBA YA!**
                    ```
                    http://127.0.0.1:8000/reporte-area
                    ```
                    
                    **¡Agrega al menú del layout:**
                    ```blade
                    <a href="{{ route('reporte.area') }}" class="nav-link {{ request()->routeIs('reporte.area') ? 'nav-active' : '' }}">📚 Áreas</a>
                    ```
                    
                    **¡Dime "ÁREA OK" y pasamos a SEMANA 7!** 🔥
