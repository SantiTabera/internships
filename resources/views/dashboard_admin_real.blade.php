<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(14, 165, 233, 0.18), transparent 28%),
                radial-gradient(circle at top right, rgba(99, 102, 241, 0.12), transparent 24%),
                linear-gradient(180deg, #f8fbff 0%, #f3f7fb 100%);
        }

        .card-neo {
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            border: 1px solid rgba(226, 232, 240, 0.9);
        }

        .card-neo:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -22px rgba(15, 23, 42, 0.35);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body class="min-h-screen text-slate-900">
    @php
        $activeTab = $activeTab ?? request('tab', 'resumen');
        $maxRoleUsers = max((int) $roles->max('usuarios_count'), 1);
    @endphp

    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
        <div class="max-w-[1480px] mx-auto px-6 lg:px-10 h-20 flex items-center justify-between gap-6">
            <a href="{{ route('index') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-slate-900 text-white flex items-center justify-center shadow-lg shadow-slate-900/10 group-hover:rotate-6 transition-transform">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="font-black tracking-tight text-lg leading-none">InternConnect</div>
                    <div class="text-[11px] uppercase tracking-[0.24em] text-sky-600 font-bold mt-1">Panel Admin</div>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <div class="hidden md:flex items-center gap-3 px-4 py-2 rounded-2xl bg-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-slate-900 text-white flex items-center justify-center text-sm font-black">AD</div>
                    <div>
                        <p class="text-sm font-bold leading-none">Administrador</p>
                        <p class="text-xs text-slate-500 mt-1">Acceso total al sistema</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-[1480px] mx-auto px-6 lg:px-10 py-8 lg:py-10">
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-800">
                <p class="font-bold">Revisa el formulario</p>
                <ul class="mt-2 list-disc pl-5 text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-800 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-800 font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-[260px_1fr] gap-6 lg:gap-8">
            <aside class="space-y-3">
                <button data-tab="resumen" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-left transition bg-slate-900 text-white shadow-lg shadow-slate-900/10">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Resumen
                </button>
                <button data-tab="usuarios" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-left transition text-slate-600 hover:bg-white/80 card-neo bg-white/70">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Usuarios
                </button>
                <button data-tab="ofertas" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-left transition text-slate-600 hover:bg-white/80 card-neo bg-white/70">
                    <i data-lucide="briefcase-business" class="w-5 h-5"></i>
                    Ofertas
                </button>
                <button data-tab="reportes" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-left transition text-slate-600 hover:bg-white/80 card-neo bg-white/70">
                    <i data-lucide="download" class="w-5 h-5"></i>
                    Reportes
                </button>
                <button data-tab="auditoria" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-left transition text-slate-600 hover:bg-white/80 card-neo bg-white/70">
                    <i data-lucide="history" class="w-5 h-5"></i>
                    Auditoria
                </button>
            </aside>

            <section class="space-y-6 lg:space-y-8">
                <section id="resumen" class="tab-content active space-y-6">
                    <div class="bg-slate-950 text-white rounded-[2rem] p-7 lg:p-10 overflow-hidden relative">
                        <div class="absolute inset-0 opacity-30 bg-[radial-gradient(circle_at_top_right,_rgba(56,189,248,0.35),_transparent_32%),radial-gradient(circle_at_bottom_left,_rgba(59,130,246,0.3),_transparent_28%)]"></div>
                        <div class="relative flex flex-col lg:flex-row gap-6 lg:items-end lg:justify-between">
                            <div class="max-w-2xl">
                                <p class="text-[11px] uppercase tracking-[0.28em] text-sky-300 font-bold">Operacion en vivo</p>
                                <h1 class="mt-3 text-3xl lg:text-5xl font-black tracking-tight leading-tight">Consola administrativa con datos reales</h1>
                                <p class="mt-4 text-slate-300 text-sm lg:text-base max-w-xl">Gestiona usuarios, ofertas y reportes exportables leyendo directamente la base de datos.</p>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('dashboard.admin.reports.download', ['report' => 'users']) }}" class="px-4 py-3 rounded-2xl bg-white text-slate-950 font-bold text-sm hover:bg-slate-100 transition">Exportar usuarios</a>
                                <a href="{{ route('dashboard.admin.reports.download', ['report' => 'offers']) }}" class="px-4 py-3 rounded-2xl bg-sky-500 text-white font-bold text-sm hover:bg-sky-400 transition">Exportar ofertas</a>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-5">
                        <article class="bg-white rounded-[1.75rem] p-6 card-neo">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Usuarios</p>
                                    <h3 class="mt-2 text-3xl font-black">{{ number_format($stats['total_users']) }}</h3>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center"><i data-lucide="users" class="w-6 h-6"></i></div>
                            </div>
                            <p class="mt-4 text-sm text-slate-500">{{ number_format($stats['active_users']) }} activos, {{ number_format($stats['admins']) }} administradores</p>
                        </article>

                        <article class="bg-white rounded-[1.75rem] p-6 card-neo">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Ofertas</p>
                                    <h3 class="mt-2 text-3xl font-black">{{ number_format($stats['total_offers']) }}</h3>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center"><i data-lucide="briefcase-business" class="w-6 h-6"></i></div>
                            </div>
                            <p class="mt-4 text-sm text-slate-500">{{ number_format($stats['active_offers']) }} vigentes por fecha</p>
                        </article>

                        <article class="bg-white rounded-[1.75rem] p-6 card-neo">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Postulaciones</p>
                                    <h3 class="mt-2 text-3xl font-black">{{ number_format($stats['total_applications']) }}</h3>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center"><i data-lucide="file-text" class="w-6 h-6"></i></div>
                            </div>
                            <p class="mt-4 text-sm text-slate-500">Promedio TOPSIS: {{ $stats['average_topsis'] !== null ? number_format($stats['average_topsis'], 2) : 'N/D' }}</p>
                        </article>

                        <article class="bg-white rounded-[1.75rem] p-6 card-neo">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Empresas verificadas</p>
                                    <h3 class="mt-2 text-3xl font-black">{{ number_format($stats['verified_companies']) }}</h3>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center"><i data-lucide="badge-check" class="w-6 h-6"></i></div>
                            </div>
                            <p class="mt-4 text-sm text-slate-500">{{ number_format($stats['pending_companies']) }} empresas pendientes</p>
                        </article>
                    </div>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                        <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                            <div class="flex items-center justify-between mb-5">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Distribucion por rol</p>
                                    <h2 class="text-xl font-black mt-1">Usuarios por segmento</h2>
                                </div>
                                <i data-lucide="pie-chart" class="w-6 h-6 text-slate-400"></i>
                            </div>
                            <div class="space-y-4">
                                @foreach($roles as $role)
                                    @php $width = ($role->usuarios_count / $maxRoleUsers) * 100; @endphp
                                    <div>
                                        <div class="flex items-center justify-between text-sm mb-2">
                                            <span class="font-semibold text-slate-700">{{ $role->nombre }}</span>
                                            <span class="text-slate-500">{{ number_format($role->usuarios_count) }}</span>
                                        </div>
                                        <div class="h-3 rounded-full bg-slate-100 overflow-hidden">
                                            <div class="h-full rounded-full bg-gradient-to-r from-sky-500 to-indigo-500" style="width: {{ $width }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                            <div class="flex items-center justify-between mb-5">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Estados reales</p>
                                    <h2 class="text-xl font-black mt-1">Ofertas y postulaciones</h2>
                                </div>
                                <i data-lucide="activity" class="w-6 h-6 text-slate-400"></i>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-slate-200 p-4">
                                    <p class="text-sm font-bold text-slate-700 mb-3">Ofertas</p>
                                    <div class="space-y-3">
                                        @forelse($publicationStates as $state)
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-slate-600">{{ $state->nombre }}</span>
                                                <span class="font-bold text-slate-900">{{ number_format($state->ofertas_pasantia_count) }}</span>
                                            </div>
                                        @empty
                                            <p class="text-sm text-slate-400">No hay estados registrados.</p>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="rounded-2xl border border-slate-200 p-4">
                                    <p class="text-sm font-bold text-slate-700 mb-3">Postulaciones</p>
                                    <div class="space-y-3">
                                        @forelse($applicationStates as $state)
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-slate-600">{{ $state->nombre }}</span>
                                                <span class="font-bold text-slate-900">{{ number_format($state->postulaciones_count) }}</span>
                                            </div>
                                        @empty
                                            <p class="text-sm text-slate-400">No hay estados registrados.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="usuarios" class="tab-content space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">CRUD real</p>
                                <h2 class="text-2xl font-black mt-1">Usuarios del sistema</h2>
                                <p class="text-sm text-slate-500 mt-2">Crear, editar, desactivar y eliminar cuentas con datos persistidos en la base.</p>
                            </div>
                            <a href="{{ route('dashboard.admin.reports.download', ['report' => 'users']) }}" class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800 transition">
                                <i data-lucide="download" class="w-4 h-4"></i> Descargar CSV
                            </a>
                        </div>

                        <form method="POST" action="{{ route('dashboard.admin.users.store') }}" class="mt-6 grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
                            @csrf
                            <input name="nombre" value="{{ old('nombre') }}" placeholder="Nombres" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <input name="apellido_paterno" value="{{ old('apellido_paterno') }}" placeholder="Apellido paterno" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <input name="apellido_materno" value="{{ old('apellido_materno') }}" placeholder="Apellido materno" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <input name="correo" value="{{ old('correo') }}" placeholder="correo@dominio.com" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <input name="contrasena" type="password" placeholder="Contraseña" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <input name="contrasena_confirmation" type="password" placeholder="Confirmar contraseña" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <select name="rol_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                <option value="">Selecciona rol</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @selected(old('rol_id') == $role->id)>{{ $role->nombre }}</option>
                                @endforeach
                            </select>
                            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700">
                                <input type="checkbox" name="activo" value="1" @checked(old('activo', true))>
                                Usuario activo
                            </label>

                            <div class="lg:col-span-2 xl:col-span-3 grid gap-4 xl:grid-cols-3">
                                <input name="universidad" value="{{ old('universidad') }}" placeholder="Universidad (si es estudiante)" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                <input name="carrera" value="{{ old('carrera') }}" placeholder="Carrera (si es estudiante)" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                <input name="anio_graduacion" value="{{ old('anio_graduacion') }}" placeholder="Año de graduacion" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                            </div>

                            <div class="lg:col-span-2 xl:col-span-3 grid gap-4 xl:grid-cols-4">
                                <input name="nombre_empresa" value="{{ old('nombre_empresa') }}" placeholder="Empresa (si es empresa)" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                <input name="industria" value="{{ old('industria') }}" placeholder="Industria" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                <input name="sitio_web" value="{{ old('sitio_web') }}" placeholder="https://sitio-web.com" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700">
                                    <input type="checkbox" name="verificada" value="1" @checked(old('verificada'))>
                                    Empresa verificada
                                </label>
                            </div>

                            <div class="lg:col-span-2 xl:col-span-3 flex justify-end">
                                <button class="px-5 py-3 rounded-2xl bg-sky-600 text-white font-bold text-sm hover:bg-sky-500 transition">Crear usuario</button>
                            </div>
                        </form>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-xl font-black">Estudiantes</h3>
                        @forelse($students as $user)
                            @include('dashboard_admin_real._user_row', ['user' => $user])
                        @empty
                            <div class="bg-white rounded-[1.75rem] card-neo p-8 text-center text-slate-500">No hay estudiantes para mostrar.</div>
                        @endforelse

                        <div>{{ $students->links() }}</div>

                        <h3 class="text-xl font-black">Empresas</h3>
                        @forelse($companyUsers as $user)
                            @include('dashboard_admin_real._user_row', ['user' => $user])
                        @empty
                            <div class="bg-white rounded-[1.75rem] card-neo p-8 text-center text-slate-500">No hay empresas para mostrar.</div>
                        @endforelse

                        <div>{{ $companyUsers->links() }}</div>

                        <h3 class="text-xl font-black">Administradores</h3>
                        @forelse($adminUsers as $user)
                            @include('dashboard_admin_real._user_row', ['user' => $user])
                        @empty
                            <div class="bg-white rounded-[1.75rem] card-neo p-8 text-center text-slate-500">No hay administradores para mostrar.</div>
                        @endforelse

                        <div>{{ $adminUsers->links() }}</div>
                    </div>
                </section>

                <section id="ofertas" class="tab-content space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">CRUD real</p>
                                <h2 class="text-2xl font-black mt-1">Ofertas de pasantia</h2>
                                <p class="text-sm text-slate-500 mt-2">Gestiona el catalogo publicado por empresas desde la base de datos.</p>
                            </div>
                            <a href="{{ route('dashboard.admin.reports.download', ['report' => 'offers']) }}" class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800 transition">
                                <i data-lucide="download" class="w-4 h-4"></i> Descargar CSV
                            </a>
                        </div>

                        <form method="POST" action="{{ route('dashboard.admin.offers.store') }}" class="mt-6 grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
                            @csrf
                            <select name="perfil_empresa_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                <option value="">Selecciona empresa</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->nombre_empresa }} · {{ $company->usuario?->nombre_completo }}</option>
                                @endforeach
                            </select>
                            <select name="ubicacion_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                <option value="">Selecciona ubicacion</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->ciudad }}{{ $location->region ? ', ' . $location->region : '' }}{{ $location->pais ? ', ' . $location->pais : '' }}</option>
                                @endforeach
                            </select>
                            <select name="estado_publicacion_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                <option value="">Selecciona estado</option>
                                @foreach($publicationStates as $state)
                                    <option value="{{ $state->id }}">{{ $state->nombre }}</option>
                                @endforeach
                            </select>
                            <input name="titulo" value="{{ old('titulo') }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Titulo de la oferta" required>
                            <input name="fecha_inicio" type="date" value="{{ old('fecha_inicio') }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                            <input name="fecha_fin" type="date" value="{{ old('fecha_fin') }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                            <textarea name="descripcion" rows="4" class="lg:col-span-2 xl:col-span-3 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Descripcion" required>{{ old('descripcion') }}</textarea>
                            <div class="lg:col-span-2 xl:col-span-3 flex justify-end">
                                <button class="px-5 py-3 rounded-2xl bg-sky-600 text-white font-bold text-sm hover:bg-sky-500 transition">Crear oferta</button>
                            </div>
                        </form>
                    </div>

                    <div class="space-y-4">
                        @forelse($offers as $offer)
                            <details class="bg-white rounded-[1.75rem] card-neo overflow-hidden" @if($loop->first) open @endif>
                                <summary class="cursor-pointer list-none px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                                    <div>
                                        <div class="flex items-center gap-3 flex-wrap">
                                            <h3 class="text-lg font-black">{{ $offer->titulo }}</h3>
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">#{{ $offer->id }}</span>
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700">{{ $offer->estadoPublicacion?->nombre ?? 'Sin estado' }}</span>
                                        </div>
                                        <p class="text-sm text-slate-500 mt-2">{{ $offer->perfilEmpresa?->nombre_empresa ?? 'Sin empresa' }} · {{ $offer->ubicacion ? $offer->ubicacion->ciudad . ', ' . $offer->ubicacion->pais : 'Sin ubicacion' }} · {{ number_format($offer->postulaciones_count) }} postulaciones</p>
                                    </div>
                                    <div class="text-sm text-slate-500 font-semibold">Editar y eliminar</div>
                                </summary>

                                <div class="border-t border-slate-100 px-6 py-5">
                                    <form method="POST" action="{{ route('dashboard.admin.offers.update', $offer) }}" class="grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
                                        @csrf
                                        @method('PUT')
                                        <select name="perfil_empresa_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" @selected((int) old('perfil_empresa_id', $offer->perfil_empresa_id) === (int) $company->id)>{{ $company->nombre_empresa }} · {{ $company->usuario?->nombre_completo }}</option>
                                            @endforeach
                                        </select>
                                        <select name="ubicacion_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" @selected((int) old('ubicacion_id', $offer->ubicacion_id) === (int) $location->id)>{{ $location->ciudad }}{{ $location->region ? ', ' . $location->region : '' }}{{ $location->pais ? ', ' . $location->pais : '' }}</option>
                                            @endforeach
                                        </select>
                                        <select name="estado_publicacion_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                            @foreach($publicationStates as $state)
                                                <option value="{{ $state->id }}" @selected((int) old('estado_publicacion_id', $offer->estado_publicacion_id) === (int) $state->id)>{{ $state->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <input name="titulo" value="{{ old('titulo', $offer->titulo) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                        <input name="fecha_inicio" type="date" value="{{ old('fecha_inicio', optional($offer->fecha_inicio)->format('Y-m-d')) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                        <input name="fecha_fin" type="date" value="{{ old('fecha_fin', optional($offer->fecha_fin)->format('Y-m-d')) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                        <textarea name="descripcion" rows="4" class="lg:col-span-2 xl:col-span-3 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>{{ old('descripcion', $offer->descripcion) }}</textarea>
                                        <div class="lg:col-span-2 xl:col-span-3 flex flex-col sm:flex-row gap-3 justify-end">
                                            <button class="px-5 py-3 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800 transition">Guardar cambios</button>
                                        </div>
                                    </form>

                                    <form method="POST" action="{{ route('dashboard.admin.offers.destroy', $offer) }}" class="mt-4">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-5 py-3 rounded-2xl bg-rose-50 text-rose-700 font-bold text-sm hover:bg-rose-100 transition">Eliminar oferta</button>
                                    </form>
                                </div>
                            </details>
                        @empty
                            <div class="bg-white rounded-[1.75rem] card-neo p-8 text-center text-slate-500">No hay ofertas para mostrar.</div>
                        @endforelse
                    </div>

                    <div>{{ $offers->links() }}</div>
                </section>

                <section id="reportes" class="tab-content space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Exportacion real</p>
                        <h2 class="text-2xl font-black mt-1">Reportes descargables</h2>
                        <p class="text-sm text-slate-500 mt-2">Cada boton descarga un CSV generado directamente desde la base de datos.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="{{ route('dashboard.admin.reports.download', ['report' => 'users']) }}" class="bg-white rounded-[1.75rem] p-6 card-neo flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-black">Usuarios</h3>
                                <p class="text-sm text-slate-500 mt-1">Cuenta, rol, estado y perfil asociado.</p>
                            </div>
                            <i data-lucide="download" class="w-6 h-6 text-sky-600"></i>
                        </a>
                        <a href="{{ route('dashboard.admin.reports.download', ['report' => 'offers']) }}" class="bg-white rounded-[1.75rem] p-6 card-neo flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-black">Ofertas</h3>
                                <p class="text-sm text-slate-500 mt-1">Empresa, ubicacion, estado y volumen de postulaciones.</p>
                            </div>
                            <i data-lucide="download" class="w-6 h-6 text-indigo-600"></i>
                        </a>
                        <a href="{{ route('dashboard.admin.reports.download', ['report' => 'applications']) }}" class="bg-white rounded-[1.75rem] p-6 card-neo flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-black">Postulaciones</h3>
                                <p class="text-sm text-slate-500 mt-1">Postulante, empresa, estado y puntaje TOPSIS.</p>
                            </div>
                            <i data-lucide="download" class="w-6 h-6 text-emerald-600"></i>
                        </a>
                        <a href="{{ route('dashboard.admin.reports.download', ['report' => 'audits']) }}" class="bg-white rounded-[1.75rem] p-6 card-neo flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-black">Auditoria</h3>
                                <p class="text-sm text-slate-500 mt-1">Actividades, entidades y marcas de tiempo del sistema.</p>
                            </div>
                            <i data-lucide="download" class="w-6 h-6 text-amber-600"></i>
                        </a>
                        <a href="{{ route('dashboard.admin.reports.download', ['report' => 'changes']) }}" class="bg-white rounded-[1.75rem] p-6 card-neo flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-black">Cambios detallados</h3>
                                <p class="text-sm text-slate-500 mt-1">Cada campo modificado con antes, después y fecha exacta.</p>
                            </div>
                            <i data-lucide="file-spreadsheet" class="w-6 h-6 text-rose-600"></i>
                        </a>
                    </div>
                </section>

                <section id="auditoria" class="tab-content space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Registro vivo</p>
                        <h2 class="text-2xl font-black mt-1">Ultimos eventos del sistema</h2>
                        <p class="text-sm text-slate-500 mt-2">Se consumen desde la tabla de auditoria, no desde datos simulados.</p>
                    </div>

                    <div class="bg-white rounded-[1.75rem] p-6 card-neo space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Auditoria por modulo</p>
                                <h3 class="text-xl font-black mt-1 text-slate-900">Ofertas</h3>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700">{{ $offerAudits->count() }} eventos</span>
                        </div>

                        <div class="space-y-4">
                            @forelse($offerAudits as $audit)
                                @php
                                    $changes = collect($audit->detalles ?? []);
                                @endphp
                                <article class="rounded-2xl border border-slate-200 p-5 space-y-4 bg-slate-50/60">
                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center gap-3 flex-wrap">
                                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">#{{ $audit->id }}</span>
                                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700">Oferta #{{ $audit->entidad_id ?? 'N/D' }}</span>
                                            </div>
                                            <h4 class="font-black text-lg leading-tight text-slate-900">{{ $audit->accion }}</h4>
                                            <p class="text-sm text-slate-500">{{ $audit->usuario?->nombre_completo ?? 'Sistema' }} · {{ $audit->tipoEntidad?->nombre ?? 'ofertas_pasantia' }}</p>
                                        </div>
                                        <div class="text-sm font-semibold text-slate-500 lg:text-right">{{ optional($audit->creado_en)->format('Y-m-d H:i:s') }}</div>
                                    </div>

                                    @if($changes->isNotEmpty())
                                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                                            <div class="grid grid-cols-1 md:grid-cols-3 bg-slate-50 px-4 py-3 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                                                <div>Campo</div>
                                                <div>Antes</div>
                                                <div>Después</div>
                                            </div>
                                            @foreach($changes as $change)
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 px-4 py-3 border-t border-slate-100 text-sm">
                                                    <div class="font-semibold text-slate-700">{{ $change['field'] ?? 'Campo' }}</div>
                                                    <div class="text-slate-500">{{ $change['before'] ?? 'N/D' }}</div>
                                                    <div class="font-medium text-slate-900">{{ $change['after'] ?? 'N/D' }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </article>
                            @empty
                                <div class="rounded-2xl border border-dashed border-slate-200 p-6 text-center text-slate-500">No hay auditoria de ofertas registrada todavía.</div>
                            @endforelse
                        </div>
                    </div>

                    @php
                        $auditGroups = collect([
                            'usuarios' => 'Cuentas',
                            'ofertas_pasantia' => 'Ofertas',
                            'reportes' => 'Reportes',
                        ]);

                        $groupedAudits = $recentAudits
                            ->groupBy(fn ($audit) => $audit->tipoEntidad?->nombre ?? 'Sin entidad')
                            ->sortKeysUsing(function ($a, $b) use ($auditGroups) {
                                $orderA = array_search($a, $auditGroups->keys()->all(), true);
                                $orderB = array_search($b, $auditGroups->keys()->all(), true);

                                $orderA = $orderA === false ? PHP_INT_MAX : $orderA;
                                $orderB = $orderB === false ? PHP_INT_MAX : $orderB;

                                return $orderA <=> $orderB;
                            });
                    @endphp

                    <div class="space-y-8">
                        @forelse($groupedAudits as $groupKey => $audits)
                            <section class="space-y-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">{{ $auditGroups->get($groupKey, ucfirst($groupKey)) }}</p>
                                        <h3 class="text-xl font-black mt-1 text-slate-900">{{ $auditGroups->get($groupKey, ucfirst($groupKey)) }}</h3>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">{{ $audits->count() }} eventos</span>
                                </div>

                                <div class="space-y-4">
                                    @foreach($audits as $audit)
                                        @php
                                            $changes = collect($audit->detalles ?? []);
                                        @endphp
                                        <article class="bg-white rounded-[1.75rem] p-5 card-neo space-y-4">
                                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                                <div class="space-y-2">
                                                    <div class="flex items-center gap-3 flex-wrap">
                                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">#{{ $audit->id }}</span>
                                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700">{{ $audit->tipoEntidad?->nombre ?? 'Entidad no definida' }} #{{ $audit->entidad_id ?? 'N/D' }}</span>
                                                    </div>
                                                    <h4 class="font-black text-lg leading-tight text-slate-900">{{ $audit->accion }}</h4>
                                                    <p class="text-sm text-slate-500">{{ $audit->usuario?->nombre_completo ?? 'Sistema' }} · {{ $audit->tipoEntidad?->nombre ?? 'Entidad no definida' }}</p>
                                                </div>
                                                <div class="text-sm font-semibold text-slate-500 lg:text-right">{{ optional($audit->creado_en)->format('Y-m-d H:i:s') }}</div>
                                            </div>

                                            @if($changes->isNotEmpty())
                                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                                    <div class="grid grid-cols-1 md:grid-cols-3 bg-slate-50 px-4 py-3 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                                                        <div>Campo</div>
                                                        <div>Antes</div>
                                                        <div>Después</div>
                                                    </div>
                                                    @foreach($changes as $change)
                                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 px-4 py-3 border-t border-slate-100 text-sm">
                                                            <div class="font-semibold text-slate-700">{{ $change['field'] ?? 'Campo' }}</div>
                                                            <div class="text-slate-500">{{ $change['before'] ?? 'N/D' }}</div>
                                                            <div class="font-medium text-slate-900">{{ $change['after'] ?? 'N/D' }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </article>
                                    @endforeach
                                </div>
                            </section>
                        @empty
                            <div class="bg-white rounded-[1.75rem] card-neo p-8 text-center text-slate-500">No hay registros de auditoria.</div>
                        @endforelse
                    </div>
                </section>
            </section>
        </div>
    </main>

    <script>
        lucide.createIcons();

        const initialTab = @json($activeTab);
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabSections = document.querySelectorAll('.tab-content');

        function activateTab(tabKey) {
            tabSections.forEach(section => section.classList.remove('active'));
            const targetSection = document.getElementById(tabKey);
            if (targetSection) {
                targetSection.classList.add('active');
            }

            tabButtons.forEach(button => {
                const active = button.getAttribute('data-tab') === tabKey;
                button.classList.toggle('bg-slate-900', active);
                button.classList.toggle('text-white', active);
                button.classList.toggle('shadow-lg', active);
                button.classList.toggle('shadow-slate-900/10', active);
                button.classList.toggle('bg-white/70', !active);
                button.classList.toggle('text-slate-600', !active);
                button.classList.toggle('font-semibold', !active);
                button.classList.toggle('card-neo', !active);
                button.classList.toggle('hover:bg-white/80', !active);
            });
        }

        tabButtons.forEach(button => {
            button.addEventListener('click', () => activateTab(button.getAttribute('data-tab')));
        });

        function configureUserFormByRole(form) {
            const roleSelect = form.querySelector('select[name="rol_id"]');
            if (!roleSelect) {
                return;
            }

            const studentFields = [
                form.querySelector('input[name="universidad"]'),
                form.querySelector('input[name="carrera"]'),
            ].filter(Boolean);

            const companyFields = [
                form.querySelector('input[name="nombre_empresa"]'),
                form.querySelector('input[name="industria"]'),
            ].filter(Boolean);

            const websiteField = form.querySelector('input[name="sitio_web"]');
            const verifiedCheckbox = form.querySelector('input[name="verificada"]');

            const applyRules = () => {
                const roleId = Number(roleSelect.value || 0);
                const isStudent = roleId === 1;
                const isCompany = roleId === 2;

                studentFields.forEach((field) => {
                    field.required = isStudent;
                    field.closest('div, label, input')?.classList.toggle('opacity-60', !isStudent);
                });

                companyFields.forEach((field) => {
                    field.required = isCompany;
                    field.closest('div, label, input')?.classList.toggle('opacity-60', !isCompany);
                });

                if (websiteField) {
                    websiteField.closest('div, label, input')?.classList.toggle('opacity-60', !isCompany);
                }

                if (verifiedCheckbox) {
                    verifiedCheckbox.disabled = !isCompany;
                    if (!isCompany) {
                        verifiedCheckbox.checked = false;
                    }
                }
            };

            roleSelect.addEventListener('change', applyRules);
            applyRules();
        }

        document.querySelectorAll('form[action*="/dashboard/admin/usuarios"]').forEach(configureUserFormByRole);

        activateTab(initialTab);
    </script>
</body>
</html>
