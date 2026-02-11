@extends('layouts.app')

@section('title', 'Editar Matrícula')

@section('content')
<div class="hero">
    <h1>✏️ Editar Matrícula</h1>
</div>

<div class="form-container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('matriculas.update', $matricula) }}">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">👤 Estudiante</label>
                <select name="estudiante_id" class="form-input" required>
                    @foreach($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}" 
                                {{ old('estudiante_id', $matricula->estudiante_id) == $estudiante->id ? 'selected' : '' }}>
                            {{ $estudiante->nombres }} {{ $estudiante->apellidos }} ({{ $estudiante->documento }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">📅 Año Escolar</label>
                <select name="anio_escolar_id" class="form-input" required>
                    @foreach($anios as $anio)
                        <option value="{{ $anio->id }}" 
                                {{ old('anio_escolar_id', $matricula->anio_escolar_id) == $anio->id ? 'selected' : '' }}>
                            {{ $anio->anio_inicio }}-{{ $anio->anio_fin }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-botones">
            <button type="submit" class="btn btn-primary">💾 Actualizar Matrícula</button>
            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">← Volver</a>
        </div>
    </form>
</div>
@endsection
