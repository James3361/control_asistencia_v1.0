@extends('layouts.admin')

@section('title', 'Editar Año Escolar')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-100 flex items-center">
                <i class="fa-solid fa-calendar-days text-4xl text-sky-400 mr-3"></i>
                Editar {{ $anio->nombre }}
            </h1>
        </div>
        <a href="{{ route('anios.index') }}" class="bg-slate-600 hover:bg-slate-500 text-white px-6 py-2 rounded-xl font-semibold">
            <i class="fa-solid fa-arrow-left mr-2"></i>Volver
        </a>
    </div>

    <form method="POST" action="{{ route('anios.update', $anio) }}" class="bg-slate-800/30 border border-slate-700 rounded-2xl p-8">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Nombre del Año *</label>
                <input type="text" name="nombre" value="{{ old('nombre', $anio->nombre) }}" 
                       class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all @error('nombre') border-red-500 @enderror"
                       placeholder="Ej: 2025-2026" required>
                @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Fecha Inicio *</label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $anio->fecha_inicio) }}" 
                       class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all @error('fecha_inicio') border-red-500 @enderror" required>
                @error('fecha_inicio') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Fecha Fin *</label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $anio->fecha_fin) }}" 
                       class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all @error('fecha_fin') border-red-500 @enderror" required>
                @error('fecha_fin') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Estado *</label>
                <select name="estado" class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all @error('estado') border-red-500 @enderror" required>
                    <option value="activo" {{ old('estado', $anio->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado', $anio->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex gap-4 mt-8">
            <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-3 rounded-xl font-semibold flex items-center shadow-lg transition-all">
                <i class="fa-solid fa-save mr-2"></i>Actualizar Año
            </button>
            <a href="{{ route('anios.index') }}" class="bg-slate-600 hover:bg-slate-500 text-white px-8 py-3 rounded-xl font-semibold flex items-center">
                <i class="fa-solid fa-times mr-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
