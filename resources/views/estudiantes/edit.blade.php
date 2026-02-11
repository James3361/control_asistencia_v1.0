@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
<div class="hero">
    <h1>✏️ Editar Estudiante</h1>
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
    
    <form method="POST" action="{{ route('estudiantes.update', $estudiante) }}">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">👤 Nombres</label>
                <input type="text" name="nombres" value="{{ old('nombres', $estudiante->nombres) }}" class="form-input @error('nombres') input-error @enderror" required>
                @error('nombres') <div class="error-message">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">👤 Apellidos</label>
                <input type="text" name="apellidos" value="{{ old('apellidos', $estudiante->apellidos) }}" class="form-input @error('apellidos') input-error @enderror" required>
                @error('apellidos') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">🆔 Documento</label>
                <input type="text" name="documento" value="{{ old('documento', $estudiante->documento) }}" class="form-input @error('documento') input-error @enderror" required>
                @error('documento') <div class="error-message">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">📱 Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $estudiante->telefono) }}" class="form-input @error('telefono') input-error @enderror">
                @error('telefono') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">📧 Correo</label>
                <input type="email" name="correo" value="{{ old('correo', $estudiante->correo) }}" class="form-input @error('correo') input-error @enderror">
                @error('correo') <div class="error-message">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">📅 Fecha Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}" class="form-input">
            </div>
        </div>
        
        <input type="hidden" name="institucion_id" value="{{ $institucion->id ?? 1 }}">
        
        <div class="form-botones">
            <button type="submit" class="btn btn-primary">💾 Actualizar Estudiante</button>
            <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">← Volver</a>
        </div>
    </form>
</div>
@endsection
