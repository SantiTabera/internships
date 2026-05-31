<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cómo Funciona | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Importar Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px border rgba(255, 255, 255, 0.2);
        }

        @keyframes drawLine {
            from { height: 0; }
            to { height: 100%; }
        }
        .animate-line { animation: drawLine 2s ease-out forwards; }

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

    <!-- PAGE HEADER -->
    <section class="py-24 px-[8%] text-center bg-[#fcfcfc]">
        <div class="max-w-3xl mx-auto space-y-6">
            <h1 class="text-4xl md:text-6xl font-bold text-[#0d1b2a] tracking-tightleading-tight">
                Transparencia en cada <span class="text-[#2b6df2]">paso</span>
            </h1>
            <p class="text-lg text-[#666] leading-relaxed max-w-2xl mx-auto">
                Descubre cómo InternConnect simplifica la conexión entre el talento emergente de Bolivia y las empresas líderes que impulsan el cambio.
            </p>
        </div>
    </section>

    <!-- RUTA PARA ESTUDIANTES (DARK/BLUE STYLE) -->
    <section class="bg-[#2b6df2] py-28 px-[8%] text-white relative rounded-[40px] my-10 mx-[4%] shadow-2xl shadow-blue-500/20">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-16 items-center">
            <div class="lg:w-1/3 space-y-6">
                <div class="w-14 h-14 bg-white/15 rounded-2xl flex items-center justify-center border border-white/20 shadow-xl">
                    <i data-lucide="user-plus" class="w-7 h-7 text-white"></i>
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold tracking-tight mb-6">Ruta para Estudiantes</h2>
                <p class="text-blue-50/90 text-lg leading-relaxed">Tu carrera profesional comienza aquí. Hemos diseñado un proceso fluido para que te concentres en lo que importa: aprender.</p>
            </div>

            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 01 -->
                <div class="glass-card p-9 rounded-3xl border border-white/20 hover:bg-white/20 transition-all group duration-300">
                    <span class="text-6xl font-black text-white/10 group-hover:text-white/30 transition-colors block mb-6 tracking-tighter">01</span>
                    <h3 class="text-2xl font-bold mb-4 tracking-tight">Crea tu Perfil</h3>
                    <p class="text-base text-white/80 leading-relaxed">Completa tu portafolio, habilidades y preferencias. Nuestro algoritmo te hará visible ante las mejores empresas de Bolivia.</p>
                </div>
                <!-- Step 02 -->
                <div class="glass-card p-9 rounded-3xl border border-white/20 hover:bg-white/20 transition-all group duration-300 md:translate-y-6">
                    <span class="text-6xl font-black text-white/10 group-hover:text-white/30 transition-colors block mb-6 tracking-tighter">02</span>
                    <h3 class="text-2xl font-bold mb-4 tracking-tight">Aplica con un Click</h3>
                    <p class="text-base text-white/80 leading-relaxed">No más formularios infinitos. Aplica a vacantes que coincidan con tu perfil y carrera de forma instantánea.</p>
                </div>
                <!-- Step 03 -->
                <div class="glass-card p-9 rounded-3xl border border-white/20 hover:bg-white/20 transition-all group duration-300 md:translate-y-12">
                    <span class="text-6xl font-black text-white/10 group-hover:text-white/30 transition-colors block mb-6 tracking-tighter">03</span>
                    <h3 class="text-2xl font-bold mb-4 tracking-tight">Entrevista y Contrata</h3>
                    <p class="text-base text-white/80 leading-relaxed">Gestiona tus entrevistas desde la plataforma y recibe ofertas de pasantía directamente en tu panel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- RUTA PARA EMPRESAS (WHITE STYLE) -->
    <section class="py-28 px-[8%] bg-white relative">
        <div class="max-w-7xl mx-auto flex flex-col-reverse lg:flex-row gap-16 items-center">
            
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 01 -->
                <div class="p-9 rounded-3xl border border-gray-100 bg-[#f8faff] hover:border-blue-200 hover:shadow-xl hover:bg-white transition-all group duration-300 shadow-inner">
                    <span class="text-6xl font-black text-blue-600/10 group-hover:text-blue-600/20 transition-colors block mb-6 tracking-tighter">01</span>
                    <h3 class="text-2xl font-bold mb-4 text-[#0d1b2a] tracking-tight">Publica tu Vacante</h3>
                    <p class="text-base text-[#666] leading-relaxed">Define los requisitos y el perfil que buscas. Nosotros nos encargamos de difundirlo a los mejores estudiantes.</p>
                </div>
                <!-- Step 02 -->
                <div class="p-9 rounded-3xl border border-gray-100 bg-[#f8faff] hover:border-blue-200 hover:shadow-xl hover:bg-white transition-all group duration-300 md:translate-y-6 shadow-inner">
                    <span class="text-6xl font-black text-blue-600/10 group-hover:text-blue-600/20 transition-colors block mb-6 tracking-tighter">02</span>
                    <h3 class="text-2xl font-bold mb-4 text-[#0d1b2a] tracking-tight">Filtra con IA</h3>
                    <p class="text-base text-[#666] leading-relaxed">Recibe una lista pre-seleccionada de los candidatos que mejor encajan con tu cultura organizacional.</p>
                </div>
                <!-- Step 03 -->
                <div class="p-9 rounded-3xl border border-gray-100 bg-[#f8faff] hover:border-blue-200 hover:shadow-xl hover:bg-white transition-all group duration-300 md:translate-y-12 shadow-inner">
                    <span class="text-6xl font-black text-blue-600/10 group-hover:text-blue-600/20 transition-colors block mb-6 tracking-tighter">03</span>
                    <h3 class="text-2xl font-bold mb-4 text-[#0d1b2a] tracking-tight">Cierra el Trato</h3>
                    <p class="text-base text-[#666] leading-relaxed">Formaliza la pasantía con herramientas de gestión integradas y seguimiento de progreso.</p>
                </div>
            </div>

            <div class="lg:w-1/3 space-y-6">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center border border-blue-100 shadow-md">
                    <i data-lucide="building-2" class="w-8 h-8 text-[#2b6df2]"></i>
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-[#0d1b2a] tracking-tight mb-6">Ruta para Empresas</h2>
                <p class="text-[#666] text-lg leading-relaxed">Optimiza tu proceso de reclutamiento. Encuentra frescura, innovación y compromiso en un solo lugar.</p>
            </div>
        </div>
        <!-- Subtle line decoration -->
        <div class="absolute left-1/2 top-0 bottom-0 w-px bg-gray-100 -translate-x-1/2 z-0 hidden lg:block"></div>
    </section>

    <!-- FOOTER (Actualizado con el nuevo logo animado) -->
    <footer class="bg-[#0d121f] text-white pt-24 pb-12 px-[8%] rounded-t-[40px]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 border-b border-gray-800 pb-16">
            <div class="footer-brand space-y-4">
                <!-- NUEVO LOGO EN EL FOOTER -->
                <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center logo-icon border border-white/10">
                        <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tighter text-white">InternConnect</span>
                </a>
                <p class="text-[#aaa] leading-relaxed text-sm max-w-[280px]">Conectando estudiantes y empresas para experiencias de pasantía significativas.</p>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Para Estudiantes</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#aaa]">
                    <a href="explora" class="hover:text-white transition">Explorar Pasantías</a>
                    <a href="comufunciona" class="hover:text-white transition">Cómo Funciona</a>
                </nav>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Para Empresas</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#aaa]">
                    <a href="login" class="hover:text-white transition">Publicar Oportunidades</a>
                    <a href="login" class="hover:text-white transition">Encontrar Talento</a>
                </nav>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Compañía</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#aaa]">
                    <a href="sobrenosotros" class="hover:text-white transition">Sobre Nosotros</a>
                    <a href="contacto" class="hover:text-white transition">Contacto</a>
                    <a href="privacidad" class="hover:text-white transition">Política de Privacidad</a>
                </nav>
            </div>
        </div>
        <div class="text-center pt-12 text-[#666] text-sm text-xs uppercase tracking-widest">
            © 2026 InternConnect. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Inicializar Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>