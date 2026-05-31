<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estudiante | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .search-gradient {
            background: radial-gradient(circle at top right, #eff6ff 0%, #ffffff 100%);
        }
        .card-neo {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .card-neo:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -5px rgba(43, 109, 242, 0.08);
        }
        .logo-container:hover .logo-icon {
            transform: rotate(12deg) scale(1.1);
            background-color: #2b6df2;
        }
        .logo-icon { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        
        /* Ocultar secciones no activas */
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="text-[#0f172a] overflow-x-hidden min-h-screen flex flex-col justify-between">

    <header class="flex justify-between items-center py-4 px-[8%] bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
            <div class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center logo-icon shadow-sm">
                <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">InternConnect</span>
        </a>
        
        <nav class="flex items-center gap-6">
            <a href="index" class="text-slate-500 font-semibold hover:text-[#2b6df2] transition">Home</a>
            <a href="explora" class="text-slate-500 font-semibold hover:text-[#2b6df2] transition">Explora</a>
            <div class="flex items-center gap-2 pl-4 border-l border-slate-200">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                    JP
                </div>
                <span class="text-sm font-bold text-slate-700 hidden md:inline">Juan Pérez</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="pl-4 border-l border-slate-200">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800 transition">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Cerrar sesión
                </button>
            </form>
        </nav>
    </header>

    <main class="flex-1 max-w-[1400px] w-full mx-auto px-[8%] py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="lg:w-64 flex flex-col gap-2">
                <button data-tab="inicio" class="tab-btn active flex items-center gap-3 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all text-left text-sm w-full">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Inicio / Resumen
                </button>
                <button data-tab="postulaciones" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="send" class="w-5 h-5"></i>
                    Mis Postulaciones
                    <span class="ml-auto bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-full font-bold">2</span>
                </button>
                <button data-tab="documentos" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="files" class="w-5 h-5"></i>
                    Documentos y CV
                </button>
                <button data-tab="entrevistas" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    Entrevistas
                    <span class="ml-auto bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full font-bold">1</span>
                </button>
                <div class="h-px bg-slate-200 my-4"></div>
                <a href="explora" class="flex items-center gap-3 px-5 py-3.5 text-blue-600 hover:bg-blue-50 font-bold rounded-2xl transition-all text-sm">
                    <i data-lucide="search" class="w-5 h-5"></i>
                    Buscar Pasantías
                </a>
            </aside>

            <div class="flex-1">
                
                <section id="inicio" class="tab-content active space-y-8">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">¡Hola de nuevo, Juan! 👋</h1>
                            <p class="text-sm text-slate-500 mt-1">Estudiante de Ingeniería de Sistemas • La Paz</p>
                        </div>
                        <div class="flex items-center gap-3 bg-blue-50/60 p-4 rounded-2xl border border-blue-100/50">
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">75%</div>
                            <div>
                                <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Perfil Completado</h4>
                                <p class="text-xs font-bold text-blue-600 mt-0.5">¡Buen progreso académico!</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="send" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">2</h3>
                                <p class="text-sm font-semibold text-slate-400">Postulaciones Activas</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center"><i data-lucide="calendar" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">1</h3>
                                <p class="text-sm font-semibold text-slate-400">Entrevista Agendada</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center"><i data-lucide="sparkles" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">96%</h3>
                                <p class="text-sm font-semibold text-slate-400">Match Más Alto</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                            <h3 class="font-bold text-slate-900 text-lg">Estado de mis postulaciones</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">Desarrollador Fullstack Junior</h4>
                                        <p class="text-xs text-slate-500 font-medium">SoftBol • La Paz</p>
                                    </div>
                                    <span class="px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-full text-xs">En Revisión</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">Pasante de Inteligencia Artificial</h4>
                                        <p class="text-xs text-slate-500 font-medium">DataFlow Solutions • Santa Cruz</p>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-50 text-blue-700 font-bold rounded-full text-xs">Entrevista</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-6 rounded-[2rem] text-white space-y-4 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 text-blue-400 font-extrabold uppercase text-xs tracking-wider">
                                    <i data-lucide="cpu" class="w-4 h-4"></i> Asistente IA InternConnect
                                </div>
                                <h3 class="text-xl font-bold mt-2 tracking-tight">Mejora tus oportunidades</h3>
                                <p class="text-sm text-slate-300 mt-2 leading-relaxed">Detectamos que la empresa <b>SoftBol</b> está buscando pasantes con conocimientos en <b>Docker</b>. Agrega esta habilidad a tu perfil para subir tu match de un 88% a un 95%.</p>
                            </div>
                            <button class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition active:scale-95">Actualizar Perfil Ahora</button>
                        </div>
                    </div>
                </section>

                <section id="postulations" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Historial de Postulaciones</h2>
                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center"><i data-lucide="database" class="w-6 h-6"></i></div>
                                <div>
                                    <h3 class="font-bold text-slate-900">Pasante de Inteligencia Artificial</h3>
                                    <p class="text-xs text-slate-400 font-bold">DataFlow Solutions • <span class="text-blue-600">Santa Cruz (Presencial)</span></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 font-bold rounded-full text-xs">Entrevista Agendada</span>
                                <span class="text-xs text-slate-400 font-semibold">Postulado: Hace 2 días</span>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="globe" class="w-6 h-6"></i></div>
                                <div>
                                    <h3 class="font-bold text-slate-900">Desarrollador Fullstack Junior</h3>
                                    <p class="text-xs text-slate-400 font-bold">SoftBol • <span class="text-green-600">La Paz (Virtual)</span></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                                <span class="px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-full text-xs">En Revisión por RRHH</span>
                                <span class="text-xs text-slate-400 font-semibold">Postulado: Ayer</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="documents" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Repositorio Legal y Currículum</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center"><i data-lucide="file-text" class="w-6 h-6"></i></div>
                                <span class="text-[10px] bg-green-50 text-green-700 font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider">Verificado por Universidad</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Curriculum_Juan_Perez.pdf</h3>
                                <p class="text-xs text-slate-400 mt-1">Actualizado: Hace 1 semana</p>
                            </div>
                            <div class="flex gap-2 pt-2">
                                <button class="flex-1 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold text-xs transition">Reemplazar</button>
                                <button class="p-2 bg-slate-50 text-slate-500 rounded-xl border border-slate-200 hover:bg-slate-100"><i data-lucide="download" class="w-4 h-4"></i></button>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="file-badge" class="w-6 h-6"></i></div>
                                <span class="text-[10px] bg-amber-50 text-amber-700 font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider">Pendiente de Firma</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Carta_Postulacion_Firmada.pdf</h3>
                                <p class="text-xs text-slate-400 mt-1">Requerido para la pasantía en DataFlow</p>
                            </div>
                            <div class="flex gap-2 pt-2">
                                <button class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-xs transition">Subir Documento</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="interviews" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Mis Próximas Citas y Entrevistas</h2>
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold uppercase tracking-wider text-slate-400">
                                    <th class="p-5">Empresa</th>
                                    <th class="p-5">Fecha y Hora</th>
                                    <th class="p-5">Modalidad</th>
                                    <th class="p-5 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-50">
                                <tr>
                                    <td class="p-5">
                                        <div class="font-bold text-slate-900">DataFlow Solutions</div>
                                        <div class="text-xs text-slate-400">Pasantía IA</div>
                                    </td>
                                    <td class="p-5">28 Mayo, 2026<br><span class="text-xs text-blue-600 font-bold">14:30 (Hora Bolivia)</span></td>
                                    <td class="p-5">
                                        <span class="inline-block px-2 py-0.5 bg-green-50 text-green-700 font-bold rounded text-xs">Virtual</span>
                                    </td>
                                    <td class="p-5 text-right">
                                        <button class="px-4 py-2 bg-[#0d121f] hover:bg-slate-800 text-white font-bold rounded-xl text-xs transition">Ingresar al Meet</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <footer class="bg-[#0d121f] text-white pt-24 pb-12 px-[8%] rounded-t-[40px] mt-20">
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

    <script>
        // Inicializar Iconos Lucide
        lucide.createIcons();

        // Mapear los botones del menú con sus respectivos contenedores
        const tabsMap = {
            'inicio': document.getElementById('inicio'),
            'postulaciones': document.getElementById('postulations'),
            'documentos': document.getElementById('documents'),
            'entrevistas': document.getElementById('interviews')
        };

        const tabButtons = document.querySelectorAll('.tab-btn');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.getAttribute('data-tab');

                // 1. Quitar el estado activo de todos los botones de la barra lateral
                tabButtons.forEach(b => {
                    b.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                    b.classList.add('text-slate-600', 'hover:bg-slate-100');
                    b.classList.remove('font-bold');
                    b.classList.add('font-semibold');
                });

                // 2. Aplicar estilos activos al botón presionado
                btn.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                btn.classList.remove('text-slate-600', 'hover:bg-slate-100');
                btn.classList.add('font-bold');
                btn.classList.remove('font-semibold');

                // 3. Ocultar todos los contenedores de secciones y mostrar el seleccionado
                Object.values(tabsMap).forEach(section => section.classList.remove('active'));
                tabsMap[targetTab].classList.add('active');
            });
        });
    </script>
</body>
</html>