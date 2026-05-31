<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 4s infinite ease-in-out; }

        .card-neo {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .card-neo:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(43, 109, 242, 0.1), 0 10px 10px -5px rgba(43, 109, 242, 0.04);
            border-color: #2b6df2;
        }

        /* Estilos para la animación del logo (exactas al index) */
        .logo-container:hover .logo-icon {
            transform: rotate(12deg) scale(1.1);
            background-color: #2b6df2;
        }
        .logo-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .search-gradient {
            background: radial-gradient(circle at top right, #eff6ff 0%, #ffffff 100%);
        }
    </style>
</head>
<body class="bg-white overflow-x-hidden text-[#1a1a1a]">

    <header class="flex justify-between items-center py-4 px-[8%] bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
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

    <main class="min-h-screen bg-[#f8fafc]">
        <section class="pt-12 pb-20 px-[8%] search-gradient relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-600 uppercase bg-blue-50 rounded-full">Búsqueda Inteligente</span>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-8 tracking-tight">
                    Encuentra tu próximo <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">gran reto</span>
                </h1>
                
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <i data-lucide="search" class="w-6 h-6 text-slate-400"></i>
                    </div>
                    <input type="text" id="search-input" placeholder="Buscar por título de pasantía o empresa..." 
                           class="w-full pl-16 pr-32 py-5 bg-white border-2 border-slate-100 rounded-3xl outline-none focus:border-blue-400 focus:ring-8 focus:ring-blue-50 transition-all text-lg shadow-2xl shadow-slate-200/50 font-medium">
                </div>
            </div>
        </section>

        <section class="max-w-[1400px] mx-auto px-[8%] -mt-10 pb-20 relative z-20">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <aside class="lg:w-80 space-y-6">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/60 sticky top-28">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-slate-900 flex items-center gap-2 text-base">
                                <i data-lucide="sliders-horizontal" class="w-4 h-4 text-blue-600"></i>
                                Filtros de Búsqueda
                            </h3>
                            <button id="btn-limpiar" class="text-xs font-bold text-blue-600 hover:underline">Limpiar</button>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">Departamento (Bolivia)</label>
                                <div class="relative">
                                    <select id="select-departamento" class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all text-sm font-semibold appearance-none cursor-pointer">
                                        <option value="Todos">Seleccionar departamento</option>
                                        <option value="Beni">Beni</option>
                                        <option value="Chuquisaca">Chuquisaca</option>
                                        <option value="Cochabamba">Cochabamba</option>
                                        <option value="La Paz">La Paz</option>
                                        <option value="Oruro">Oruro</option>
                                        <option value="Pando">Pando</option>
                                        <option value="Potosí">Potosí</option>
                                        <option value="Santa Cruz">Santa Cruz</option>
                                        <option value="Tarija">Tarija</option>
                                    </select>
                                    <i data-lucide="chevron-down" class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">Áreas de Estudio</label>
                                <div class="grid grid-cols-1 gap-1.5" id="area-container">
                                    <button data-area="Ingeniería" class="filter-area flex items-center justify-between px-4 py-2.5 bg-slate-50 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-100 transition-all">
                                        <span>Ingeniería y Tecnología</span>
                                        <i data-lucide="check" class="w-3.5 h-3.5 hidden"></i>
                                    </button>
                                    <button data-area="Diseño" class="filter-area flex items-center justify-between px-4 py-2.5 bg-slate-50 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-100 transition-all">
                                        <span>Diseño y Arte Digital</span>
                                        <i data-lucide="check" class="w-3.5 h-3.5 hidden"></i>
                                    </button>
                                    <button data-area="Negocios" class="filter-area flex items-center justify-between px-4 py-2.5 bg-slate-50 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-100 transition-all">
                                        <span>Negocios y Ciencias Económicas</span>
                                        <i data-lucide="check" class="w-3.5 h-3.5 hidden"></i>
                                    </button>
                                    <button data-area="Salud" class="filter-area flex items-center justify-between px-4 py-2.5 bg-slate-50 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-100 transition-all">
                                        <span>Ciencias de la Salud</span>
                                        <i data-lucide="check" class="w-3.5 h-3.5 hidden"></i>
                                    </button>
                                    <button data-area="Derecho" class="filter-area flex items-center justify-between px-4 py-2.5 bg-slate-50 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-100 transition-all">
                                        <span>Derecho y Ciencias Políticas</span>
                                        <i data-lucide="check" class="w-3.5 h-3.5 hidden"></i>
                                    </button>
                                    <button data-area="Humanidades" class="filter-area flex items-center justify-between px-4 py-2.5 bg-slate-50 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-100 transition-all">
                                        <span>Humanidades y Comunicación</span>
                                        <i data-lucide="check" class="w-3.5 h-3.5 hidden"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">Modalidad</label>
                                <div class="space-y-2.5">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" value="Remoto" class="filter-modalidad sr-only">
                                        <div class="checkbox-visual w-5 h-5 border-2 border-slate-200 rounded-md flex items-center justify-center group-hover:border-blue-400 transition-all bg-white">
                                            <div class="w-2.5 h-2.5 bg-blue-600 rounded-sm indicator hidden"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-600">Virtual / Remoto</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" value="Presencial" class="filter-modalidad sr-only">
                                        <div class="checkbox-visual w-5 h-5 border-2 border-slate-200 rounded-md flex items-center justify-center group-hover:border-blue-400 transition-all bg-white">
                                            <div class="w-2.5 h-2.5 bg-blue-600 rounded-sm indicator hidden"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-600">Presencial</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <div class="flex-1 space-y-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Panel de Resultados</h2>
                            <p class="text-sm text-slate-500" id="results-counter">Aplica un filtro para iniciar la simulación</p>
                        </div>
                    </div>

                    <div id="empty-state" class="bg-white border border-slate-100 rounded-[2rem] p-12 text-center shadow-sm">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="database-zap" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Sin conexión transaccional</h3>
                        <p class="text-sm text-slate-500 max-w-md mx-auto">No se encontraron ofertas cargadas en este país. Interactúa con la barra de filtros de la izquierda para simular el comportamiento del sistema.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 hidden" id="postings-grid">
                        
                        <div class="job-card card-neo bg-white p-7 rounded-[2rem] flex flex-col justify-between" 
                             data-title="Pasante de Inteligencia Artificial" data-company="DataFlow Solutions" data-dept="Santa Cruz" data-area="Ingeniería" data-modality="Presencial">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                                        <i data-lucide="database" class="w-8 h-8 text-indigo-600"></i>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-50 text-blue-700 font-extrabold rounded-full text-xs">96% Match</span>
                                </div>
                                <div class="space-y-2 mb-6">
                                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight card-title">Pasante de Inteligencia Artificial</h3>
                                    <p class="text-sm font-bold text-blue-600">DataFlow Solutions • <span class="card-dept">Santa Cruz</span></p>
                                    <span class="inline-block mt-1 px-2.5 py-0.5 bg-purple-50 text-purple-700 rounded-md text-xs font-bold">Presencial</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <span class="text-xs font-semibold text-slate-400">Hace 2 horas</span>
                                <button class="px-6 py-3 bg-[#0d121f] text-white rounded-xl text-sm font-bold">Ver detalles</button>
                            </div>
                        </div>

                        <div class="job-card card-neo bg-white p-7 rounded-[2rem] flex flex-col justify-between" 
                             data-title="Desarrollador Fullstack Junior" data-company="SoftBol" data-dept="La Paz" data-area="Ingeniería" data-modality="Remoto">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                                        <i data-lucide="globe" class="w-8 h-8 text-blue-500"></i>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-50 text-blue-700 font-extrabold rounded-full text-xs">88% Match</span>
                                </div>
                                <div class="space-y-2 mb-6">
                                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight card-title">Desarrollador Fullstack Junior</h3>
                                    <p class="text-sm font-bold text-blue-600">SoftBol • <span class="card-dept">La Paz</span></p>
                                    <span class="inline-block mt-1 px-2.5 py-0.5 bg-green-50 text-green-700 rounded-md text-xs font-bold">Virtual / Remoto</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <span class="text-xs font-semibold text-slate-400">Ayer</span>
                                <button class="px-6 py-3 bg-[#0d121f] text-white rounded-xl text-sm font-bold">Ver detalles</button>
                            </div>
                        </div>

                        <div class="job-card card-neo bg-white p-7 rounded-[2rem] flex flex-col justify-between" 
                             data-title="Diseñador UI/UX de Plataformas" data-company="CreativosBo" data-dept="Cochabamba" data-area="Diseño" data-modality="Remoto">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                                        <i data-lucide="palette" class="w-8 h-8 text-pink-500"></i>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-50 text-blue-700 font-extrabold rounded-full text-xs">82% Match</span>
                                </div>
                                <div class="space-y-2 mb-6">
                                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight card-title">Diseñador UI/UX de Plataformas</h3>
                                    <p class="text-sm font-bold text-blue-600">CreativosBo • <span class="card-dept">Cochabamba</span></p>
                                    <span class="inline-block mt-1 px-2.5 py-0.5 bg-green-50 text-green-700 rounded-md text-xs font-bold">Virtual / Remoto</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <span class="text-xs font-semibold text-slate-400">Hace 3 días</span>
                                <button class="px-6 py-3 bg-[#0d121f] text-white rounded-xl text-sm font-bold">Ver detalles</button>
                            </div>
                        </div>

                        <div class="job-card card-neo bg-white p-7 rounded-[2rem] flex flex-col justify-between" 
                             data-title="Asistente de Auditoría Financiera" data-company="Consultores Asociados" data-dept="Tarija" data-area="Negocios" data-modality="Presencial">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                                        <i data-lucide="trending-up" class="w-8 h-8 text-emerald-500"></i>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-50 text-blue-700 font-extrabold rounded-full text-xs">79% Match</span>
                                </div>
                                <div class="space-y-2 mb-6">
                                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight card-title">Asistente de Auditoría Financiera</h3>
                                    <p class="text-sm font-bold text-blue-600">Consultores Asociados • <span class="card-dept">Tarija</span></p>
                                    <span class="inline-block mt-1 px-2.5 py-0.5 bg-purple-50 text-purple-700 rounded-md text-xs font-bold">Presencial</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <span class="text-xs font-semibold text-slate-400">Hace 1 semana</span>
                                <button class="px-6 py-3 bg-[#0d121f] text-white rounded-xl text-sm font-bold">Ver detalles</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </main>

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

    <script>
        // Inicializar Iconos de Lucide
        lucide.createIcons();

        // Estado Global de Filtros (Vacíos inicialmente para que no muestre nada de entrada)
        const state = {
            search: '',
            departamento: 'Todos',
            areas: [], 
            modalidades: [],
            hasInteracted: false // Bandera para saber si ya tocó algún filtro
        };

        // Nodos del DOM
        const searchInput = document.getElementById('search-input');
        const selectDept = document.getElementById('select-departamento');
        const areaButtons = document.querySelectorAll('.filter-area');
        const checkboxesModality = document.querySelectorAll('.filter-modalidad');
        const jobCards = document.querySelectorAll('.job-card');
        const btnLimpiar = document.getElementById('btn-limpiar');
        const resultsCounter = document.getElementById('results-counter');
        const emptyState = document.getElementById('empty-state');
        const postingsGrid = document.getElementById('postings-grid');

        // Refrescar UI visual de los checkboxes manuales
        function updateCheckboxUI() {
            checkboxesModality.forEach(cb => {
                const indicator = cb.nextElementSibling.querySelector('.indicator');
                if(cb.checked) {
                    indicator.classList.remove('hidden');
                    cb.nextElementSibling.classList.add('border-blue-600', 'bg-blue-50');
                } else {
                    indicator.classList.add('hidden');
                    cb.nextElementSibling.classList.remove('border-blue-600', 'bg-blue-50');
                }
            });
        }

        // Motor de renderizado de tarjetas filtradas
        function filtrarOfertas() {
            // Si el usuario no ha interactuado con ningún filtro, mantenemos el Empty State
            if (!state.hasInteracted) {
                emptyState.classList.remove('hidden');
                postingsGrid.classList.add('hidden');
                resultsCounter.textContent = "Aplica un filtro para iniciar la simulación";
                return;
            }

            let visibles = 0;

            jobCards.forEach(card => {
                const title = card.getAttribute('data-title').toLowerCase();
                const company = card.getAttribute('data-company').toLowerCase();
                const dept = card.getAttribute('data-dept');
                const area = card.getAttribute('data-area');
                const modality = card.getAttribute('data-modality');

                // Validaciones condicionales lógicas
                const matchSearch = title.includes(state.search) || company.includes(state.search);
                const matchDept = state.departamento === 'Todos' || state.departamento === dept;
                const matchArea = state.areas.length === 0 || state.areas.includes(area);
                // Si no hay modalidades seleccionadas, no muestra ninguna
                const matchModality = state.modalidades.length > 0 && state.modalidades.includes(modality);

                if(matchSearch && matchDept && matchArea && matchModality) {
                    card.classList.remove('hidden');
                    visibles++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Alternar contenedores principales según resultados encontrados
            if (visibles > 0) {
                emptyState.classList.add('hidden');
                postingsGrid.classList.remove('hidden');
                resultsCounter.textContent = visibles === 1 ? '1 pasantía simulada encontrada' : `${visibles} pasantías simuladas encontradas`;
            } else {
                emptyState.classList.remove('hidden');
                postingsGrid.classList.add('hidden');
                resultsCounter.textContent = "0 coincidencias obtenidas";
            }
        }

        // Activador de interacción inicial
        function registrarInteraccion() {
            state.hasInteracted = true;
        }

        // Eventos de entrada: Texto
        searchInput.addEventListener('input', (e) => {
            registrarInteraccion();
            state.search = e.target.value.toLowerCase();
            filtrarOfertas();
        });

        // Eventos de entrada: Menú Select de Departamentos
        selectDept.addEventListener('change', (e) => {
            registrarInteraccion();
            state.departamento = e.target.value;
            filtrarOfertas();
        });

        // Eventos de entrada: Botones de áreas de estudio
        areaButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                registrarInteraccion();
                const areaValue = btn.getAttribute('data-area');
                const iconCheck = btn.querySelector('[data-lucide="check"]');

                if(state.areas.includes(areaValue)) {
                    state.areas = state.areas.filter(a => a !== areaValue);
                    btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                    btn.classList.add('bg-slate-50', 'text-slate-600');
                    iconCheck.classList.add('hidden');
                } else {
                    state.areas.push(areaValue);
                    btn.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                    btn.classList.remove('bg-slate-50', 'text-slate-600');
                    iconCheck.classList.remove('hidden');
                }
                filtrarOfertas();
            });
        });

        // Eventos de entrada: Checkboxes de modalidad
        checkboxesModality.forEach(cb => {
            cb.addEventListener('change', () => {
                registrarInteraccion();
                const val = cb.value;
                if(cb.checked) {
                    if(!state.modalidades.includes(val)) state.modalidades.push(val);
                } else {
                    state.modalidades = state.modalidades.filter(m => m !== val);
                }
                updateCheckboxUI();
                filtrarOfertas();
            });
        });

        // Reseteo Completo (Retorna al estado inicial vacío sin país)
        btnLimpiar.addEventListener('click', () => {
            state.search = '';
            state.departamento = 'Todos';
            state.areas = [];
            state.modalidades = [];
            state.hasInteracted = false;

            searchInput.value = '';
            selectDept.value = 'Todos';
            
            areaButtons.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                btn.classList.add('bg-slate-50', 'text-slate-600');
                btn.querySelector('[data-lucide="check"]').classList.add('hidden');
            });

            checkboxesModality.forEach(cb => cb.checked = false);
            updateCheckboxUI();
            filtrarOfertas();
        });
    </script>
</body>
</html>

