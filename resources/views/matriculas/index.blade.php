@extends('layouts.admin')

@section('title', 'Matrículas')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-100 flex items-center">
                <i class="fa-solid fa-user-graduate text-4xl text-purple-400 mr-3"></i>
                Matrículas
            </h1>
            <p class="text-slate-400 mt-1">Control de matrículas por año escolar</p>
        </div>
        <a href="{{ route('matriculas.create') }}" class="bg-gradient-to-r from-purple-500 to-emerald-500 hover:from-purple-600 hover:to-emerald-600 text-white px-6 py-2 rounded-xl font-semibold flex items-center shadow-lg">
            <i class="fa-solid fa-plus mr-2"></i>Nueva Matrícula
        </a>
    </div>

    {{-- STATS --}}
    @php $totalMatriculas = $matriculas->count() ?? 0; @endphp
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-purple-500/10 to-slate-800/50 border border-purple-500/30 rounded-2xl p-6">
            <p class="text-sm text-purple-200 mb-2">Total Matrículas</p>
            <p class="text-3xl font-bold text-white">{{ $totalMatriculas }}</p>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            <p class="text-sm text-slate-400 mb-2">Aprobados</p>
            <p class="text-2xl font-bold text-emerald-400">{{ $matriculas->where('estado', 'aprobado')->count() }}</p>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            <p class="text-sm text-slate-400 mb-2">Reprobados</p>
            <p class="text-2xl font-bold text-red-400">{{ $matriculas->where('estado', 'reprobado')->count() }}</p>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="bg-slate-800/30 border border-slate-700 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200">Estudiante</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200">Año Escolar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200">Estado</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-200">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($matriculas as $matricula)
                    <tr class="hover:bg-slate-700/30 transition-all">
                        <td class="px-6 py-4 font-semibold text-slate-100">
                            {{ $matricula->estudiante->nombre ?? 'N/A' }} {{ $matricula->estudiante->apellido ?? '' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-300">{{ $matricula->anio->nombre ?? 'Sin año' }}</td>
                        <td class="px-6 py-4">
                            @if($matricula->estado == 'aprobado')
                                <span class="px-4 py-1 bg-emerald-500/20 text-emerald-400 text-sm font-semibold rounded-full border border-emerald-500/30">✓ Aprobado</span>
                            @else
                                <span class="px-4 py-1 bg-red-500/20 text-red-400 text-sm font-semibold rounded-full border border-red-500/30">✗ Reprobado</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('matriculas.edit', $matricula) }}" class="text-purple-400 hover:text-purple-300 p-2 hover:bg-purple-500/10 rounded-lg">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('matriculas.destroy', $matricula) }}" class="inline">
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
                            <i class="fa-solid fa-user-graduate text-5xl mb-4 opacity-50"></i>
                            No hay matrículas registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
