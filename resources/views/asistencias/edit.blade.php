@extends('layouts.app')

@section('title', 'Editar Asistencia')

@section('styles')
<style>
    /* MISMO CSS que CREATE - COPIAR TODO */
    .hero {
        text-align: center;
        margin-bottom: 60px;
        padding: 70px 40px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        border: 2px solid rgba(255,255,255,0.2);
    }
    .hero h1 {
        font-size: clamp(32px, 5vw, 48px);
        background: linear-gradient(45deg, #fff, rgba(255,255,255,0.9));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
        font-weight: 900;
    }
    .hero-subtitle {
        font-size: 20px;
        color: rgba(255,255,255,0.9);
        margin-bottom: 10px;
    }

    /* FORMULARIO */
    .form-container {
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(25px);
        border-radius: 30px;
        padding: 60px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.25);
        border: 3px solid rgba(255,255,255,0.4);
        max-width: 700px;
        margin: 0 auto 50px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .form-label {
        font-weight: 800;
        color: #2c3e50;
        font-size: 18px;
        margin-bottom: 8px;
    }
    .form-input, .form-select {
        padding: 22px 25px;
        border: 3px solid #e1e8ed;
        border-radius: 20px;
        font-size: 18px;
        background: white;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #3498db;
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(52,152,219,0.15);
    }

    /* ESTADO TOGGLE */
    .estado-group {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }
    .estado-option {
        flex: 1;
        padding: 20px;
        border: 3px solid #e1e8ed;
        border-radius: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
        font-weight: 700;
        font-size: 18px;
    }
    .estado-option:hover {
        border-color: #3498db;
        transform: translateY(-2px);
    }
    .estado-option.selected {
        background: linear-gradient(135deg, #27ae60, #229954);
        color: white;
        border-color: #27ae60;
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(39,174,96,0.3);
    }

    /* BOTONES */
    .form-botones {
        display: flex;
        gap: 25px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 50px;
    }
    .btn {
        padding: 22px 50px;
        border: none;
        border-radius: 30px;
        font-size: 18px;
        font-weight: 800;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: all 0.4s;
        white-space: nowrap;
        flex: 1;
        max-width: 250px;
        justify-content: center;
    }
    .btn-primary { background: linear-gradient(45deg, #f39c12, #e67e22); color: white; }
    .btn-secondary { background: linear-gradient(45deg, #95a5a6, #7f8c8d); color: white; }
    .btn-danger { background: linear-gradient(45deg, #e74c3c, #c0392b); color: white; }
    .btn:hover { transform: translateY(-6px); box-shadow: 0 25px 50px rgba(0,0,0,0.3); }

    /* ERRORES */
    .error-message {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
        font-weight: 500;
    }
    .input-error {
        border-color: #e74c3c !important;
        box-shadow: 0 0 0 3px rgba(231,76,60,0.1) !important;
    }

    /* INFO ASISTENCIA */
    .info-actual {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        padding: 25px;
        border-radius: 20px;
        margin-bottom: 40px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .form-row { grid-template-columns: 1fr; gap: 25px; }
        .form-container { padding: 40px 30px; margin: 0 20px; }
        .estado-group { flex-direction: column; }
    }
</style>
@endsection

@section('content')
<div class="hero">
    <h1>✏️ Editar Asistencia</h1>
    <p class="hero-subtitle">{{ $asistencia->matricula->estudiante->nombres ?? 'N/A' }} {{ $asistencia->matricula->estudiante->apellidos ?? '' }}</p>
</div>

<!-- INFO ACTUAL -->
<div class="form-container" style="background: linear-gradient(135deg, #3498db, #2980b9); color: white; text-align: center;">
    <div class="info-actual">
        <h3 style="font-size: 24px; margin-bottom: 10px;">📋 Datos Actuales</h3>
        <p style="font-size: 18px; opacity: 0.95;">
            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}<br>
            <strong>Estado:</strong> 
            @if($asistencia->estado == 'presente')
                <span style="color: #27ae60;">✅ Presente</span>
            @else
                <span style="color: #e74c3c;">❌ Ausente</span>
            @endif
        </p>
    </div>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('asistencias.update', $asistencia) }}">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <!-- ESTUDIANTE (solo lectura) -->
            <div class="form-group">
                <label class="form-label">👤 Estudiante</label>
                <input type="text" value="{{ $asistencia->matricula->estudiante->nombres ?? 'N/A' }} {{ $asistencia->matricula->estudiante->apellidos ?? '' }}" 
                       class="form-input" readonly style="background: #f8f9fa; color: #7f8c8d;">
            </div>

            <!-- FECHA -->
            <div class="form-group">
                <label class="form-label">📅 Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha', $asistencia->fecha) }}" 
                       class="form-input @error('fecha') input-error @enderror" max="{{ now()->format('Y-m-d') }}">
                @error('fecha')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- ESTADO -->
        <div class="form-group">
            <label class="form-label">📊 Estado</label>
            <div class="estado-group">
                <div class="estado-option {{ old('estado', $asistencia->estado) == 'presente' ? 'selected' : '' }}" 
                     onclick="selectEstado(this, 'presente')">
                    <div style="font-size: 24px;">✅</div>
                    Presente
                </div>
                <div class="estado-option {{ old('estado', $asistencia->estado) == 'ausente' ? 'selected' : '' }}" 
                     onclick="selectEstado(this, 'ausente')">
                    <div style="font-size: 24px;">❌</div>
                    Ausente
                </div>
            </div>
            <input type="hidden" name="estado" id="estado-input" value="{{ old('estado', $asistencia->estado) }}">
            @error('estado')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- BOTONES -->
        <div class="form-botones">
            <button type="submit" class="btn btn-primary">
                💾 Actualizar Asistencia
            </button>
            <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">
                ← Volver al Listado
            </a>
            <form method="POST" action="{{ route('asistencias.destroy', $asistencia) }}" style="display: inline;" 
                  onsubmit="return confirm('¿Eliminar permanentemente esta asistencia?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Eliminar</button>
            </form>
        </div>
    </form>
</div>

<script>
function selectEstado(element, estado) {
    document.querySelectorAll('.estado-option').forEach(opt => opt.classList.remove('selected'));
    element.classList.add('selected');
    document.getElementById('estado-input').value = estado;
}
</script>
@endsection
