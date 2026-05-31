<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; }
        
        .auth-gradient {
            background: radial-gradient(circle at top right, #f0f7ff 0%, #ffffff 100%);
        }
    </style>
</head>
<body class="auth-gradient min-h-screen flex items-center justify-center p-6">

    <main class="w-full max-w-[480px] animate-in fade-in slide-in-from-bottom-4 duration-700">
        
        <section class="bg-white rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-gray-100 p-8 md:p-12">
            
            <header class="text-center mb-10 space-y-3">
                <a href="{{ route('index') }}" class="inline-flex items-center gap-2 group cursor-pointer mb-2">
                    <div class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center transition-all group-hover:bg-[#2b6df2] group-hover:rotate-12">
                        <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">InternConnect</span>
                </a>
                <div>
                    <h1 class="text-3xl font-extrabold text-[#0d1b2a] tracking-tight">Iniciar Sesión</h1>
                    <p class="text-gray-500 text-sm font-medium leading-relaxed mt-1">Ingresa tus credenciales para acceder a tu cuenta</p>
                </div>
            </header>

            <form class="space-y-6" id="login-form" method="POST" action="{{ route('login.post') }}">
                @csrf

                @if ($errors->any())
                    <div class="rounded-2xl border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm font-semibold">
                        {{ $errors->first('correo') ?? $errors->first('contrasena') ?? $errors->first() }}
                    </div>
                @endif

                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Correo Electrónico</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#2b6df2] transition-colors">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" id="email" name="correo" value="{{ old('correo') }}"
                               class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:bg-white focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 transition-all font-medium text-sm" 
                               placeholder="nombre@ejemplo.com" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Contraseña</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#2b6df2] transition-colors">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input type="password" id="password" name="contrasena" 
                               class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:bg-white focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 transition-all font-medium text-sm" 
                               placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="remember" class="peer hidden">
                            <div class="w-5 h-5 border-2 border-gray-200 rounded-md peer-checked:bg-[#2b6df2] peer-checked:border-[#2b6df2] transition-all"></div>
                            <i data-lucide="check" class="absolute top-0.5 left-0.5 w-4 h-4 text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-500">Recordar sesión</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-[#2b6df2] hover:opacity-70">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="w-full bg-[#0d121f] text-white py-5 rounded-[20px] font-black hover:bg-[#2b6df2] transition-all active:scale-95 flex items-center justify-center gap-2 group shadow-xl shadow-blue-900/5 text-sm">
                    <span>Ingresar a la Plataforma</span>
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <footer class="mt-10 text-center space-y-6">
                <p class="text-sm font-semibold text-gray-500" id="footer-link">
                    ¿Eres nuevo? 
                    <a href="{{ route('registro') }}" class="text-[#0d121f] font-black border-b-2 border-blue-100 hover:border-[#2b6df2] transition-all ml-1">Crea una cuenta</a>
                </p>
                <div class="pt-6 border-t border-gray-50">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter">
                        Plataforma segura de InternConnect © 2026
                    </p>
                </div>
            </footer>
        </section>

        <div class="mt-8 text-center">
            <a href="{{ route('index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-[#0d121f] transition-colors uppercase tracking-wider">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Volver al inicio
            </a>
        </div>
    </main>

    <script>
        // Inicialización de iconos globales
        lucide.createIcons();
    </script>
</body>
</html>