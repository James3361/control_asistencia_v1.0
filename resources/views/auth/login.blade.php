<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Matriculación</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg { background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); }
        .glass { backdrop-filter: blur(20px); background: rgba(255,255,255,0.1); }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="glass rounded-3xl p-8 shadow-2xl border border-white/20">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-white/20 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-2xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Control Asistencia</h1>
                <p class="text-white/70">Inicia sesión en tu cuenta</p>
            </div>

            @if($errors->any())
                <div class="bg-red-500/20 border border-red-500/50 text-red-200 p-4 rounded-2xl mb-6 backdrop-blur-sm">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-white/90 mb-2">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition-all" 
                               placeholder="tu@correo.com" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white/90 mb-2">Contraseña</label>
                        <input type="password" name="password" 
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition-all" 
                               placeholder="••••••••" required>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-sky-400 rounded border-white/30 focus:ring-sky-400">
                        <label for="remember" class="ml-2 block text-sm text-white/90">Recordarme</label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-sky-500 to-sky-600 hover:from-sky-600 hover:to-sky-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-white/20 text-center">
                <a href="#" class="text-sky-300 hover:text-sky-200 text-sm font-medium">¿Olvidaste tu contraseña?</a>
            </div>
        </div>

        <div class="text-center mt-6 text-white/50 text-xs">
            ¿No tienes cuenta? <a href="#" class="text-sky-300 font-medium hover:text-sky-200">Regístrate</a>
        </div>
    </div>
</body>
</html>
