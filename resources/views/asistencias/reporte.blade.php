@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    {{-- HEADER MEJORADO --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center bg-gradient-primary text-white p-5 rounded-4 shadow-xl animate__animated animate__fadeInDown">
                <div>
                    <h1 class="h1 mb-2 fw-bold">
                        <i class="fas fa-chart-line me-3"></i>Reporte de Asistencia
                    </h1>
                    <div class="row g-2 mb-0">
                        <div class="col-auto">
                            <span class="badge bg-light text-dark px-3 py-2 fs-6">
                                {{ count($estudiantes ?? []) }} estudiantes
                            </span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-success px-3 py-2 fs-6">
                                {{ number_format($estudiantes->avg('porcentaje') ?? 0, 1) }}% promedio
                            </span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-info px-3 py-2 fs-6">
                                {{ $stats['total_matriculas'] ?? 0 }} matrículas
                            </span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('asistencias.index') }}" class="btn btn-light btn-lg shadow-lg px-4">
                    <i class="fas fa-arrow-left me-2"></i>Volver al Panel
                </a>
            </div>
        </div>
    </div>

    {{-- STATS CARDS MEJORADAS --}}
    @if(isset($stats))
    <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-lg h-100 card-hover-effect">
                <div class="card-body text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-users fa-3x text-primary"></i>
                    </div>
                    <h2 class="h3 fw-bold text-primary mb-1 counter" data-target="{{ $stats['total_estudiantes'] }}">0</h2>
                    <p class="text-muted mb-2">Estudiantes Total</p>
                    <div class="progress progress-sm mb-0">
                        <div class="progress-bar bg-primary" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-lg h-100 card-hover-effect">
                <div class="card-body text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-user-graduate fa-3x text-success"></i>
                    </div>
                    <h2 class="h3 fw-bold text-success mb-1 counter" data-target="{{ $stats['total_matriculas'] }}">0</h2>
                    <p class="text-muted mb-2">Matrículas Activas</p>
                    <div class="progress progress-sm mb-0">
                        <div class="progress-bar bg-success" style="width: 92%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-lg h-100 card-hover-effect">
                <div class="card-body text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-calendar fa-3x text-info"></i>
                    </div>
                    <h2 class="h3 fw-bold text-info mb-1 counter" data-target="{{ $stats['total_anios'] }}">0</h2>
                    <p class="text-muted mb-2">Años Escolares</p>
                    <div class="progress progress-sm mb-0">
                        <div class="progress-bar bg-info" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-xl h-100 card-hover-effect">
                <div class="card-body text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-chart-pie fa-3x text-warning"></i>
                    </div>
                    <h2 class="h3 fw-bold text-warning mb-1">
                        {{ number_format($estudiantes->avg('porcentaje') ?? 0, 1) }}<span class="h6 fw-normal">%</span>
                    </h2>
                    <p class="text-muted mb-2">Asistencia Promedio</p>
                    <div class="progress mb-0" style="height: 10px;">
                        <div class="progress-bar bg-warning" style="width: {{ ($estudiantes->avg('porcentaje') ?? 0) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- TABLA PRINCIPAL MEJORADA --}}
    @if(isset($estudiantes) && count($estudiantes) > 0)
    <div class="row animate__animated animate__fadeInUp">
        <div class="col-12">
            <div class="card border-0 shadow-xl">
                <div class="card-header bg-gradient-secondary text-white py-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h4 class="mb-2 fw-bold">
                                <i class="fas fa-table me-2"></i>Detalle Completo por Estudiante
                            </h4>
                            <small class="opacity-90">{{ count($estudiantes) }} estudiantes • Ordenado por rendimiento</small>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-light text-dark px-3 py-2">
                                <i class="fas fa-filter me-1"></i>Activos
                            </span>
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-chart-line me-1"></i>{{ $estudiantes->where('porcentaje', '>=', 70)->count() }} aprobados
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 table-modern">
                            <thead class="table-dark-gradient">
                                <tr>
                                    <th width="35%">Estudiante</th>
                                    <th width="10%">Total</th>
                                    <th width="12%"><i class="fas fa-check text-success"></i> Presentes</th>
                                    <th width="12%"><i class="fas fa-times text-danger"></i> Ausentes</th>
                                    <th width="12%">Porcentaje</th>
                                    <th width="19%">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estudiantes->sortByDesc('porcentaje') as $index => $estudiante)
                                <tr class="table-row-hover {{ $index < 3 ? 'table-top-3' : '' }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-md {{ $estudiante->porcentaje >= 70 ? 'bg-gradient-success' : 'bg-gradient-warning' }} me-3">
                                                {{ substr($estudiante->nombres, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark fs-6">{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</div>
                                                <small class="text-muted">#{{ $index + 1 }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark px-3 py-2 fs-6">{{ $estudiante->total_clases }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success px-4 py-2 fs-6">
                                            <i class="fas fa-check me-1"></i>{{ $estudiante->presentes }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger px-4 py-2 fs-6">
                                            <i class="fas fa-times me-1"></i>{{ $estudiante->ausentes ?? ($estudiante->total_clases - $estudiante->presentes) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress progress-sm mb-0 mx-auto" style="width: 120px;">
                                            <div class="progress-bar {{ $estudiante->porcentaje >= 70 ? 'bg-success' : 'bg-warning' }}" 
                                                 style="width: {{ $estudiante->porcentaje }}%;">
                                                <small class="justify-content-center d-flex w-100">{{ $estudiante->porcentaje }}%</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($estudiante->porcentaje >= 80)
                                            <span class="badge bg-success px-4 py-2 fs-6 shadow-sm">
                                                <i class="fas fa-crown text-warning me-1"></i>Excelente
                                            </span>
                                        @elseif($estudiante->porcentaje >= 70)
                                            <span class="badge bg-success px-4 py-2 fs-6">
                                                <i class="fas fa-check-circle me-1"></i>Aprobado
                                            </span>
                                        @elseif($estudiante->porcentaje >= 60)
                                            <span class="badge bg-warning px-4 py-2 fs-6 text-dark">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Mejorar
                                            </span>
                                        @else
                                            <span class="badge bg-danger px-4 py-2 fs-6">
                                                <i class="fas fa-exclamation-circle me-1"></i>Crítico
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center py-5">
                <i class="fas fa-chart-line fa-4x text-muted mb-4 opacity-75"></i>
                <h3 class="text-muted mb-3">Sin datos para mostrar</h3>
                <p class="text-muted mb-4">Registra las primeras asistencias para generar reportes detallados</p>
                <a href="{{ route('asistencias.create') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-plus me-2"></i>Nueva Asistencia
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
/* ANIMACIONES SUAVES */
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate__animated {
    animation-duration: 0.8s;
    animation-fill-mode: both;
}
.animate__fadeInDown { animation-name: fadeInDown; }
.animate__fadeInUp { animation-name: fadeInUp; }

/* EFECTOS HOVER */
.card-hover-effect {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}
.card-hover-effect:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
}

.stat-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1));
    border: 3px solid rgba(102,126,234,0.2);
}

/* GRADIENTES MEJORADOS */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%) !important;
}
.bg-gradient-secondary {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
}

.table-dark-gradient {
    background: linear-gradient(135deg, #2c3e50, #34495e) !important;
}

.table-modern thead th {
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
}

.table-row-hover:hover {
    background: linear-gradient(90deg, rgba(102,126,234,0.08), rgba(118,75,162,0.08)) !important;
    transform: scale(1.01);
}

.table-top-3:nth-child(1) { border-left: 5px solid #28a745; }
.table-top-3:nth-child(2) { border-left: 5px solid #ffc107; }
.table-top-3:nth-child(3) { border-left: 5px solid #17a2b8; }

.avatar-md {
    width: 45px;
    height: 45px;
    border-radius: 50% 50% 50% 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    color: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #56ab2f, #a8e6cf);
}
.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb, #f5576c);
}

.progress-sm {
    height: 6px;
}
.progress {
    border-radius: 10px;
    overflow: visible;
}

.shadow-xl {
    box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
}

.counter {
    font-size: 2.5rem !important;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .stat-icon { width: 60px; height: 60px; }
    .avatar-md { width: 35px; height: 35px; font-size: 14px; }
}
</style>

<script>
// CONTADORES ANIMADOS
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        updateCounter();
    });
});
</script>
@endsection
