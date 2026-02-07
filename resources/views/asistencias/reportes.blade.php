<!DOCTYPE html>
<html><head><title>Reporte Asistencias</title>
<style>
body{font-family:Arial,sans-serif;margin:20px}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{padding:12px;text-align:left;border:1px solid #ddd}
th{background:#4CAF50;color:white;font-weight:bold}
.verde{background:#d4edda!important}
.amarillo{background:#fff3cd!important}
.rojo{background:#f8d7da!important}
.btn{background:#007bff;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;display:inline-block;margin:10px 0}
</style>
</head><body>
<h1>📊 Reporte de Asistencias</h1>
<a href="{{ route('asistencias.index') }}" class="btn">← Volver Asistencias</a>

@if(count($estudiantes)>0)
<table>
<thead><tr>
<th>Estudiante</th><th>Total</th><th>Presentes</th><th>% Asistencia</th><th>Ausentes</th>
</tr></thead>
<tbody>
@foreach($estudiantes as $e)
<tr class="{{ $e->porcentaje>=90?'verde':($e->porcentaje>=70?'amarillo':'rojo') }}">
<td><strong>{{ $e->nombres }} {{ $e->apellidos }}</strong></td>
<td>{{ $e->total_clases }}</td>
<td>{{ $e->presentes }}</td>
<td><strong>{{ $e->porcentaje }}%</strong></td>
<td>{{ $e->total_clases-$e->presentes }}</td>
</tr>
@endforeach
</tbody>
</table>
@else
<div style="padding:40px;text-align:center;color:#666">
<h3>📋 Sin asistencias registradas</h3>
<a href="{{ route('asistencias.create') }}" class="btn">➕ Nueva Asistencia</a>
</div>
@endif
</body></html>
