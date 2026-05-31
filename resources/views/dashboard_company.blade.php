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
            transition: all 0.25s ease;
            border: 1px solid rgba(226, 232, 240, 0.9);
        }
        .card-neo:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 22px -14px rgba(15, 23, 42, 0.35);
        }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="text-slate-900 min-h-screen">
    @php
        $initials = collect(explode(' ', $companyProfile->nombre_empresa ?? 'EM'))
            ->filter()
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->take(2)
            ->implode('');
        $activeTab = $activeTab ?? request('tab', 'inicio');
    @endphp

    <header class="sticky top-0 z-50 bg-white border-b border-slate-200/80 backdrop-blur">
        <div class="max-w-[1400px] mx-auto px-[6%] py-4 flex justify-between items-center">
            <a href="{{ route('index') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center">
                    <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight">InternConnect</span>
            </a>

            <nav class="flex items-center gap-4">
                <a href="{{ route('index') }}" class="text-slate-500 font-semibold hover:text-slate-900">Home</a>
                <a href="{{ route('explora') }}" class="text-slate-500 font-semibold hover:text-slate-900">Explora</a>
                <div class="flex items-center gap-2 pl-4 border-l border-slate-200">
                    <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">{{ strtoupper($initials ?: 'EM') }}</div>
                    <span class="font-bold text-sm hidden md:inline">{{ $companyProfile->nombre_empresa }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="pl-4 border-l border-slate-200">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Cerrar sesión
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="max-w-[1400px] mx-auto px-[6%] py-8">
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-800">
                <p class="font-bold">Revisa los datos del formulario</p>
                <ul class="mt-2 text-sm list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-800 font-semibold">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-800 font-semibold">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-6">
            <aside class="space-y-2">
                <button data-tab="inicio" class="tab-btn w-full text-left px-4 py-3 rounded-2xl font-bold bg-blue-600 text-white">Panel de control</button>
                <button data-tab="ofertas" class="tab-btn w-full text-left px-4 py-3 rounded-2xl font-semibold text-slate-600 bg-white card-neo">Gestionar ofertas</button>
                <button data-tab="postulantes" class="tab-btn w-full text-left px-4 py-3 rounded-2xl font-semibold text-slate-600 bg-white card-neo">Postulantes</button>
                <button data-tab="perfil" class="tab-btn w-full text-left px-4 py-3 rounded-2xl font-semibold text-slate-600 bg-white card-neo">Perfil de empresa</button>
            </aside>

            <section class="space-y-6">
                <section id="inicio" class="tab-content active space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-7 card-neo">
                        <h1 class="text-2xl md:text-3xl font-black tracking-tight">Bienvenida, {{ $companyProfile->nombre_empresa }}.</h1>
                        <p class="text-sm text-slate-500 mt-2">Gestiona tus ofertas y revisa postulaciones desde un panel conectado a datos reales.</p>
                        <p class="text-sm text-slate-500 mt-1">Sector: {{ $companyProfile->industria ?: 'N/D' }} · Web: {{ $companyProfile->sitio_web ?: 'N/D' }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                        <article class="bg-white rounded-[1.5rem] p-5 card-neo">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">Ofertas totales</p>
                            <h3 class="text-3xl font-black mt-2">{{ $stats['total_offers'] }}</h3>
                        </article>
                        <article class="bg-white rounded-[1.5rem] p-5 card-neo">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">Ofertas activas</p>
                            <h3 class="text-3xl font-black mt-2">{{ $stats['active_offers'] }}</h3>
                        </article>
                        <article class="bg-white rounded-[1.5rem] p-5 card-neo">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">Postulaciones</p>
                            <h3 class="text-3xl font-black mt-2">{{ $stats['total_applications'] }}</h3>
                        </article>
                        <article class="bg-white rounded-[1.5rem] p-5 card-neo">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">Pendientes</p>
                            <h3 class="text-3xl font-black mt-2">{{ $stats['pending_applications'] }}</h3>
                        </article>
                    </div>
                </section>

                <section id="ofertas" class="tab-content space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                        <h2 class="text-2xl font-black">Crear nueva oferta</h2>
                        <form method="POST" action="{{ route('dashboard.company.offers.store') }}" class="mt-5 grid gap-4 md:grid-cols-2">
                            @csrf
                            <input name="titulo" value="{{ old('titulo') }}" placeholder="Título" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <select name="ubicacion_id" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                <option value="">Ubicación</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" @selected((int) old('ubicacion_id') === (int) $location->id)>{{ $location->ciudad }}{{ $location->region ? ', ' . $location->region : '' }}{{ $location->pais ? ', ' . $location->pais : '' }}</option>
                                @endforeach
                            </select>
                            <select name="estado_publicacion_id" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                <option value="">Estado de publicación</option>
                                @foreach($publicationStates as $state)
                                    <option value="{{ $state->id }}" @selected((int) old('estado_publicacion_id') === (int) $state->id)>{{ $state->nombre }}</option>
                                @endforeach
                            </select>
                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm md:col-span-2">
                            <textarea name="descripcion" rows="4" placeholder="Descripción" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm md:col-span-2" required>{{ old('descripcion') }}</textarea>
                            <div class="md:col-span-2 flex justify-end">
                                <button class="px-5 py-3 rounded-xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-500">Publicar oferta</button>
                            </div>
                        </form>
                    </div>

                    <div class="space-y-4">
                        @forelse($offers as $offer)
                            <details class="bg-white rounded-[1.75rem] card-neo p-6" @if($loop->first) open @endif>
                                <summary class="cursor-pointer list-none flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <h3 class="text-lg font-black">{{ $offer->titulo }}</h3>
                                        <p class="text-sm text-slate-500">{{ $offer->ubicacion?->ciudad ?? 'Sin ubicación' }} · {{ $offer->estadoPublicacion?->nombre ?? 'Sin estado' }} · {{ $offer->postulaciones_count }} postulaciones</p>
                                    </div>
                                    <span class="text-xs font-bold bg-slate-100 text-slate-600 px-3 py-1 rounded-full">#{{ $offer->id }}</span>
                                </summary>

                                <form method="POST" action="{{ route('dashboard.company.offers.update', $offer) }}" class="mt-5 grid gap-4 md:grid-cols-2">
                                    @csrf
                                    @method('PUT')
                                    <input name="titulo" value="{{ old('titulo', $offer->titulo) }}" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                    <select name="ubicacion_id" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" @selected((int) old('ubicacion_id', $offer->ubicacion_id) === (int) $location->id)>{{ $location->ciudad }}{{ $location->region ? ', ' . $location->region : '' }}{{ $location->pais ? ', ' . $location->pais : '' }}</option>
                                        @endforeach
                                    </select>
                                    <select name="estado_publicacion_id" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                                        @foreach($publicationStates as $state)
                                            <option value="{{ $state->id }}" @selected((int) old('estado_publicacion_id', $offer->estado_publicacion_id) === (int) $state->id)>{{ $state->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', optional($offer->fecha_inicio)->format('Y-m-d')) }}" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                                    <input type="date" name="fecha_fin" value="{{ old('fecha_fin', optional($offer->fecha_fin)->format('Y-m-d')) }}" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm md:col-span-2">
                                    <textarea name="descripcion" rows="4" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm md:col-span-2" required>{{ old('descripcion', $offer->descripcion) }}</textarea>
                                    <div class="md:col-span-2 flex gap-3 justify-end">
                                        <button class="px-5 py-3 rounded-xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800">Guardar cambios</button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('dashboard.company.offers.destroy', $offer) }}" class="mt-3 flex justify-end" onsubmit="return confirm('¿Eliminar esta oferta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-5 py-3 rounded-xl bg-rose-50 text-rose-700 font-bold text-sm hover:bg-rose-100">Eliminar oferta</button>
                                </form>
                            </details>
                        @empty
                            <div class="bg-white rounded-[1.75rem] p-8 text-center text-slate-500 card-neo">No tienes ofertas registradas.</div>
                        @endforelse
                    </div>
                </section>

                <section id="postulantes" class="tab-content space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                        <h2 class="text-2xl font-black">Postulantes de tus ofertas</h2>
                        <p class="text-sm text-slate-500 mt-1">Listado real de postulaciones asociadas a tu empresa.</p>
                    </div>

                    <div class="bg-white rounded-[1.75rem] border border-slate-100 overflow-hidden">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider font-bold">
                                <tr>
                                    <th class="text-left px-5 py-3">Estudiante</th>
                                    <th class="text-left px-5 py-3">Carrera</th>
                                    <th class="text-left px-5 py-3">Oferta</th>
                                    <th class="text-left px-5 py-3">Estado</th>
                                    <th class="text-left px-5 py-3">TOPSIS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($applications as $application)
                                    <tr>
                                        <td class="px-5 py-3 font-semibold">{{ $application->perfilEstudiante?->usuario?->nombre_completo ?? 'Sin estudiante' }}</td>
                                        <td class="px-5 py-3 text-slate-600">{{ $application->perfilEstudiante?->carrera ?? 'N/D' }}</td>
                                        <td class="px-5 py-3 text-slate-600">{{ $application->ofertaPasantia?->titulo ?? 'N/D' }}</td>
                                        <td class="px-5 py-3"><span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">{{ $application->estadoPostulacion?->nombre ?? 'Sin estado' }}</span></td>
                                        <td class="px-5 py-3 text-slate-600">{{ $application->puntaje_topsis ?? 'N/D' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-8 text-center text-slate-500">No hay postulaciones para tus ofertas todavía.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="perfil" class="tab-content space-y-6">
                    <div class="bg-white rounded-[1.75rem] p-6 card-neo">
                        <h2 class="text-2xl font-black">Perfil de empresa</h2>
                        <p class="text-sm text-slate-500 mt-1">Actualiza la información pública de tu organización.</p>

                        <form method="POST" action="{{ route('dashboard.company.profile.update') }}" class="mt-5 grid gap-4 md:grid-cols-2">
                            @csrf
                            @method('PUT')
                            <input name="nombre_empresa" value="{{ old('nombre_empresa', $companyProfile->nombre_empresa) }}" placeholder="Nombre de la empresa" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <input name="industria" value="{{ old('industria', $companyProfile->industria) }}" placeholder="Industria" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                            <input name="sitio_web" value="{{ old('sitio_web', $companyProfile->sitio_web) }}" placeholder="https://sitio-web.com" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm md:col-span-2">
                            <label class="md:col-span-2 flex items-center gap-3 text-sm font-semibold text-slate-700">
                                <input type="checkbox" name="verificada" value="1" @checked(old('verificada', $companyProfile->verificada))>
                                Empresa verificada
                            </label>
                            <div class="md:col-span-2 flex justify-end">
                                <button class="px-5 py-3 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-500">Guardar perfil</button>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </div>
    </main>

    <script>
        lucide.createIcons();

        const initialTab = "{{ $activeTab }}";
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabSections = document.querySelectorAll('.tab-content');

        function activateTab(tabName) {
            tabSections.forEach((section) => section.classList.remove('active'));
            const target = document.getElementById(tabName);
            if (target) target.classList.add('active');

            tabButtons.forEach((button) => {
                const active = button.getAttribute('data-tab') === tabName;
                button.classList.toggle('bg-blue-600', active);
                button.classList.toggle('text-white', active);
                button.classList.toggle('font-bold', active);
                button.classList.toggle('text-slate-600', !active);
                button.classList.toggle('bg-white', !active);
            });
        }

        tabButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const tabName = button.getAttribute('data-tab');
                activateTab(tabName);
                const url = new URL(window.location.href);
                url.searchParams.set('tab', tabName);
                window.history.replaceState({}, '', url.toString());
            });
        });

        activateTab(initialTab || 'inicio');
    </script>
</body>
</html>
