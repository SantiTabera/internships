<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | InternConnect</title>
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
                <i data-lucide="shield-check" class="text-white w-6 h-6"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">InternConnect <span class="text-[#2b6df2] text-xs tracking-normal font-bold bg-blue-50 px-2 py-0.5 rounded-md ml-1 align-middle">ADMIN</span></span>
        </a>
        
        <nav class="flex items-center gap-6">
            <a href="index" class="text-slate-500 font-semibold hover:text-[#2b6df2] transition">Home</a>
            <a href="explora" class="text-slate-500 font-semibold hover:text-[#2b6df2] transition">Explora</a>
            <div class="flex items-center gap-2 pl-4 border-l border-slate-200">
                <div class="w-9 h-9 bg-slate-900 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                    AD
                </div>
                <span class="text-sm font-bold text-slate-700 hidden md:inline">Administrador</span>
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
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    Panel de Control
                </button>
                <button data-tab="usuarios" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Control de Usuarios
                    <span class="ml-auto bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-full font-bold">142</span>
                </button>
                <button data-tab="convenios" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    Validar Convenios
                    <span id="badge-convenios" class="ml-auto bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full font-bold">1</span>
                </button>
                <button data-tab="mantenimiento" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Mantenimiento / Logs
                </button>
            </aside>

            <div class="flex-1">
                
                <section id="inicio" class="tab-content active space-y-8">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Consola del Sistema InternConnect 🛠️</h1>
                            <p class="text-sm text-slate-500 mt-1">Gestión global de la infraestructura de pasantías y reportabilidad.</p>
                        </div>
                        <div class="flex items-center gap-2 bg-green-50 text-green-700 px-4 py-2 rounded-xl text-xs font-extrabold border border-green-100">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-1"></span> Servidores Activos
                        </div>
                    </div>

                    <div class="bg-white p-7 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                        <div>
                            <h3 class="font-bold text-slate-900 text-lg">Módulo de Reportabilidad y Auditoría</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Genera y descarga en tiempo real el balance y flujo de datos registrados.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="download-cloud" class="w-5 h-5"></i></div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">Métricas de Postulaciones</h4>
                                        <p class="text-[11px] text-slate-400 font-medium">Historial completo, tasas de rechazo y aceptación.</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <button onclick="exportReport('Postulaciones', 'Excel')" class="p-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold transition" title="Exportar a Excel">XLS</button>
                                    <button onclick="exportReport('Postulaciones', 'PDF')" class="p-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg text-xs font-bold transition" title="Exportar a PDF">PDF</button>
                                </div>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center"><i data-lucide="file-text" class="w-5 h-5"></i></div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">Convenios por Universidad</h4>
                                        <p class="text-[11px] text-slate-400 font-medium">Estado de acuerdos vigentes en Bolivia.</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <button onclick="exportReport('Convenios', 'Excel')" class="p-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold transition" title="Exportar a Excel">XLS</button>
                                    <button onclick="exportReport('Convenios', 'PDF')" class="p-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg text-xs font-bold transition" title="Exportar a PDF">PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="user" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">124</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Estudiantes Activos</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center"><i data-lucide="building-2" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">18</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Empresas Habilitadas</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center"><i data-lucide="briefcase" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">45</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Pasantías Concretadas</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="usuarios" class="tab-content space-y-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Gestión General de Cuentas</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Audita, suspende o da de baja perfiles del ecosistema.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold uppercase tracking-wider text-slate-400">
                                    <th class="p-5">Usuario</th>
                                    <th class="p-5">Tipo de Rol</th>
                                    <th class="p-5">Estado</th>
                                    <th class="p-5 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-50">
                                <tr id="user-row-1">
                                    <td class="p-5">
                                        <div class="font-bold text-slate-900">Juan Pérez</div>
                                        <div class="text-xs text-slate-400">juan.perez@universidad.edu.bo</div>
                                    </td>
                                    <td class="p-5"><span class="px-2.5 py-0.5 bg-blue-50 text-blue-700 font-bold rounded text-xs">Estudiante</span></td>
                                    <td class="p-5"><span class="text-green-600 font-bold text-xs flex items-center gap-1"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Activo</span></td>
                                    <td class="p-5 text-right">
                                        <button onclick="deleteUserRow('user-row-1')" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition" title="Suspender Usuario">
                                            <i data-lucide="user-minus" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr id="user-row-2">
                                    <td class="p-5">
                                        <div class="font-bold text-slate-900">SoftBol S.R.L.</div>
                                        <div class="text-xs text-slate-400">contacto@softbol.com.bo</div>
                                    </td>
                                    <td class="p-5"><span class="px-2.5 py-0.5 bg-indigo-50 text-indigo-700 font-bold rounded text-xs">Empresa</span></td>
                                    <td class="p-5"><span class="text-green-600 font-bold text-xs flex items-center gap-1"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Activo</span></td>
                                    <td class="p-5 text-right">
                                        <button onclick="deleteUserRow('user-row-2')" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition" title="Suspender Empresa">
                                            <i data-lucide="user-minus" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="convenios" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Convenios Universitarios en Espera</h2>
                    <div id="convenio-card" class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm space-y-4 card-neo">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center"><i data-lucide="file-text" class="w-6 h-6"></i></div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-lg">Convenio_Marco_SoftBol.pdf</h3>
                                    <p class="text-xs text-slate-400 font-bold">Solicitante: SoftBol S.R.L. • NIT: 348910021</p>
                                </div>
                            </div>
                            <button class="px-3 py-1.5 border border-slate-200 hover:bg-slate-50 font-bold text-xs text-slate-700 rounded-xl flex items-center gap-1.5"><i data-lucide="download" class="w-4 h-4"></i> Descargar Documento</button>
                        </div>
                        <div class="flex gap-3 pt-2 justify-end">
                            <button onclick="actionConvenio(false)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">Rechazar</button>
                            <button onclick="actionConvenio(true)" class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold text-xs rounded-xl shadow-md shadow-green-100 transition">Aprobar Convenio</button>
                        </div>
                    </div>
                    <div id="no-convenios" class="hidden text-center py-12 text-slate-400 font-semibold space-y-2">
                        <div class="text-4xl">🎉</div>
                        <p>No quedan solicitudes de convenios pendientes.</p>
                    </div>
                </section>

                <section id="mantenimiento" class="tab-content space-y-6">
                    <div class="flex flex-col">
                        <h2 class="text-xl font-bold text-slate-900">Operaciones de Infraestructura</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Acciones críticas de control técnico sobre la aplicación.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Modo Mantenimiento (Down)</h4>
                                <p class="text-xs text-slate-400 max-w-[240px] mt-0.5">Bloquea temporalmente el acceso público a estudiantes y empresas.</p>
                            </div>
                            <button onclick="toggleMaintenance(this)" class="w-12 h-6 bg-slate-200 rounded-full p-1 transition-colors relative duration-300">
                                <div class="w-4 h-4 bg-white rounded-full shadow-md transform duration-300"></div>
                            </button>
                        </div>
                        
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Limpieza de Caché del Sistema</h4>
                                <p class="text-xs text-slate-400 max-w-[240px] mt-0.5">Fuerza la actualización de vistas Blade y optimizaciones.</p>
                            </div>
                            <button onclick="clearCache()" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition flex items-center gap-1.5">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Ejecutar Clean
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider text-slate-400">Logs Recientes de Auditoría (Seguridad)</h3>
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
                        </div>
                        <div class="bg-slate-900 rounded-2xl p-4 font-mono text-xs text-emerald-400 space-y-2 overflow-x-auto">
                            <div>[2026-05-23 09:42:01] <span class="text-blue-400">INFO:</span> Estudiante Juan Pérez actualizó Curriculum_Juan_Perez.pdf (La Paz).</div>
                            <div>[2026-05-23 09:35:14] <span class="text-indigo-400">AUTH:</span> Inicio de sesión exitoso desde IP: 190.181.45.12 (Reclutador SoftBol).</div>
                            <div>[2026-05-23 09:12:44] <span class="text-amber-400">WARN:</span> Intento fallido de carga de archivo no permitido (.exe) por ID_User: 42.</div>
                        </div>
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
        lucide.createIcons();

        // Control de Pestañas
        const tabsMap = {
            'inicio': document.getElementById('inicio'),
            'usuarios': document.getElementById('usuarios'),
            'convenios': document.getElementById('convenios'),
            'mantenimiento': document.getElementById('mantenimiento')
        };
        const tabButtons = document.querySelectorAll('.tab-btn');

        function goToTab(tabKey) {
            const button = document.querySelector(`[data-tab="${tabKey}"]`);
            if(button) button.click();
        }

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

        // Simulación: Descarga y exportación de reportes
        function exportReport(reportName, format) {
            alert(`Generando reporte macro de "${reportName}" en formato ${format}...\nDescarga iniciada de forma simulada.`);
        }

        // Simulación: Borrar usuario (CRUD Delete)
        function deleteUserRow(rowId) {
            if(confirm('¿Suspender definitivamente este usuario del sistema?')) {
                document.getElementById(rowId).remove();
            }
        }

        // Simulación: Procesamiento de convenios
        function actionConvenio(isApproved) {
            alert(isApproved ? 'Convenio verificado y aprobado legalmente.' : 'Convenio rechazado.');
            document.getElementById('convenio-card').remove();
            document.getElementById('no-convenios').classList.remove('hidden');
            document.getElementById('badge-convenios').remove();
        }

        // Toggle del Modo Mantenimiento
        function toggleMaintenance(btn) {
            const circle = btn.querySelector('div');
            if (btn.classList.contains('bg-slate-200')) {
                if(confirm('¿Quieres activar el Mantenimiento Global? Los usuarios públicos verán una pantalla de bloqueo.')) {
                    btn.classList.replace('bg-slate-200', 'bg-red-500');
                    circle.classList.add('translate-x-6');
                }
            } else {
                btn.classList.replace('bg-red-500', 'bg-slate-200');
                circle.classList.remove('translate-x-6');
                alert('Sistema restaurado a modo público.');
            }
        }

        // Limpieza de Caché
        function clearCache() {
            alert('Ejecutando de forma simulada:\nphp artisan cache:clear\nphp artisan view:clear\n\n¡Caché de InternConnect vaciada con éxito!');
        }
    </script>
</body>
</html>
