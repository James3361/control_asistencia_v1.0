@extends('layouts.admin')

@section('title', 'Estudiantes')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-100 flex items-center">
                <i class="fa-solid fa-users text-4xl text-emerald-400 mr-3"></i>
                Estudiantes
            </h1>
            <p class="text-slate-400 mt-1">Gestión de estudiantes activos</p>
        </div>
        <a href="{{ route('estudiantes.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-xl font-semibold flex items-center shadow-lg">
            <i class="fa-solid fa-plus mr-2"></i>Nuevo Estudiante
        </a>
    </div>

    {{-- ✅ STATS SIMPLIFICADOS - SIN whereHas --}}
    @php 
        $total = $estudiantes->count() ?? 0;
        $matriculados = $estudiantes->filter(function($e) { 
            return $e->matriculas && $e->matriculas->count() > 0; 
        })->count();
        $sinMatricula = $total - $matriculados;
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-gradient-to-br from-emerald-500/10 to-slate-800/50 border border-emerald-500/30 rounded-2xl p-6">
            <p class="text-sm text-emerald-200 mb-2">Total Estudiantes</p>
            <p class="text-3xl font-bold text-white">{{ $total }}</p>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            <p class="text-sm text-slate-400 mb-2">Matriculados</p>
            <p class="text-2xl font-bold text-sky-400">{{ $matriculados }}</p>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            <p class="text-sm text-slate-400 mb-2">Sin Matrícula</p>
            <p class="text-2xl font-bold text-orange-400">{{ $sinMatricula }}</p>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            <p class="text-sm text-slate-400 mb-2">Promedio Edad</p>
            <p class="text-2xl font-bold text-purple-400">15 años</p>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="bg-slate-800/30 border border-slate-700 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
               <thead class="bg-slate-700/50">
    <tr>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200">Estudiante</th>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200">C.I.</th>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200">Teléfono</th>
        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-200">Acciones</th>
    </tr>
</thead>
<tbody class="divide-y divide-slate-700">
    @forelse($estudiantes as $estudiante)
    <tr class="hover:bg-slate-700/30 transition-all">
        <td class="px-6 py-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-sky-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr($estudiante->nombres ?? '', 0, 1)) }}
                </div>
                <div class="ml-3">
                    {{-- ✅ CAMPOS CORRECTOS --}}
                    <p class="font-semibold text-slate-100">{{ $estudiante->nombres ?? '' }} {{ $estudiante->apellidos ?? '' }}</p>
                    <p class="text-sm text-slate-400">{{ $estudiante->correo ?? 'Sin correo' }}</p>
                </div>
            </div>
        </td>
        {{-- ✅ C.I. CORRECTO --}}
        <td class="px-6 py-4 text-sm text-slate-300 font-mono">{{ $estudiante->documento ?? 'N/A' }}</td>
        <td class="px-6 py-4 text-sm text-slate-300">{{ $estudiante->telefono ?? 'N/A' }}</td>
        <td class="px-6 py-4 text-right space-x-2">
            <a href="{{ route('estudiantes.show', $estudiante) }}" class="text-sky-400 hover:text-sky-300 p-2 hover:bg-sky-500/10 rounded-lg">
                <i class="fa-solid fa-eye"></i>
            </a>
            <a href="{{ route('estudiantes.edit', $estudiante) }}" class="text-emerald-400 hover:text-emerald-300 p-2 hover:bg-emerald-500/10 rounded-lg">
                <i class="fa-solid fa-edit"></i>
            </a>
            <form method="POST" action="{{ route('estudiantes.destroy', $estudiante) }}" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-400 hover:text-red-300 p-2 hover:bg-red-500/10 rounded-lg" onclick="return confirm('¿Eliminar?')">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="px-6 py-12 text-center text-slate-400">
            <i class="fa-solid fa-users text-5xl mb-4 opacity-50"></i>No hay estudiantes
        </td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</div>
@endsection
