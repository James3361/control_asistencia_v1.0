@extends('layouts.app')

@section('title', 'Nueva Matrícula')

@section('styles')
/* Copiar CSS completo de estudiantes/create */
@endsection

@section('content')
<div class="hero">
    <h1>➕ Nueva Matrícula</h1>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('matriculas.store') }}">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">👤 Estudiante</label>
                <select name="estudiante_id" class="form-select @error('estudiante_id') input-error @enderror" required>
                    <option value="">Selecciona estudiante...</option>
                    @foreach($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                            {{ $estudiante->nombres }} {{ $estudiante->apellidos }} ({{ $estudiante->cedula }})
                        </option>
                    @endforeach
                </select>
                @error('estudiante_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">📚 Área Formación</label>
                <select name="area_formacion" class="form-select @error('area_formacion') input-error @enderror" required>
                    <option value="">Selecciona área...</option>
                    <option value="Matemáticas" {{ old('area_formacion') == 'Matemáticas' ? 'selected' : '' }}>Matemáticas</option>
                    <option value="Informática" {{ old('area_formacion') == 'Informática' ? 'selected' : '' }}>Informática</option>
                    <option value="Idiomas" {{ old('area_formacion') == 'Idiomas' ? 'selected' : '' }}>Idiomas</option>
                    <option value="Ciencias" {{ old('area_formacion') == 'Ciencias' ? 'selected' : '' }}>Ciencias</option>
                    <option value="General" {{ old('area_formacion') == 'General' ? 'selected' : '' }}>General</option>
                </select>
                @error('area_formacion') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">🏫 Sección</label>
                <input type="text" name="seccion" value="{{ old('seccion') }}" class="form-input @error('seccion') input-error @enderror" placeholder="A-1, B-2, etc">
                @error('seccion') <div class="error-message">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">📅 Año Escolar</label>
                <input type="text" name="anio_escolar" value="{{ old('anio_escolar', now()->format('Y')) }}" class="form-input @error('anio_escolar') input-error @enderror">
                @error('anio_escolar') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>
        
        <div class="form-botones">
            <button type="submit" class="btn btn-primary">💾 Guardar Matrícula</button>
            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">← Volver</a>
        </div>
    </form>
</div>
@endsection
