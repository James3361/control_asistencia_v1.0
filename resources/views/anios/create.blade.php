<!DOCTYPE html>
<html>
<head>
    <title>Crear año escolar</title>
</head>
<body>
    <h1>Crear año escolar</h1>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('anios.store') }}" method="POST">
        @csrf
        <div>
            <label>Nombre (ej: 2025-2026)</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}">
        </div>

        <div>
            <label>Fecha inicio</label>
            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}">
        </div>

        <div>
            <label>Fecha fin</label>
            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}">
        </div>

        <input type="hidden" name="institucion_id" value="{{ $institucion->id ?? 1 }}">

        <button type="submit">Guardar</button>
    </form>

    <a href="{{ route('anios.index') }}">Volver</a>
</body>
</html>
