<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Importar Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        @keyframes subtle-zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.05); }
        }
        .animate-subtle-zoom { animation: subtle-zoom 10s infinite alternate ease-in-out; }

        @keyframes count-up {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stat-reveal { animation: count-up 1s ease-out forwards; }

        /* Estilos para la animación del logo */
        .logo-container:hover .logo-icon {
            transform: rotate(12deg) scale(1.1);
            background-color: #2b6df2;
        }
        .logo-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-white text-[#1a1a1a] overflow-x-hidden">

    <!-- NAVBAR (Actualizado con el nuevo logo animado) -->
    <header class="flex justify-between items-center py-4 px-[8%] bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <!-- NUEVO LOGO ANIMADO -->
        <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
            <div class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center logo-icon shadow-sm">
                <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">InternConnect</span>
        </a>
        
        <nav class="flex items-center gap-6">
            <a href="index" class="text-[#666] font-medium hover:text-[#2b6df2] transition">Home</a>
            <a href="login" class="px-5 py-2.5 border border-[#ddd] rounded-xl text-[#1a1a1a] font-medium hover:bg-gray-50 transition">Login</a>
            <a href="registro" class="px-6 py-2.5 bg-[#0d121f] text-white rounded-xl font-semibold hover:bg-slate-800 transition shadow-md active:scale-95">Registro</a>
        </nav>
    </header>

    <!-- ABOUT HERO -->
    <section class="relative py-24 px-[8%] overflow-hidden bg-[#0d121f] text-white">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-blue-600 via-transparent to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-8tracking-tight">
                Nuestra misión es <span class="text-[#2b6df2]">impulsar carreras</span>
            </h1>
            <p class="text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto">
                En InternConnect, creemos que el talento no tiene fronteras. Nacimos para eliminar las barreras entre los estudiantes ambiciosos y las empresas que están cambiando Bolivia.
            </p>
        </div>
    </section>

    <!-- FEATURES / VALUES -->
    <section class="py-20 px-[8%] bg-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-10 rounded-3xl border border-gray-100 bg-[#fcfcfc] hover:shadow-xl transition-all duration-300 group">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#2b6df2] transition-colors">
                    <div class="w-3 h-3 border-2 border-[#2b6df2] rounded-full group-hover:border-white animate-ping"></div>
                </div>
                <h3 class="text-xl font-bold mb-4 tracking-tight">Nuestra Visión</h3>
                <p class="text-[#666] leading-relaxed">Ser una plataforma Boliviana que defina el estándar de las pasantías profesionales, priorizando el aprendizaje real.</p>
            </div>
            
            <div class="p-10 rounded-3xl border border-gray-100 bg-[#fcfcfc] hover:shadow-xl transition-all duration-300 group">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#2b6df2] transition-colors">
                    <div class="w-6 h-4 flex gap-1">
                        <div class="w-2 h-full bg-[#2b6df2] group-hover:bg-white rounded-full"></div>
                        <div class="w-2 h-full bg-[#2b6df2] group-hover:bg-white rounded-full opacity-50"></div>
                        <div class="w-2 h-full bg-[#2b6df2] group-hover:bg-white rounded-full opacity-25"></div>
                    </div>
                </div>
                <h3 class="text-xl font-bold mb-4 tracking-tight">Compromiso</h3>
                <p class="text-[#666] leading-relaxed">Nos comprometemos a mantener un ecosistema seguro, verificado y justo para ambas partes.</p>
            </div>

            <div class="p-10 rounded-3xl border border-gray-100 bg-[#fcfcfc] hover:shadow-xl transition-all duration-300 group">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#2b6df2] transition-colors">
                    <div class="w-6 h-6 border-2 border-[#2b6df2] group-hover:border-white rounded-tr-xl"></div>
                </div>
                <h3 class="text-xl font-bold mb-4 tracking-tight">Innovación</h3>
                <p class="text-[#666] leading-relaxed">Utilizamos tecnología de vanguardia para que el "match" entre empresa y estudiante sea perfecto.</p>
            </div>
        </div>
    </section>

    <!-- SECTION WHY WE EXIST -->
    <section class="py-24 px-[8%] flex flex-col lg:flex-row items-center gap-16 bg-[#f8faff]">
        <div class="flex-1 space-y-8">
            <div class="inline-block px-4 py-1 bg-blue-100 text-[#2b6df2] rounded-full text-sm font-bold tracking-widest uppercase">
                Propósito
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-[#0d1b2a] tracking-tight leading-tight">Por qué existimos</h2>
            <p class="text-lg text-[#666] leading-relaxed max-w-xl">
                Muchos estudiantes talentosos se pierden por falta de contactos, y muchas empresas pierden talento por procesos lentos. Nosotros somos el puente que une esos dos mundos con tecnología y habilidades.
            </p>
            
            <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                <div class="stat-reveal">
                    <strong class="block text-4xl font-extrabold text-[#2b6df2]">+200</strong>
                    <span class="text-sm text-[#888] font-medium uppercase tracking-wider">Estudiantes</span>
                </div>
                <div class="stat-reveal" style="animation-delay: 0.2s;">
                    <strong class="block text-4xl font-extrabold text-[#2b6df2]">+10</strong>
                    <span class="text-sm text-[#888] font-medium uppercase tracking-wider">Empresas</span>
                </div>

            </div>
        </div>
        
        <div class="flex-1 relative group overflow-hidden rounded-[2.5rem] shadow-2xl border-4 border-white">
            <div class="absolute inset-0 bg-[#2b6df2] mix-blend-multiply opacity-20 z-10 transition-opacity group-hover:opacity-0"></div>
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" 
                 alt="Nuestro Equipo trabajando" 
                 class="w-full h-full object-cover animate-subtle-zoom">
            <div class="absolute bottom-8 right-8 z-20 hover:scale-110 transition-transform">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-2xl border border-gray-100">
                    <div class="w-8 h-8 border-4 border-[#2b6df2] rounded-full border-t-transparent animate-spin"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER (Actualizado con el nuevo logo animado) -->
    <footer class="bg-[#0d121f] text-white pt-20 pb-10 px-[8%]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 border-b border-[#222] pb-16">
            <div class="footer-brand space-y-4">
                <!-- NUEVO LOGO EN EL FOOTER -->
                <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center logo-icon border border-white/10">
                        <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tighter text-white">InternConnect</span>
                </a>
                <p class="text-[#888] leading-relaxed text-sm max-w-[280px]">Conectando estudiantes y empresas para experiencias de pasantía significativas.</p>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Para Estudiantes</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#888]">
                    <a href="explora" class="hover:text-white transition">Explorar Pasantías</a>
                    <a href="comufunciona" class="hover:text-white transition">Cómo Funciona</a>
                </nav>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Para Empresas</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#888]">
                    <a href="login" class="hover:text-white transition">Publicar Oportunidades</a>
                    <a href="login" class="hover:text-white transition">Encontrar Talento</a>
                </nav>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Compañía</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#888]">
                    <a href="sobrenosotros" class="hover:text-white transition font-medium text-white">Sobre Nosotros</a>
                    <a href="contacto" class="hover:text-white transition">Contacto</a>
                    <a href="privacidad" class="hover:text-white transition">Política de Privacidad</a>
                </nav>
            </div>
        </div>
        <div class="text-center pt-10 text-[#555] text-xs uppercase tracking-[0.2em]">
            © 2026 InternConnect. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Inicializar Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>