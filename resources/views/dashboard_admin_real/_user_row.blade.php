<details class="bg-white rounded-[1.75rem] card-neo overflow-hidden" @if(isset($open) && $open) open @endif>
    <summary class="cursor-pointer list-none px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
        <div>
            <div class="flex items-center gap-3 flex-wrap">
                <h3 class="text-lg font-black">{{ $user->nombre_completo }}</h3>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">#{{ $user->id }}</span>
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $user->activo ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $user->activo ? 'Activo' : 'Inactivo' }}</span>
            </div>
            <p class="text-sm text-slate-500 mt-2">{{ $user->correo }} · {{ $user->rol?->nombre ?? 'Sin rol' }}</p>
            <p class="text-sm text-slate-500 mt-1">{{ $user->perfilEstudiante ? $user->perfilEstudiante->universidad . ' / ' . $user->perfilEstudiante->carrera : ($user->perfilEmpresa ? $user->perfilEmpresa->nombre_empresa . ' / ' . $user->perfilEmpresa->industria : 'Sin perfil asociado') }}</p>
        </div>
        <div class="text-sm text-slate-500 font-semibold">Editar y desactivar</div>
    </summary>

    <div class="border-t border-slate-100 px-6 py-5">
        <form method="POST" action="{{ route('dashboard.admin.users.update', $user) }}" class="grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
            @csrf
            @method('PUT')
            <input name="nombre" value="{{ old('nombre', $user->nombre) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Nombres" required>
            <input name="apellido_paterno" value="{{ old('apellido_paterno', $user->apellido_paterno) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Apellido paterno" required>
            <input name="apellido_materno" value="{{ old('apellido_materno', $user->apellido_materno) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Apellido materno" required>
            <input name="correo" value="{{ old('correo', $user->correo) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
            <select name="rol_id" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" @selected((int) old('rol_id', $user->rol_id) === (int) $role->id)>{{ $role->nombre }}</option>
                @endforeach
            </select>
            <input name="contrasena" type="password" placeholder="Nueva contraseña (opcional)" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
            <input name="contrasena_confirmation" type="password" placeholder="Confirmar nueva contraseña" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm">
            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700">
                <input type="checkbox" name="activo" value="1" @checked(old('activo', $user->activo))>
                Cuenta activa
            </label>

            <input name="universidad" value="{{ old('universidad', $user->perfilEstudiante?->universidad) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Universidad">
            <input name="carrera" value="{{ old('carrera', $user->perfilEstudiante?->carrera) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Carrera">
            <input name="anio_graduacion" value="{{ old('anio_graduacion', $user->perfilEstudiante?->anio_graduacion) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Año de graduacion">

            <input name="nombre_empresa" value="{{ old('nombre_empresa', $user->perfilEmpresa?->nombre_empresa) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Nombre de la empresa">
            <input name="industria" value="{{ old('industria', $user->perfilEmpresa?->industria) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Industria">
            <input name="sitio_web" value="{{ old('sitio_web', $user->perfilEmpresa?->sitio_web) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm" placeholder="Sitio web">
            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700">
                <input type="checkbox" name="verificada" value="1" @checked(old('verificada', $user->perfilEmpresa?->verificada))>
                Empresa verificada
            </label>

            <div class="lg:col-span-2 xl:col-span-3 flex flex-col sm:flex-row gap-3 justify-end">
                <button class="px-5 py-3 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800 transition">Guardar cambios</button>
            </div>
        </form>

        <form method="POST" action="{{ route('dashboard.admin.users.destroy', $user) }}" class="mt-4">
            @csrf
            @method('DELETE')
            <button class="px-5 py-3 rounded-2xl bg-rose-50 text-rose-700 font-bold text-sm hover:bg-rose-100 transition">Desactivar cuenta</button>
        </form>
    </div>
</details>
