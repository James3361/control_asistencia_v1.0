<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Matriculación')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        * { font-family: system-ui, sans-serif; }
        .sidebar-gradient { background: radial-gradient(circle at top left, #1d4ed8, #020617); }
        .card-soft { background: linear-gradient(145deg, #1f2937, #020617); }
    </style>
</head>
<body class="bg-slate-900 text-slate-100">
    {{-- TOPBAR --}}
    <header class="fixed top-0 left-0 right-0 z-40 bg-slate-900/80 backdrop-blur border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex items-center justify-between h-14 px-4">
            <div class="flex items-center space-x-3">
                <button id="sidebarToggle" class="lg:hidden text-slate-300 hover:text-white mr-2">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <span class="text-sm uppercase tracking-[.2em] text-sky-400 font-semibold">
                    SISTEMA DE MATRICULACIÓN
                </span>
            </div>
            @auth
            <div class="flex items-center space-x-3">
                <span class="text-sm text-slate-300 hidden sm:block">{{ auth()->user()->name ?? 'James Admin' }}</span>
                <div class="w-8 h-8 rounded-full bg-sky-500 flex items-center justify-center text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'J', 0, 1)) }}
                </div>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="text-xs bg-red-500 hover:bg-red-600 px-3 py-1 rounded-full font-semibold">
                        Salir
                    </button>
                </form>
            </div>
            @else
            <a href="/login" class="text-sky-400 hover:text-sky-300 font-semibold">Iniciar Sesión</a>
            @endauth
        </div>
    </header>

    {{-- SIDEBAR --}}
    <aside class="sidebar-gradient fixed top-14 left-0 bottom-0 w-60 lg:w-64 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-200" id="sidebar">
        <div class="h-full flex flex-col">
            <div class="px-5 py-4 border-b border-slate-800">
                <h1 class="text-lg font-bold text-slate-50">Sistema de Matriculación</h1>
            </div>
            <nav class="flex-1 overflow-y-auto px-3 py-4 text-sm space-y-1">
    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-sky-500/20 text-sky-300' : 'text-slate-200 hover:bg-slate-800/60' }}">
        <i class="fa-solid fa-gauge-high w-5 mr-2"></i> Dashboard
    </a>

    {{-- Años Escolares --}}
    <a href="{{ route('anios.index') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('anios.*') ? 'bg-sky-500/20 text-sky-300' : 'text-slate-200 hover:bg-slate-800/60' }}">
        <i class="fa-solid fa-calendar-days w-5 mr-2"></i> Años Escolares ({{ \App\Models\AnioEscolar::count() ?? 0 }})
    </a>

    {{-- Estudiantes --}}
    <a href="{{ route('estudiantes.index') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('estudiantes.*') ? 'bg-sky-500/20 text-sky-300' : 'text-slate-200 hover:bg-slate-800/60' }}">
        <i class="fa-solid fa-users w-5 mr-2"></i> Estudiantes ({{ \App\Models\Estudiante::count() ?? 0 }})
    </a>

    {{-- Matrículas --}}
    <a href="{{ route('matriculas.index') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('matriculas.*') ? 'bg-sky-500/20 text-sky-300' : 'text-slate-200 hover:bg-slate-800/60' }}">
        <i class="fa-solid fa-user-graduate w-5 mr-2"></i> Matrículas ({{ \App\Models\Matricula::count() ?? 0 }})
    </a>

    {{-- ASISTENCIAS ✅ NUEVO --}}
    <a href="{{ route('asistencias.index') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('asistencias.*') ? 'bg-sky-500/20 text-sky-300' : 'text-slate-200 hover:bg-slate-800/60' }}">
        <i class="fa-solid fa-calendar-check w-5 mr-2"></i> Asistencias
    </a>

    {{-- Reportes --}}
    <a href="{{ route('reportes.index') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('reportes.*') ? 'bg-sky-500/20 text-sky-300' : 'text-slate-200 hover:bg-slate-800/60' }}">
        <i class="fa-solid fa-chart-mixed w-5 mr-2 text-orange-400"></i> Reportes
    </a>
</nav>

        </div>
    </aside>

    <main class="pt-16 lg:pl-64 pl-0">
        <div class="max-w-7xl mx-auto px-4 py-6">
            @yield('content')
        </div>
    </main>

    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
