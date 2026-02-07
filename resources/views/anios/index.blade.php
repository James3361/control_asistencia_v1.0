<!DOCTYPE html>
<html>
<head>
    <title>Años escolares</title>
</head>

<div style="text-align: center; margin: 40px 0;">
    <a href="{{ route('dashboard') }}" class="btn" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white; padding: 20px 60px; font-size: 22px; border-radius: 50px; text-decoration: none; font-weight: bold;">
        🚀 IR AL DASHBOARD PRINCIPAL
    </a>
</div>

<body>
    <h1>Años escolares</h1>

    <a href="{{ route('anios.create') }}">Crear año escolar</a>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anios as $anio)
                <tr>
                    <td>{{ $anio->id }}</td>
                    <td>{{ $anio->nombre }}</td>
                    <td>{{ $anio->fecha_inicio }}</td>
                    <td>{{ $anio->fecha_fin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
