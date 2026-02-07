<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Asistencias</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
        .verde { background-color: #d4edda !important; }
        .amarillo { background-color: #fff3cd !important; }
        .rojo { background-color: #f8d7da !important; }
        .btn { background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>📊 Reporte de Asistencias por Estudiante</h1>
    <a href="{{ route('asistencias.index') }}" class="btn">← Volver a Asistencias</a>

    @if(count($estudiantes) > 0)
    <table>
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Total Clases</th>
                <th>Presentes</th>
                <th>% Asistencia</th>
                <th>Ausentes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
            <tr class="{{ $estudiante->porcentaje >= 90 ? 'verde' : ($estudiante->porcentaje >= 70 ? 'amarillo' : 'rojo') }}">
                <td><strong>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</strong></td>
                <td>{{ $estudiante->total_clases }}</td>
                <td>{{ $estudiante->presentes }}</td>
                <td><strong>{{ $estudiante->porcentaje }}%</strong></td>
                <td>{{ $estudiante->total_clases - $estudiante->presentes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div style="padding: 40px; text-align: center; color: #666;">
        <h3>📋 No hay asistencias registradas aún</h3>
        <p>Registra algunas asistencias para ver el reporte</p>
        <a href="{{ route('asistencias.create') }}" class="btn">Nueva Asistencia</a>
    </div>
    @endif
</body>
</html>
