<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Empresa | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
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
                <div id="nav-avatar" class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                    SB
                </div>
                <span id="nav-company-name" class="text-sm font-bold text-slate-700 hidden md:inline">SoftBol S.R.L.</span>
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
                    Panel de Control
                </button>
                <button data-tab="ofertas" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                    Gestionar Ofertas (CRUD)
                    <span class="ml-auto bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-full font-bold">1</span>
                </button>
                <button data-tab="postulantes" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Candidatos / Postulantes
                    <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full font-bold">3</span>
                </button>
                <button data-tab="perfil" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                    Perfil de Empresa
                </button>
                <div class="h-px bg-slate-200 my-4"></div>
                <button onclick="openModal()" class="flex items-center justify-center gap-2 px-5 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl transition-all text-sm w-full shadow-md shadow-indigo-100">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    Publicar Vacante
                </button>
            </aside>

            <div class="flex-1">
                
                <section id="inicio" class="tab-content active space-y-8">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 id="welcome-title" class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Bienvenido, Reclutador SoftBol 🏢</h1>
                            <p id="welcome-subtitle" class="text-sm text-slate-500 mt-1">Sector: Desarrollo de Software • Sede Principal: La Paz</p>
                        </div>
                        <span class="px-4 py-2 bg-green-50 text-green-700 font-extrabold rounded-xl text-xs border border-green-200/50">Convenio Universitario Activo</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="briefcase" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">1</h3>
                                <p class="text-sm font-semibold text-slate-400">Oferta Activa</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center"><i data-lucide="users" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">3</h3>
                                <p class="text-sm font-semibold text-slate-400">Postulantes Nuevos</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center"><i data-lucide="file-check" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">0</h3>
                                <p class="text-sm font-semibold text-slate-400">Convenios por Firmar</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-7 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                        <h3 class="font-bold text-slate-900 text-lg">Últimas Postulaciones Recibidas</h3>
                        <div class="divide-y divide-slate-100">
                            <div class="flex items-center justify-between py-3.5 first:pt-0 last:pb-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center font-bold text-xs text-slate-700">JP</div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">Juan Pérez</h4>
                                        <p class="text-xs text-slate-400">Ing. de Sistemas (La Paz) • <span class="text-blue-600 font-semibold">88% Match</span></p>
                                    </div>
                                </div>
                                <span class="text-xs bg-amber-50 text-amber-700 px-2.5 py-1 rounded-full font-bold">Pendiente</span>
                            </div>
                            <div class="flex items-center justify-between py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center font-bold text-xs text-slate-700">MG</div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">María Gómez</h4>
                                        <p class="text-xs text-slate-400">Ing. Informática (Cochabamba) • <span class="text-blue-600 font-semibold">91% Match</span></p>
                                    </div>
                                </div>
                                <span class="text-xs bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full font-bold">En Entrevista</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="ofertas" class="tab-content space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900">Mis Convocatorias Publicadas</h2>
                        <span class="text-xs font-semibold text-slate-400">Lista de ofertas en el sistema</span>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4 card-neo">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="globe" class="w-6 h-6"></i></div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-lg">Desarrollador Fullstack Junior</h3>
                                    <p class="text-xs text-slate-400 font-bold">Área: Ingeniería y Tecnología • <span class="text-green-600">La Paz (Virtual)</span></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                                <button class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition" title="Editar Oferta (Update)">
                                    <i data-lucide="edit-2" class="w-5 h-5"></i>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition" title="Eliminar Oferta (Delete)" onclick="alert('Simulación: Oferta eliminada lógicamente.')">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="postulantes" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Postulantes por Evaluar</h2>
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold uppercase tracking-wider text-slate-400">
                                    <th class="p-5">Estudiante</th>
                                    <th class="p-5">Carrera / Origen</th>
                                    <th class="p-5">Match</th>
                                    <th class="p-5 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-50">
                                <tr>
                                    <td class="p-5 font-bold text-slate-900">Juan Pérez</td>
                                    <td class="p-5">Ing. de Sistemas<br><span class="text-xs text-slate-400">Sede La Paz</span></td>
                                    <td class="p-5"><span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full font-bold text-xs">88% Match</span></td>
                                    <td class="p-5 text-right flex gap-2 justify-end">
                                        <button class="px-3 py-1.5 bg-slate-100 text-slate-700 font-bold rounded-xl text-xs hover:bg-slate-200">Ver CV</button>
                                        <button class="px-3 py-1.5 bg-indigo-600 text-white font-bold rounded-xl text-xs hover:bg-indigo-700">Citar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-5 font-bold text-slate-900">María Gómez</td>
                                    <td class="p-5">Ing. Informática<br><span class="text-xs text-slate-400">Sede Cochabamba</span></td>
                                    <td class="p-5"><span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full font-bold text-xs">91% Match</span></td>
                                    <td class="p-5 text-right flex gap-2 justify-end">
                                        <button class="px-3 py-1.5 bg-slate-100 text-slate-700 font-bold rounded-xl text-xs hover:bg-slate-200">Ver CV</button>
                                        <button class="px-3 py-1.5 bg-indigo-600 text-white font-bold rounded-xl text-xs hover:bg-indigo-700">Citar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="perfil" class="tab-content space-y-6">
                    <div class="flex flex-col">
                        <h2 class="text-xl font-bold text-slate-900">Perfil Informativo Corporativo</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Mantén la información de tu organización actualizada para los estudiantes.</p>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                        <form onsubmit="updateEmpresa(event)" class="space-y-6 text-sm font-semibold">
                            
                            <div class="flex items-center gap-6 pb-6 border-b border-slate-100">
                                <div class="w-20 h-20 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-md">
                                    SB
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block">Logotipo Institucional</label>
                                    <button type="button" class="px-4 py-2 border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-xl transition">Cambiar Imagen</button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Nombre de la Empresa</label>
                                    <input type="text" id="input-empresa-nombre" required value="SoftBol S.R.L." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">NIT / Registro Legal</label>
                                    <input type="text" required value="348910021" disabled class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl font-medium text-slate-400 cursor-not-allowed">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Sede Principal</label>
                                    <select id="input-empresa-sede" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                                        <option value="La Paz" selected>La Paz</option>
                                        <option value="Santa Cruz">Santa Cruz</option>
                                        <option value="Cochabamba">Cochabamba</option>
                                        <option value="Tarija">Tarija</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Rubro o Sector</label>
                                    <input type="text" id="input-empresa-rubro" required value="Desarrollo de Software" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Descripción Breve de la Organización</label>
                                <textarea id="input-empresa-desc" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none">Empresa boliviana líder enfocada en proveer soluciones informáticas de alto rendimiento y outsourcing tecnológico a nivel nacional.</textarea>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-100 transition active:scale-95 text-xs">Guardar Cambios de Perfil</button>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <div id="modal-oferta" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Nueva Oferta de Pasantía</h3>
                <button onclick="closeModal()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <form onsubmit="saveOferta(event)" class="space-y-4 text-sm font-semibold">
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Título del Puesto</label>
                    <input type="text" required placeholder="Ej. Pasante QA Automation" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Departamento</label>
                        <select required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            <option value="La Paz">La Paz</option>
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="Cochabamba">Cochabamba</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Modalidad</label>
                        <select required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            <option value="Remoto">Virtual / Remoto</option>
                            <option value="Presencial">Presencial</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Área Académica Destino</label>
                    <select required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                        <option value="Ingeniería">Ingeniería y Tecnología</option>
                        <option value="Diseño">Diseño y Arte Digital</option>
                        <option value="Negocios">Negocios y Ciencias Económicas</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Requisitos Clave</label>
                    <textarea rows="3" required placeholder="Ej. Conocimientos básicos de Java..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModal()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">Guardar Publicación</button>
                </div>
            </form>
        </div>
    </div>

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
        lucide.createIcons();

        // Control de Pestañas (Tabs) con la nueva pestaña agregada
        const tabsMap = {
            'inicio': document.getElementById('inicio'),
            'ofertas': document.getElementById('ofertas'),
            'postulantes': document.getElementById('postulantes'),
            'perfil': document.getElementById('perfil')
        };
        const tabButtons = document.querySelectorAll('.tab-btn');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.getAttribute('data-tab');
                tabButtons.forEach(b => {
                    b.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                    b.classList.add('text-slate-600', 'hover:bg-slate-100');
                    b.classList.replace('font-bold', 'font-semibold');
                });
                btn.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                btn.classList.remove('text-slate-600', 'hover:bg-slate-100');
                btn.classList.replace('font-semibold', 'font-bold');

                Object.values(tabsMap).forEach(section => section.classList.remove('active'));
                tabsMap[targetTab].classList.add('active');
            });
        });

        // Funciones para controlar el modal de Creación (CRUD Vacantes)
        const modal = document.getElementById('modal-oferta');
        function openModal() { modal.classList.remove('hidden'); }
        function closeModal() { modal.classList.add('hidden'); }
        
        function saveOferta(e) {
            e.preventDefault();
            alert('Simulación: Oferta guardada correctamente.');
            closeModal();
        }

        // Simulación Funcional de Actualización de Datos de la Empresa (Update Perfil)
        function updateEmpresa(e) {
            e.preventDefault();
            
            // Capturar los nuevos valores ingresados en el formulario
            const nuevoNombre = document.getElementById('input-empresa-nombre').value;
            const nuevaSede = document.getElementById('input-empresa-sede').value;
            const nuevoRubro = document.getElementById('input-empresa-rubro').value;
            
            // Actualizar elementos visuales dinámicos del Dashboard en tiempo real
            document.getElementById('nav-company-name').textContent = nuevoNombre;
            document.getElementById('welcome-title').textContent = `Bienvenido, Reclutador ${nuevoNombre} 🏢`;
            document.getElementById('welcome-subtitle').textContent = `Sector: ${nuevoRubro} • Sede Principal: ${nuevaSede}`;
            
            alert('¡Datos de la empresa modificados con éxito en la simulación local! Cuando conectes la base de datos, este formulario enviará una petición de actualización (PUT/PATCH) en Laravel.');
        }
    </script>
</body>
</html>