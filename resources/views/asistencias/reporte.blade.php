@extends('layouts.app')

@section('title', 'Reporte Completo de Asistencias')

@section('styles')
<style>
    /* FILTRO PRINCIPAL */
    .hero {
        text-align: center;
        margin-bottom: 60px;
        padding: 60px 40px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        border: 2px solid rgba(255,255,255,0.2);
    }
    .hero h1 {
        font-size: 44px;
        background: linear-gradient(45deg, #fff, rgba(255,255,255,0.9));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
        font-weight: 900;
    }

    /* FILTRO ESPECTACULAR */
    .filtro-container {
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        padding: 50px;
        margin-bottom: 50px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.25);
        border: 3px solid rgba(255,255,255,0.4);
    }
    .filtro-titulo {
        color: #2c3e50;
        text-align: center;
        font-size: 32px;
        margin-bottom: 40px;
        font-weight: 800;
    }
    .filtro-form {
        display: flex;
        gap: 35px;
        align-items: end;
        flex-wrap: wrap;
        justify-content: center;
    }
    .filtro-grupo {
        display: flex;
        flex-direction: column;
        gap: 15px;
        min-width: 250px;
    }
    .filtro-label {
        font-weight: 800;
        color: #34495e;
        font-size: 18px;
    }
    .filtro-input {
        padding: 22px 30px;
        border: 4px solid #3498db;
        border-radius: 25px;
        font-size: 18px;
        background: white;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(52,152,219,0.15);
    }
    .filtro-input:focus {
        outline: none;
        border-color: #2980b9;
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 25px 50px rgba(52,152,219,0.35);
    }

    /* BOTONES */
    .btn {
        padding: 22px 50px;
        border: none;
        border-radius: 35px;
        font-size: 18px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        white-space: nowrap;
    }
    .btn-filtrar {
        background: linear-gradient(45deg, #e74c3c, #c0392b);
        color: white;
        box-shadow: 0 15px 40px rgba(231,76,60,0.4);
    }
    .btn-filtrar:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 60px rgba(231,76,60,0.6);
    }
    .btn-limpiar {
        background: linear-gradient(45deg, #95a5a6, #7f8c8d);
        color: white;
        box-shadow: 0 15px 40px rgba(149,165,166,0.4);
    }
    .btn-volver {
        background: linear-gradient(45deg, #3498db, #2980b9);
        color: white;
        display: inline-flex;
        margin-bottom: 30px;
        box-shadow: 0 15px 40px rgba(52,152,219,0.4);
        align-items: center;
        gap: 12px;
    }

    /* TABLA PROFESIONAL */
    .tabla-container {
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.25);
        border: 3px solid rgba(255,255,255,0.4);
        overflow: hidden;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 35px;
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }
    th {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        color: white;
        padding: 28px 30px;
        text-align: left;
        font-weight: 800;
        font-size: 18px;
        letter-spacing: 0.5px;
    }
    td {
        padding: 25px 30px;
        border-bottom: 1px solid #ecf0f1;
        transition: all 0.3s;
    }
    tr:hover td {
        background: #f8f9fa;
    }
    .verde {
        background: linear-gradient(135deg, #d5f4e6, #c3e6cb) !important;
        border-left: 8px solid #27ae60 !important;
    }
    .verde td { border-color: #a8e6cf; }
    .amarillo {
        background: linear-gradient(135deg, #fff2cc, #ffe699) !important;
        border-left: 8px solid #f39c12 !important;
    }
    .amarillo td { border-color: #f2d492; }
    .rojo {
        background: linear-gradient(135deg, #fadbd8, #f5b7b1) !important;
        border-left: 8px solid #e74c3c !important;
    }
    .rojo td { border-color: #f2a69e; }

    /* ESTADO VACÍO */
    .vacio {
        text-align: center;
        padding: 100px 60px;
        color: #7f8c8d;
    }
    .vacio h3 {
        font-size: 34px;
        margin-bottom: 25px;
        color: #34495e;
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .filtro-form { flex-direction: column; align-items: stretch; }
        .filtro-input { width: 100%; }
    }
    @media (max-width: 768px) {
        table, .tabla-container { font-size: 14px; }
        th, td { padding: 18px 15px; }
        .btn { width: 100%; margin-bottom: 15px; }
    }
</style>
@endsection

@section('content')
<!-- HERO -->
<div class="hero">
    <h1>📊 Reporte Completo</h1>
    <p style="font-size: 20px; color: rgba(255,255,255,0.9);">Estadísticas detalladas de asistencia - {{ now()->format('d F Y') }}</p>
</div>

<!-- FILTRO AVANZADO -->
<div class="filtro-container">
    <h2 class="filtro-titulo">🔍 Filtros de Fecha</h2>
    <form method="GET" action="{{ route('reporte.estudiantes') }}" class="filtro-form">
        <div class="filtro-grupo">
            <label class="filtro-label">📅 Fecha Desde</label>
            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="filtro-input" max="{{ now()->format('Y-m-d') }}">
        </div>
        <div class="filtro-grupo">
            <label class="filtro-label">📅 Fecha Hasta</label>
            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="filtro-input" max="{{ now()->format('Y-m-d') }}">
        </div>
        <button type="submit" class="btn btn-filtrar">🔍 FILTRAR RESULTADOS</button>
        <a href="{{ route('reporte.estudiantes') }}" class="btn btn-limpiar">🗑️ LIMPIAR TODO</a>
    </form>
</div>

<!-- TABLA RESULTADOS -->
<div class="tabla-container">
    <a href="{{ route('asistencias.index') }}" class="btn btn-volver" style="margin-bottom: 30px;">
        ← Volver al Listado de Asistencias
    </a>
    
    @if(count($estudiantes) > 0)
        <table>
            <thead>
                <tr>
                    <th>Estudiante Completo</th>
                    <th>Total Clases</th>
                    <th>Presentes</th>
                    <th style="text-align: center;">% Asistencia</th>
                    <th style="text-align: center;">Ausentes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $estudiante)
                <tr class="{{ $estudiante->porcentaje >= 90 ? 'verde' : ($estudiante->porcentaje >= 70 ? 'amarillo' : 'rojo') }}">
                    <td>
                        <strong style="font-size: 18px;">{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</strong>
                    </td>
                    <td style="font-size: 18px; font-weight: 600;">{{ $estudiante->total_clases }}</td>
                    <td style="font-size: 18px; font-weight: 600;">{{ $estudiante->presentes }}</td>
                    <td style="text-align: center;">
                        <strong style="font-size: 24px; font-weight: 900;">
                            {{ $estudiante->porcentaje }}%
                        </strong>
                    </td>
                    <td style="text-align: center; color: #e74c3c; font-weight: 800; font-size: 20px;">
                        {{ $estudiante->total_clases - $estudiante->presentes }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="text-align: center; margin-top: 40px; padding: 30px; background: rgba(255,255,255,0.5); border-radius: 20px;">
            <p style="font-size: 18px; color: #2c3e50; font-weight: 600;">
                📈 Total estudiantes mostrados: <strong>{{ count($estudiantes) }}</strong>
            </p>
        </div>
    @else
        <div class="vacio">
            <h3>📋 No se encontraron asistencias</h3>
            <p>Ajusta las fechas del filtro o <a href="{{ route('asistencias.create') }}" style="color: #3498db; font-weight: 600;">registra nuevas asistencias</a></p>
            <a href="{{ route('asistencias.create') }}" class="btn btn-success" style="margin-top: 30px; display: inline-block;">
                ➕ Registrar Primera Asistencia
            </a>
        </div>
    @endif
</div>
@endsection
