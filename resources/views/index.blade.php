<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Importar Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 4s infinite ease-in-out; }

        @keyframes progressLoad {
            from { width: 0%; }
            to { width: 87%; }
        }
        .animate-progress { animation: progressLoad 2s ease-out forwards; }

        /* Estilos para la animación del logo (sacados del login) */
        .logo-container:hover .logo-icon {
            transform: rotate(12deg) scale(1.1);
            background-color: #2b6df2;
        }
        .logo-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-white overflow-x-hidden text-[#1a1a1a]">

    <!-- HEADER / NAVBAR -->
    <header class="flex justify-between items-center py-4 px-[8%] bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <!-- NUEVO LOGO ANIMADO (Adaptado del Login) -->
        <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
            <div class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center logo-icon shadow-sm">
                <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">InternConnect</span>
        </a>
        
        <nav class="flex items-center gap-6">
            <a href="index" class="text-[#2b6df2] font-semibold hover:text-[#2b6df2] transition">Home</a>
            <a href="login" class="px-5 py-2.5 border border-[#ddd] rounded-xl text-[#1a1a1a] font-medium hover:bg-gray-50 transition">Login</a>
            <a href="registro" class="px-6 py-2.5 bg-[#0d121f] text-white rounded-xl font-semibold hover:bg-slate-800 transition shadow-md active:scale-95">Registro</a>
        </nav>
    </header>

    <!-- HERO -->
    <section class="flex flex-col lg:flex-row items-center py-24 px-[8%] gap-12 bg-[#f8faff]">
        <div class="flex-1 space-y-6">
            <h1 class="text-5xl lg:text-6xl font-bold leading-[1.1] text-[#0d1b2a] tracking-tight">
                Conecta tu futuro con la <span class="text-[#2b6df2]">Pasantía Perfecta</span>
            </h1>
            <p class="text-[#666] text-lg leading-relaxed max-w-xl">
                Cerrar la brecha entre estudiantes ambiciosos y empresas pensantes. Encuentra oportunidades de pasantía significativas o descubre el mejor talento para tu organización.
            </p>
            <div class="flex gap-4 pt-4">
                <a href="explora"
   class="bg-[#0d121f] text-white px-8 py-4 rounded-xl font-bold hover:bg-slate-800 transition shadow-lg active:scale-95 flex items-center gap-2 inline-flex">
    Buscar Pasantías
    <i data-lucide="search" class="w-5 h-5"></i>
</a>
                <a href="/login"
   class="bg-white border border-[#eee] px-8 py-4 rounded-xl font-bold hover:bg-gray-50 transition active:scale-95 text-[#1a1a1a] inline-block">
   Publicar Pasantía
</a>
            </div>
        </div>
        <div class="flex-1 relative animate-float flex justify-center lg:justify-end">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" alt="Students working" class="w-full max-w-[550px] rounded-[32px] shadow-2xl border-4 border-white">
            <div class="absolute bottom-8 -left-8 bg-white p-5 rounded-2xl flex items-center gap-4 shadow-[0_15px_40px_rgba(0,0,0,0.1)] border border-gray-100">
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center border border-blue-100">
                    <div class="w-6 h-6 border-2 border-[#2b6df2] rounded-full border-t-transparent animate-spin"></div>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs text-[#666] font-medium uppercase tracking-wider">Tasa de Éxito</span>
                    <strong class="text-2xl text-[#0d121f] font-extrabold">87%</strong>
                    <div class="w-20 h-1.5 bg-gray-100 rounded-full overflow-hidden mt-1.5">
                        <div class="h-full bg-[#2b6df2] animate-progress rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="grid grid-cols-1 md:grid-cols-3 py-24 px-[8%] gap-10 bg-white">
        <!-- Feature 1 -->
        <div class="bg-white p-10 rounded-[24px] border border-[#f0f0f0] shadow-sm hover:shadow-xl hover:border-blue-100 transition-all duration-300 group">
            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#eef4ff] mb-6 group-hover:scale-110 transition-transform shadow-inner border border-blue-100">
                <i data-lucide="brain-circuit" class="w-7 h-7 text-[#2b6df2]"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-[#0d1b2a] tracking-tight">Matching Inteligente</h3>
            <p class="text-[#666] leading-relaxed text-base">Nuestro algoritmo inteligente combina estudiantes con las oportunidades de pasantía más relevantes basadas en habilidades, intereses y objetivos profesionales.</p>
        </div>
        <!-- Feature 2 -->
        <div class="bg-white p-10 rounded-[24px] border border-[#f0f0f0] shadow-sm hover:shadow-xl hover:border-blue-100 transition-all duration-300 group">
            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#eef4ff] mb-6 group-hover:scale-110 transition-transform shadow-inner border border-blue-100">
                <i data-lucide="building-2" class="w-7 h-7 text-[#2b6df2]"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-[#0d1b2a] tracking-tight">Empresas Verificadas</h3>
            <p class="text-[#666] leading-relaxed text-base">Trabaja con confianza sabiendo que todas las empresas están verificadas y comprometidas a proporcionar experiencias de aprendizaje valiosas.</p>
        </div>
        <!-- Feature 3 -->
        <div class="bg-white p-10 rounded-[24px] border border-[#f0f0f0] shadow-sm hover:shadow-xl hover:border-blue-100 transition-all duration-300 group">
            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#eef4ff] mb-6 group-hover:scale-110 transition-transform shadow-inner border border-blue-100">
                <i data-lucide="layout-dashboard" class="w-7 h-7 text-[#2b6df2]"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-[#0d1b2a] tracking-tight">Gestión Simplificada</h3>
            <p class="text-[#666] leading-relaxed text-base">El proceso de gestión de aplicaciones es intuitivo y sencillo, permitiéndote encontrar la coincidencia perfecta de manera eficiente.</p>
        </div>
    </section>

    <!-- SECTION STUDENTS -->
    <section class="bg-[#2b6df2] py-24 px-[8%] flex flex-col lg:flex-row items-center gap-16 text-white rounded-[40px] my-10 mx-[4%] shadow-2xl shadow-blue-500/20">
        <div class="flex-1 space-y-6">
            <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center mb-6 border border-white/20 shadow-xl">
                <i data-lucide="user-check" class="w-8 h-8 text-white"></i>
            </div>
            <h2 class="text-4xl lg:text-5xl font-bold mb-6 tracking-tight">Para Estudiantes</h2>
            <ul class="mb-10 space-y-4 text-lg text-blue-50 opacity-95">
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-white"></i> Explorar cientos de oportunidades de pasantía</li>
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-white"></i> Matching con posiciones que se ajusten a tu perfil</li>
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-white"></i> Seguimiento de aplicaciones en tiempo real</li>
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-white"></i> Construir tu red profesional</li>
            </ul>
            <a href="login"
   class="bg-white text-[#2b6df2] px-10 py-4 rounded-xl font-bold hover:bg-blue-50 transition shadow-lg active:scale-95 text-lg inline-block">
   Comenzar como estudiante
</a>
        </div>
        <div class="flex-1 w-full bg-white/10 p-10 rounded-[32px] flex flex-col gap-6 border border-white/20 shadow-inner">
            <div class="bg-white/15 p-7 rounded-2xl transform transition hover:scale-[1.03] hover:bg-white/20 cursor-pointer border border-white/10 space-y-2">
                <span class="text-sm font-semibold opacity-80 block uppercase tracking-wider">Paso 1</span>
                <h3 class="text-2xl font-bold text-white">Crear perfil</h3>
            </div>
            <div class="bg-white/15 p-7 rounded-2xl transform transition hover:scale-[1.03] hover:bg-white/20 cursor-pointer border border-white/10 space-y-2">
                <span class="text-sm font-semibold opacity-80 block uppercase tracking-wider">Paso 2</span>
                <h3 class="text-2xl font-bold text-white">Buscar y aplicar</h3>
            </div>
            <div class="bg-white/15 p-7 rounded-2xl transform transition hover:scale-[1.03] hover:bg-white/20 cursor-pointer border border-white/10 space-y-2">
                <span class="text-sm font-semibold opacity-80 block uppercase tracking-wider">Paso 3</span>
                <h3 class="text-2xl font-bold text-white">Comenzar la pasantía</h3>
            </div>
        </div>
    </section>

    <!-- SECTION COMPANIES -->
    <section class="bg-[#fcfcfc] py-24 px-[8%] flex flex-col lg:flex-row items-center gap-16">
        <div class="flex-1 w-full bg-[#f8f8f8] p-10 rounded-[32px] flex flex-col gap-6 order-2 lg:order-1 border border-gray-100 shadow-inner">
            <div class="bg-white p-7 rounded-2xl border border-[#eee] shadow-sm transform transition hover:scale-[1.03] hover:shadow-lg hover:border-gray-200 cursor-pointer space-y-2">
                <span class="text-[#888] text-sm font-semibold block uppercase tracking-wider">Paso 1</span>
                <h3 class="text-2xl font-bold text-[#0d121f]">Publicar oportunidades</h3>
            </div>
            <div class="bg-white p-7 rounded-2xl border border-[#eee] shadow-sm transform transition hover:scale-[1.03] hover:shadow-lg hover:border-gray-200 cursor-pointer space-y-2">
                <span class="text-[#888] text-sm font-semibold block uppercase tracking-wider">Paso 2</span>
                <h3 class="text-2xl font-bold text-[#0d121f]">Revisar candidatos</h3>
            </div>
            <div class="bg-white p-7 rounded-2xl border border-[#eee] shadow-sm transform transition hover:scale-[1.03] hover:shadow-lg hover:border-gray-200 cursor-pointer space-y-2">
                <span class="text-[#888] text-sm font-semibold block uppercase tracking-wider">Paso 3</span>
                <h3 class="text-2xl font-bold text-[#0d121f]">Contratar talento</h3>
            </div>
        </div>
        <div class="flex-1 order-1 lg:order-2 space-y-6">
            <div class="w-16 h-16 bg-[#2b6df2]/10 rounded-2xl flex items-center justify-center mb-6 border border-blue-100 shadow-md">
                <i data-lucide="briefcase" class="w-8 h-8 text-[#2b6df2]"></i>
            </div>
            <h2 class="text-4xl lg:text-5xl font-bold mb-6 tracking-tight text-[#0d121f]">Para Empresas</h2>
            <ul class="mb-10 space-y-4 text-lg text-[#555]">
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2b6df2]"></i> Acceso a pool de estudiantes talentosos</li>
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2b6df2]"></i> Recomendaciones inteligentes de candidatos</li>
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2b6df2]"></i> Gestión de aplicaciones optimizada</li>
                <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2b6df2]"></i> Construir tu futuro equipo de trabajo</li>
            </ul>
           <a href="login"
   class="bg-[#0d121f] text-white px-10 py-4 rounded-xl font-bold hover:bg-slate-800 transition shadow-lg active:scale-95 text-lg inline-block">
   Comenzar como Empresa
</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#0d121f] text-white pt-24 pb-12 px-[8%] rounded-t-[40px]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-16 border-b border-gray-800">
            <div class="footer-brand space-y-4">
                <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center logo-icon border border-white/10">
                        <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tighter text-white">InternConnect</span>
                </a>
                <p class="text-[#aaa] max-w-[280px] text-sm leading-relaxed">Conectando estudiantes y empresas para experiencias de pasantía significativas y de alto impacto.</p>
            </div>
            <div class="flex flex-col gap-3.5">
                <h4 class="font-bold mb-3 text-lg text-white/90">Para Estudiantes</h4>
                <a href="explora" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Explorar Pasantías</a>
                <a href="comofunciona" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Cómo Funciona</a>
            </div>
            <div class="flex flex-col gap-3.5">
                <h4 class="font-bold mb-3 text-lg text-white/90">Para Empresas</h4>
                <a href="login" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Publicar Oportunidades</a>
                <a href="login" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Encontrar Talento</a>
            </div>
            <div class="flex flex-col gap-3.5">
                <h4 class="font-bold mb-3 text-lg text-white/90">Compañía</h4>
                <a href="sobrenosotros" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Sobre Nosotros</a>
                <a href="contacto" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Contacto</a>
                <a href="privacidad" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Política de Privacidad</a>
            </div>
        </div>
        <div class="text-center pt-12 text-[#666] text-sm">
            © 2026 InternConnect. Todos los derechos reservados. Desarrollado con pasión en Bolivia.
        </div>
    </footer>

    <!-- Inicializar Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>