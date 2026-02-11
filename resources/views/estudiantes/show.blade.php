@extends('layouts.admin')

@section('title', 'Detalle Estudiante')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-100 flex items-center">
                <i class="fa-solid fa-user text-4xl text-emerald-400 mr-3"></i>
                {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
            </h1>
            <p class="text-slate-400 mt-1">C.I. {{ $estudiante->documento }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('estudiantes.edit', $estudiante) }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-xl font-semibold flex items-center">
                <i class="fa-solid fa-edit mr-2"></i>Editar
            </a>
            <a href="{{ route('estudiantes.index') }}" class="bg-slate-600 hover:bg-slate-500 text-white px-6 py-2 rounded-xl font-semibold">
                <i class="fa-solid fa-arrow-left mr-2"></i>Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- DATOS PERSONALES --}}
        <div class="lg:col-span-2">
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-slate-700 rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-slate-100 mb-6 flex items-center">
                    <i class="fa-solid fa-id-card text-emerald-400 mr-3"></i>Datos Personales
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Nombres</label>
                        <p class="text-xl font-bold text-slate-100">{{ $estudiante->nombres }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Apellidos</label>
                        <p class="text-xl font-bold text-slate-100">{{ $estudiante->apellidos }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">C.I.</label>
                        <p class="text-xl font-bold text-slate-100 font-mono">{{ $estudiante->documento }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Teléfono</label>
                        <p class="text-xl text-slate-100">{{ $estudiante->telefono ?? 'N/A' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Correo</label>
                        <p class="text-lg text-slate-200">{{ $estudiante->correo ?? 'N/A' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Fecha Nacimiento</label>
                        <p class="text-lg text-slate-200">{{ $estudiante->fecha_nacimiento ? \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- MATRÍCULAS ACTUALES --}}
        <div>
            <div class="bg-gradient-to-br from-purple-500/10 to-slate-800/50 border border-purple-500/30 rounded-2xl p-6 h-fit sticky top-24">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fa-solid fa-user-graduate text-purple-300 mr-3"></i>
                    Matrículas Activas
                </h2>
                
                @if($estudiante->matriculas->count() > 0)
                    <div class="space-y-3">
                        @foreach($estudiante->matriculas->take(3) as $matricula)
                        <div class="bg-white/10 backdrop-blur border border-white/20 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-purple-200">{{ $matricula->anio->nombre ?? 'Sin año' }}</span>
                                @if($matricula->estado == 'aprobado')
                                    <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 text-xs rounded-full">Aprobado</span>
                                @endif
                            </div>
                            <div class="text-sm space-y-1 text-slate-200">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-layer-group text-sky-400 mr-2 text-xs"></i>
                                    <span>Grado: {{ $matricula->grado ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-users text-emerald-400 mr-2 text-xs"></i>
                                    <span>Sección: {{ $matricula->seccion ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($estudiante->matriculas->count() > 3)
                        <div class="text-center mt-4 pt-4 border-t border-white/20">
                            <a href="#" class="text-purple-300 hover:text-purple-200 text-sm font-semibold">+{{ $estudiante->matriculas->count() - 3 }} más</a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-12 text-slate-400">
                        <i class="fa-solid fa-user-graduate text-4xl mb-4 opacity-50"></i>
                        <p>Sin matrículas registradas</p>
                        <a href="{{ route('matriculas.create') }}" class="mt-4 inline-block bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                            Matricular Ahora
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
