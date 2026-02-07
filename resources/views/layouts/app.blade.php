<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Control de Asistencias Escolares')</title>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); 
            min-height: 100vh;
            color: #333;
        }
        
        /* HEADER NAVEGACIÓN */
        .header {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(25px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(45deg, #3498db, #667eea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .nav-link {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 25px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .nav-link:hover {
            background: rgba(52,152,219,0.1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52,152,219,0.2);
        }
        
        .nav-active {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white !important;
            box-shadow: 0 8px 25px rgba(52,152,219,0.3);
        }
        
        /* CONTENIDO PRINCIPAL */
        .content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 50px 30px;
            min-height: calc(100vh - 160px);
        }
        
        /* ALERTAS */
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            padding: 25px 30px;
            border-radius: 20px;
            margin-bottom: 40px;
            border-left: 6px solid #28a745;
            box-shadow: 0 10px 30px rgba(40,167,69,0.2);
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .nav-container { flex-direction: column; gap: 20px; padding: 20px; height: auto; }
            .content { padding: 30px 20px; }
        }
    </style>

    
    
    @yield('styles')
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <div class="nav-container">
            <a href="{{ route('dashboard') }}" class="logo">📚 Control Escolar</a>
            <div class="nav-links">
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">📊 Dashboard</a>
    <a href="{{ route('asistencias.index') }}" class="nav-link {{ request()->routeIs('asistencias.*') ? 'nav-active' : '' }}">📋 Asistencias</a>
    <a href="{{ route('estudiantes.index') }}" class="nav-link {{ request()->routeIs('estudiantes.*') ? 'nav-active' : '' }}">👥 Estudiantes</a>
    <a href="{{ route('matriculas.index') }}" class="nav-link {{ request()->routeIs('matriculas.*') ? 'nav-active' : '' }}">🎓 Matrículas</a>
    <a href="{{ route('reporte.estudiantes') }}" class="nav-link {{ request()->routeIs('reporte.estudiantes') ? 'nav-active' : '' }}">📈 Reportes</a>
    <a href="{{ route('reporte.area') }}" class="nav-link {{ request()->routeIs('reporte.area') ? 'nav-active' : '' }}">📚 Por Área</a>
    <a href="{{ route('anios.index') }}" class="nav-link {{ request()->routeIs('anios.*') ? 'nav-active' : '' }}">📅 Años</a>
</div>

        </div>

    </header>

    <!-- CONTENIDO -->
    <main class="content">
        @if(session('success'))
            <div class="alert-success">
                <strong>✅ Éxito!</strong> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert-error" style="background: linear-gradient(135deg, #f8d7da, #f5c6cb); color: #721c24; border-left-color: #dc3545;">
                <strong>❌ Error:</strong> {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
