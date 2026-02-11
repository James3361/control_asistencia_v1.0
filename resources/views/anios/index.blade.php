@extends('layouts.admin')

@section('title', 'Años Escolares')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-100 flex items-center">
                <i class="fa-solid fa-calendar-days text-4xl text-sky-400 mr-3"></i>
                Años Escolares
            </h1>
            <p class="text-slate-400 mt-1">Gestión de periodos académicos</p>
        </div>
        <a href="{{ route('anios.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-xl font-semibold flex items-center shadow-lg">
            <i class="fa-solid fa-plus mr-2"></i>Nuevo Año
        </a>
    </div>

    {{-- STATS --}}
    @php $totalAnios = $anios->count() ?? 0; @endphp
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-r from-sky-500/10 to-slate-800/50 border border-sky-500/30 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-sky-200 mb-1">Total Años</p>
                    <p class="text-3xl font-bold text-white">{{ $totalAnios }}</p>
                </div>
                <i class="fa-solid fa-calendar text-3xl text-sky-300"></i>
            </div>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            <p class="text-sm text-slate-400 mb-2">Activos</p>
            <p class="text-2xl font-bold text-emerald-400">{{ $anios->where('estado', 'activo')->count() }}</p>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
            <p class="text-sm text-slate-400 mb-2">Inactivos</p>
            <p class="text-2xl font-bold text-red-400">{{ $anios->where('estado', 'inactivo')->count() }}</p>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="bg-slate-800/30 border border-slate-700 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200 uppercase">Año</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200 uppercase">Estado</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-200 uppercase">Fecha Inicio</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-200 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($anios as $anio)
                    <tr class="hover:bg-slate-700/30 transition-all">
                        <td class="px-6 py-4 font-semibold text-slate-100">{{ $anio->nombre }}</td>
                        <td class="px-6 py-4">
                            @if($anio->estado == 'activo')
                                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-full">Activo</span>
                            @else
                                <span class="px-3 py-1 bg-slate-500/20 text-slate-400 text-xs font-semibold rounded-full">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-300">{{ $anio->fecha_inicio }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('anios.edit', $anio) }}" class="text-emerald-400 hover:text-emerald-300 p-2 hover:bg-emerald-500/10 rounded-lg">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('anios.destroy', $anio) }}" class="inline">
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
                            <i class="fa-solid fa-calendar-xmark text-4xl mb-4 opacity-50"></i>
                            No hay años escolares registrados
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
