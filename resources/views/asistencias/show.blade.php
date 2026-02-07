<!DOCTYPE html>
<html><head><title>Asistencia</title></head><body>
<h1>Detalle Asistencia</h1>
<p><strong>ID:</strong> {{ $asistencia->id }}</p>
<p><strong>Fecha:</strong> {{ $asistencia->fecha->format('d/m/Y') }}</p>
<p><strong>Estudiante:</strong> {{ $asistencia->matricula->estudiante->nombres }} {{ $asistencia->matricula->estudiante->apellidos }}</p>
<p><strong>Grado/Sección:</strong> {{ $asistencia->matricula->anioEscolar->nombre }} - {{ $asistencia->matricula->seccion->nombre }}</p>
<p><strong>Área:</strong> {{ $asistencia->areaFormacion->nombre }}</p>
<p><strong>Estado:</strong> <span style="color: {{ $asistencia->estado == 'presente' ? 'green' : 'red' }}">{{ ucfirst($asistencia->estado) }}</span></p>
<a href="{{ route('asistencias.index') }}">← Volver</a>
</body></html>
