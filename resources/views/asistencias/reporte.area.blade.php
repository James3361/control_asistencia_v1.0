@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>📊 Reporte por Área de Formación</h3>
                </div>
                <div class="card-body">
                    @foreach($areas as $area)
                        @if(isset($reportes[$area]) && $reportes[$area]['total'] > 0)
                            <div class="mb-4 p-4 border rounded">
                                <h4>{{ $area }} <span class="badge bg-primary">{{ $reportes[$area]['total'] }} estudiantes</span></h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h5>{{ $reportes[$area]['promedio'] }}%</h5>
                                                <small>Promedio</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center bg-success text-white">
                                            <div class="card-body">
                                                <h5>{{ $reportes[$area]['aprobados'] }}</h5>
                                                <small>Aprobados (≥70%)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card text-center bg-danger text-white">
                                            <div class="card-body">
                                                <h5>{{ $reportes[$area]['reprobados'] }}</h5>
                                                <small>Reprobados</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
