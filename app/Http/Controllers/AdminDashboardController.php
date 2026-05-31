<?php

namespace App\Http\Controllers;

use App\Models\EstadoPostulacion;
use App\Models\EstadoPublicacion;
use App\Models\OfertaPasantia;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\Postulacion;
use App\Models\RegistroAuditoria;
use App\Models\TipoEntidad;
use App\Models\Rol;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->query('tab', 'resumen');

        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('activo', true)->count(),
            'students' => User::where('rol_id', 1)->count(),
            'companies' => User::where('rol_id', 2)->count(),
            'admins' => User::where('rol_id', 3)->count(),
            'verified_companies' => PerfilEmpresa::where('verificada', true)->count(),
            'pending_companies' => PerfilEmpresa::where('verificada', false)->count(),
            'total_offers' => OfertaPasantia::count(),
            'active_offers' => OfertaPasantia::where(function ($query) {
                $query->whereNull('fecha_fin')->orWhereDate('fecha_fin', '>=', now()->toDateString());
            })->count(),
            'total_applications' => Postulacion::count(),
            'average_topsis' => Postulacion::avg('puntaje_topsis'),
            'recent_audits' => RegistroAuditoria::count(),
        ];

        $roles = Rol::withCount('usuarios')->orderBy('id')->get();
        $publicationStates = EstadoPublicacion::withCount('ofertasPasantia')->orderBy('nombre')->get();
        $applicationStates = EstadoPostulacion::withCount('postulaciones')->orderBy('nombre')->get();

        $users = User::with(['rol', 'perfilEstudiante', 'perfilEmpresa'])
            ->orderByDesc('id')
            ->paginate(8, ['*'], 'users_page')
            ->withQueryString();

        // Separate lists by role for clearer admin UI
        $students = User::with('perfilEstudiante')
            ->where('rol_id', 1)
            ->orderByDesc('id')
            ->paginate(8, ['*'], 'students_page')
            ->withQueryString();

        $companyUsers = User::with('perfilEmpresa')
            ->where('rol_id', 2)
            ->orderByDesc('id')
            ->paginate(8, ['*'], 'companies_page')
            ->withQueryString();

        $adminUsers = User::where('rol_id', 3)
            ->orderByDesc('id')
            ->paginate(8, ['*'], 'admins_page')
            ->withQueryString();

        $offers = OfertaPasantia::with(['perfilEmpresa.usuario', 'ubicacion', 'estadoPublicacion'])
            ->withCount('postulaciones')
            ->orderByDesc('id')
            ->paginate(8, ['*'], 'offers_page')
            ->withQueryString();

        $companies = PerfilEmpresa::with('usuario')
            ->withCount('ofertasPasantia')
            ->orderBy('nombre_empresa')
            ->get();

        $locations = Ubicacion::orderBy('pais')->orderBy('region')->orderBy('ciudad')->get();

        $recentAudits = RegistroAuditoria::with(['usuario', 'tipoEntidad'])
            ->orderByDesc('creado_en')
            ->limit(10)
            ->get();

        $offerAudits = RegistroAuditoria::with(['usuario', 'tipoEntidad'])
            ->whereHas('tipoEntidad', function ($query) {
                $query->where('nombre', 'ofertas_pasantia');
            })
            ->orderByDesc('creado_en')
            ->limit(5)
            ->get();

        return view('dashboard_admin_real', compact(
            'activeTab',
            'stats',
            'roles',
            'publicationStates',
            'applicationStates',
            'users',
            'students',
            'companyUsers',
            'adminUsers',
            'offers',
            'companies',
            'locations',
            'recentAudits',
            'offerAudits'
        ));
    }

    public function storeUser(Request $request)
    {
        $validated = $this->validateUser($request);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'nombre' => $validated['nombre'],
                'apellido_paterno' => $validated['apellido_paterno'],
                'apellido_materno' => $validated['apellido_materno'],
                'correo' => $validated['correo'],
                'contrasena_hash' => Hash::make($validated['contrasena']),
                'rol_id' => $validated['rol_id'],
                'activo' => $validated['activo'] ?? true,
            ]);

            $this->syncProfiles($user, $validated);
            $this->logAudit(
                'usuarios',
                $user->id,
                $this->describeUserCreate($user, $validated),
                $this->buildAuditChanges([], $this->userAuditSnapshot($user, $validated), $this->userAuditLabels())
            );
        });

        return $this->redirectToTab('usuarios', 'Usuario creado correctamente.');
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $this->validateUser($request, $user->id);
        $before = $this->userAuditSnapshot($user);

        DB::transaction(function () use ($user, $validated, $before) {
            $user->update([
                'nombre' => $validated['nombre'],
                'apellido_paterno' => $validated['apellido_paterno'],
                'apellido_materno' => $validated['apellido_materno'],
                'correo' => $validated['correo'],
                'rol_id' => $validated['rol_id'],
                'activo' => $validated['activo'] ?? false,
            ]);

            if (!empty($validated['contrasena'])) {
                $user->update([
                    'contrasena_hash' => Hash::make($validated['contrasena']),
                ]);
            }

            $this->syncProfiles($user, $validated, true);
            $this->logAudit(
                'usuarios',
                $user->id,
                $this->describeUserUpdate($user, $before, $validated),
                $this->buildAuditChanges($before, $this->userAuditSnapshot($user, $validated), $this->userAuditLabels())
            );
        });

        return $this->redirectToTab('usuarios', 'Usuario actualizado correctamente.');
    }

    public function destroyUser(User $user)
    {
        if (Auth::user()?->id === $user->id) {
            return $this->redirectToTab('usuarios', 'No puedes desactivar tu propia cuenta.', 'error');
        }

        $before = $this->userAuditSnapshot($user);
        $user->update(['activo' => false]);
        $after = $this->userAuditSnapshot($user, ['activo' => false]);
        $this->logAudit(
            'usuarios',
            $user->id,
            $this->describeUserTarget($user) . ' - desactivó cuenta',
            $this->buildAuditChanges($before, $after, $this->userAuditLabels())
        );

        return $this->redirectToTab('usuarios', 'Cuenta desactivada correctamente.');
    }

    public function storeOffer(Request $request)
    {
        $validated = $this->validateOffer($request);

        $offer = OfertaPasantia::create($validated);

        $this->logAudit(
            'ofertas_pasantia',
            $offer->id,
            $this->describeOfferCreate($offer),
            $this->buildAuditChanges([], $this->offerAuditSnapshot($offer, $validated), $this->offerAuditLabels())
        );

        return $this->redirectToTab('ofertas', 'Oferta creada correctamente.');
    }

    public function updateOffer(Request $request, OfertaPasantia $offer)
    {
        $validated = $this->validateOffer($request, $offer->id);
        $before = $this->offerAuditSnapshot($offer);

        $offer->update($validated);
        $this->logAudit(
            'ofertas_pasantia',
            $offer->id,
            $this->describeOfferUpdate($offer, $before, $validated),
            $this->buildAuditChanges($before, $this->offerAuditSnapshot($offer, $validated), $this->offerAuditLabels())
        );

        return $this->redirectToTab('ofertas', 'Oferta actualizada correctamente.');
    }

    public function destroyOffer(OfertaPasantia $offer)
    {
        $before = $this->offerAuditSnapshot($offer);
        $offer->delete();
        $after = array_merge($before, ['estado_registro' => 'Eliminada']);
        $this->logAudit(
            'ofertas_pasantia',
            $offer->id,
            $this->describeOfferTarget($offer) . ' - eliminó oferta',
            $this->buildAuditChanges($before, $after, $this->offerAuditLabels())
        );

        return $this->redirectToTab('ofertas', 'Oferta eliminada correctamente.');
    }

    public function downloadReport(string $report): StreamedResponse
    {
        $filename = 'reporte_' . $report . '_' . now()->format('Ymd_His') . '.csv';
        $this->logAudit('reportes', 0, 'Descargó reporte ' . $report);

        return response()->streamDownload(function () use ($report) {
            $output = fopen('php://output', 'w');
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            $rows = [];
            $headers = [];

            switch ($report) {
                case 'users':
                    $headers = ['ID', 'Nombre completo', 'Correo', 'Rol', 'Estado', 'Perfil'];
                    $rows = User::with(['rol', 'perfilEstudiante', 'perfilEmpresa'])
                        ->orderBy('id')
                        ->get()
                        ->map(function (User $user) {
                            return [
                                $user->id,
                                $user->nombre_completo,
                                $user->correo,
                                $user->rol?->nombre ?? 'Sin rol',
                                $user->activo ? 'Activo' : 'Inactivo',
                                $this->userProfileSummary($user),
                            ];
                        });
                    break;

                case 'offers':
                    $headers = ['ID', 'Título', 'Empresa', 'Ubicación', 'Estado', 'Postulaciones'];
                    $rows = OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion'])
                        ->withCount('postulaciones')
                        ->orderBy('id')
                        ->get()
                        ->map(function (OfertaPasantia $offer) {
                            return [
                                $offer->id,
                                $offer->titulo,
                                $offer->perfilEmpresa?->nombre_empresa ?? 'Sin empresa',
                                $this->formatLocation($offer->ubicacion),
                                $offer->estadoPublicacion?->nombre ?? 'Sin estado',
                                $offer->postulaciones_count,
                            ];
                        });
                    break;

                case 'applications':
                    $headers = ['ID', 'Estudiante', 'Empresa', 'Oferta', 'Estado', 'Puntaje TOPSIS'];
                    $rows = Postulacion::with(['perfilEstudiante.usuario', 'ofertaPasantia.perfilEmpresa', 'estadoPostulacion'])
                        ->orderBy('id')
                        ->get()
                        ->map(function (Postulacion $application) {
                            return [
                                $application->id,
                                $application->perfilEstudiante?->usuario?->nombre_completo ?? 'Sin estudiante',
                                $application->ofertaPasantia?->perfilEmpresa?->nombre_empresa ?? 'Sin empresa',
                                $application->ofertaPasantia?->titulo ?? 'Sin oferta',
                                $application->estadoPostulacion?->nombre ?? 'Sin estado',
                                $application->puntaje_topsis ?? 'N/D',
                            ];
                        });
                    break;

                case 'audits':
                    $headers = ['ID', 'Usuario', 'Entidad', 'Entidad ID', 'Acción', 'Detalle', 'Fecha'];
                    $rows = RegistroAuditoria::with(['usuario', 'tipoEntidad'])
                        ->orderByDesc('creado_en')
                        ->get()
                        ->map(function (RegistroAuditoria $audit) {
                            return [
                                $audit->id,
                                $audit->usuario?->nombre_completo ?? 'Sistema',
                                $audit->tipoEntidad?->nombre ?? 'Sin entidad',
                                $audit->entidad_id ?? 'N/D',
                                $audit->accion,
                                $this->auditDetailsSummary($audit->detalles),
                                optional($audit->creado_en)?->format('Y-m-d H:i:s'),
                            ];
                        });
                    break;

                case 'changes':
                    $headers = ['Auditoría ID', 'Fecha', 'Usuario', 'Entidad', 'Entidad ID', 'Acción', 'Campo', 'Antes', 'Después'];
                    $rows = RegistroAuditoria::with(['usuario', 'tipoEntidad'])
                        ->orderByDesc('creado_en')
                        ->get()
                        ->flatMap(function (RegistroAuditoria $audit) {
                            $details = collect($audit->detalles ?? []);

                            if ($details->isEmpty()) {
                                return [[
                                    $audit->id,
                                    optional($audit->creado_en)?->format('Y-m-d H:i:s'),
                                    $audit->usuario?->nombre_completo ?? 'Sistema',
                                    $audit->tipoEntidad?->nombre ?? 'Sin entidad',
                                    $audit->entidad_id ?? 'N/D',
                                    $audit->accion,
                                    'Sin detalle',
                                    'N/D',
                                    'N/D',
                                ]];
                            }

                            return $details->map(function (array $detail) use ($audit) {
                                return [
                                    $audit->id,
                                    optional($audit->creado_en)?->format('Y-m-d H:i:s'),
                                    $audit->usuario?->nombre_completo ?? 'Sistema',
                                    $audit->tipoEntidad?->nombre ?? 'Sin entidad',
                                    $audit->entidad_id ?? 'N/D',
                                    $audit->accion,
                                    $detail['field'] ?? 'Campo',
                                    $detail['before'] ?? 'N/D',
                                    $detail['after'] ?? 'N/D',
                                ];
                            });
                        });
                    break;

                default:
                    abort(404);
            }

            fputcsv($output, $headers, ',', '"', '');

            foreach ($rows as $row) {
                fputcsv($output, $row, ',', '"', '');
            }

            fclose($output);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function validateUser(Request $request, ?int $userId = null): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'apellido_paterno' => ['required', 'string', 'max:150'],
            'apellido_materno' => ['required', 'string', 'max:150'],
            'correo' => [
                'required',
                'email',
                'max:255',
                Rule::unique('usuarios', 'correo')->ignore($userId),
            ],
            'contrasena' => [$userId ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'rol_id' => ['required', Rule::in([1, 2, 3])],
            'activo' => ['sometimes', 'boolean'],
            'universidad' => [
                new RequiredIf(fn () => (int) $request->input('rol_id') === 1),
                'nullable',
                'string',
                'max:200',
            ],
            'carrera' => [
                new RequiredIf(fn () => (int) $request->input('rol_id') === 1),
                'nullable',
                'string',
                'max:200',
            ],
            'anio_graduacion' => ['nullable', 'integer', 'min:2000', 'max:' . (date('Y') + 10)],
            'nombre_empresa' => [
                new RequiredIf(fn () => (int) $request->input('rol_id') === 2),
                'nullable',
                'string',
                'max:200',
            ],
            'industria' => [
                new RequiredIf(fn () => (int) $request->input('rol_id') === 2),
                'nullable',
                'string',
                'max:100',
            ],
            'sitio_web' => ['nullable', 'url', 'max:255'],
            'verificada' => ['sometimes', 'boolean'],
        ], [
            'correo.unique' => 'Ya existe un usuario con ese correo.',
            'contrasena.required' => 'La contraseña es obligatoria para crear el usuario.',
            'universidad.required' => 'La universidad es obligatoria para usuarios estudiante.',
            'carrera.required' => 'La carrera es obligatoria para usuarios estudiante.',
            'nombre_empresa.required' => 'El nombre de empresa es obligatorio para usuarios empresa.',
            'industria.required' => 'La industria es obligatoria para usuarios empresa.',
        ]);
    }

    private function validateOffer(Request $request, ?int $offerId = null): array
    {
        return $request->validate([
            'perfil_empresa_id' => ['required', 'exists:perfiles_empresa,id'],
            'ubicacion_id' => ['required', 'exists:ubicaciones,id'],
            'estado_publicacion_id' => ['required', 'exists:estados_publicacion,id'],
            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['required', 'string'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
        ]);
    }

    private function syncProfiles(User $user, array $validated, bool $updateMode = false): void
    {
        $roleId = (int) $validated['rol_id'];

        if ($roleId === 1) {
            // Keep student profile only when role is student.
            $user->perfilEmpresa()?->delete();

            if (!empty($validated['universidad']) || $updateMode) {
                PerfilEstudiante::updateOrCreate(
                    ['usuario_id' => $user->id],
                    [
                        'universidad' => $validated['universidad'] ?? $user->perfilEstudiante?->universidad ?? '',
                        'carrera' => $validated['carrera'] ?? $user->perfilEstudiante?->carrera ?? '',
                        'anio_graduacion' => $validated['anio_graduacion'] ?? $user->perfilEstudiante?->anio_graduacion,
                    ]
                );
            }

            return;
        }

        if ($roleId === 2) {
            // Keep company profile only when role is company.
            $user->perfilEstudiante()?->delete();

            if (!empty($validated['nombre_empresa']) || $updateMode) {
                PerfilEmpresa::updateOrCreate(
                    ['usuario_id' => $user->id],
                    [
                        'nombre_empresa' => $validated['nombre_empresa'] ?? $user->perfilEmpresa?->nombre_empresa ?? '',
                        'industria' => $validated['industria'] ?? $user->perfilEmpresa?->industria ?? '',
                        'sitio_web' => $validated['sitio_web'] ?? $user->perfilEmpresa?->sitio_web,
                        'verificada' => $validated['verificada'] ?? $user->perfilEmpresa?->verificada ?? false,
                    ]
                );
            }

            return;
        }

        // Admins should not keep student/company profiles.
        $user->perfilEstudiante()?->delete();
        $user->perfilEmpresa()?->delete();
    }

    private function redirectToTab(string $tab, string $message, string $flashKey = 'success')
    {
        return redirect()->route('dashboard.admin', ['tab' => $tab])->with($flashKey, $message);
    }

    private function logAudit(string $entityName, ?int $entityId, string $action, array $details = []): void
    {
        $tipoEntidad = TipoEntidad::firstOrCreate(
            ['nombre' => $entityName],
            ['descripcion' => 'Registro automático generado desde el panel admin']
        );

        RegistroAuditoria::create([
            'usuario_id' => Auth::user()?->id,
            'tipo_entidad_id' => $tipoEntidad->id,
            'entidad_id' => $entityId,
            'accion' => $action,
            'detalles' => $details ?: null,
        ]);
    }

    private function describeUserCreate(User $user, array $validated): string
    {
        $roleNames = [1 => 'estudiante', 2 => 'empresa', 3 => 'administrador'];
        $roleName = $roleNames[(int) $validated['rol_id']] ?? 'usuario';
        $stateName = !empty($validated['activo']) ? 'activo' : 'inactivo';

        return $this->describeUserTarget($user) . ' - creó cuenta de ' . $roleName . ' (' . $stateName . ')';
    }

    private function describeUserUpdate(User $user, array $before, array $validated): string
    {
        $roleNames = [1 => 'estudiante', 2 => 'empresa', 3 => 'administrador'];
        $changes = [];

        if ((int) ($before['rol_id'] ?? 0) !== (int) $validated['rol_id']) {
            $changes[] = 'cambió rol a ' . ($roleNames[(int) $validated['rol_id']] ?? 'usuario');
        }

        $beforeActive = (bool) ($before['activo'] ?? false);
        $afterActive = (bool) ($validated['activo'] ?? false);
        if ($beforeActive !== $afterActive) {
            $changes[] = $afterActive ? 'activó cuenta' : 'desactivó cuenta';
        }

        $nameChanged = ($before['nombre'] ?? null) !== $validated['nombre']
            || ($before['apellido_paterno'] ?? null) !== $validated['apellido_paterno']
            || ($before['apellido_materno'] ?? null) !== $validated['apellido_materno']
            || ($before['correo'] ?? null) !== $validated['correo'];

        if ($nameChanged) {
            $changes[] = 'editó datos de perfil';
        }

        if (!empty($validated['contrasena'])) {
            $changes[] = 'cambió contraseña';
        }

        if (empty($changes)) {
            return $this->describeUserTarget($user) . ' - actualizó usuario';
        }

        return $this->describeUserTarget($user) . ' - actualizó usuario: ' . implode(', ', $changes);
    }

    private function describeOfferCreate(OfertaPasantia $offer): string
    {
        return $this->describeOfferTarget($offer) . ' - creó oferta';
    }

    private function describeOfferUpdate(OfertaPasantia $offer, array $before, array $validated): string
    {
        $changes = [];

        if (($before['titulo'] ?? null) !== $validated['titulo']) {
            $changes[] = 'actualizó título';
        }

        if ((int) ($before['estado_publicacion_id'] ?? 0) !== (int) $validated['estado_publicacion_id']) {
            $changes[] = 'cambió estado';
        }

        if ((int) ($before['ubicacion_id'] ?? 0) !== (int) $validated['ubicacion_id']) {
            $changes[] = 'cambió ubicación';
        }

        if (empty($changes)) {
            return $this->describeOfferTarget($offer) . ' - actualizó oferta';
        }

        return $this->describeOfferTarget($offer) . ' - actualizó oferta (' . implode(', ', $changes) . ')';
    }

    private function describeUserTarget(User $user): string
    {
        return 'Cuenta #' . $user->id . ' (' . $user->nombre_completo . ' · ' . $user->correo . ')';
    }

    private function describeOfferTarget(OfertaPasantia $offer): string
    {
        return 'Oferta #' . $offer->id . ' (' . $offer->titulo . ')';
    }

    private function userAuditSnapshot(User $user, array $validated = []): array
    {
        $roleId = (int) ($validated['rol_id'] ?? $user->rol_id);

        return [
            'nombre' => $validated['nombre'] ?? $user->nombre,
            'apellido_paterno' => $validated['apellido_paterno'] ?? $user->apellido_paterno,
            'apellido_materno' => $validated['apellido_materno'] ?? $user->apellido_materno,
            'correo' => $validated['correo'] ?? $user->correo,
            'rol' => $this->roleLabel($roleId),
            'activo' => array_key_exists('activo', $validated) ? (bool) $validated['activo'] : (bool) $user->activo,
            'contrasena' => !empty($validated['contrasena']) ? 'Actualizada' : 'Sin cambios',
            'universidad' => $roleId === 1 ? ($validated['universidad'] ?? $user->perfilEstudiante?->universidad) : null,
            'carrera' => $roleId === 1 ? ($validated['carrera'] ?? $user->perfilEstudiante?->carrera) : null,
            'anio_graduacion' => $roleId === 1 ? ($validated['anio_graduacion'] ?? $user->perfilEstudiante?->anio_graduacion) : null,
            'nombre_empresa' => $roleId === 2 ? ($validated['nombre_empresa'] ?? $user->perfilEmpresa?->nombre_empresa) : null,
            'industria' => $roleId === 2 ? ($validated['industria'] ?? $user->perfilEmpresa?->industria) : null,
            'sitio_web' => $roleId === 2 ? ($validated['sitio_web'] ?? $user->perfilEmpresa?->sitio_web) : null,
            'verificada' => $roleId === 2 ? (bool) ($validated['verificada'] ?? $user->perfilEmpresa?->verificada) : null,
        ];
    }

    private function offerAuditSnapshot(OfertaPasantia $offer, array $validated = []): array
    {
        $perfilEmpresaId = $validated['perfil_empresa_id'] ?? $offer->perfil_empresa_id;
        $ubicacionId = $validated['ubicacion_id'] ?? $offer->ubicacion_id;
        $estadoPublicacionId = $validated['estado_publicacion_id'] ?? $offer->estado_publicacion_id;

        return [
            'titulo' => $validated['titulo'] ?? $offer->titulo,
            'descripcion' => $validated['descripcion'] ?? $offer->descripcion,
            'perfil_empresa_id' => $this->offerCompanyLabel($perfilEmpresaId),
            'ubicacion_id' => $this->offerLocationLabel($ubicacionId),
            'estado_publicacion_id' => $this->offerStatusLabel($estadoPublicacionId),
            'fecha_inicio' => $validated['fecha_inicio'] ?? optional($offer->fecha_inicio)->format('Y-m-d'),
            'fecha_fin' => $validated['fecha_fin'] ?? optional($offer->fecha_fin)->format('Y-m-d'),
        ];
    }

    private function userAuditLabels(): array
    {
        return [
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido paterno',
            'apellido_materno' => 'Apellido materno',
            'correo' => 'Correo',
            'rol' => 'Rol',
            'activo' => 'Estado',
            'contrasena' => 'Contraseña',
            'universidad' => 'Universidad',
            'carrera' => 'Carrera',
            'anio_graduacion' => 'Año de graduación',
            'nombre_empresa' => 'Nombre empresa',
            'industria' => 'Industria',
            'sitio_web' => 'Sitio web',
            'verificada' => 'Verificada',
        ];
    }

    private function offerAuditLabels(): array
    {
        return [
            'titulo' => 'Título',
            'descripcion' => 'Descripción',
            'perfil_empresa_id' => 'Empresa',
            'ubicacion_id' => 'Ubicación',
            'estado_publicacion_id' => 'Estado publicación',
            'fecha_inicio' => 'Fecha inicio',
            'fecha_fin' => 'Fecha fin',
            'estado_registro' => 'Estado registro',
        ];
    }

    private function offerCompanyLabel(?int $perfilEmpresaId): string
    {
        if (!$perfilEmpresaId) {
            return 'N/D';
        }

        $company = PerfilEmpresa::with('usuario')->find($perfilEmpresaId);

        if (!$company) {
            return 'Empresa #' . $perfilEmpresaId;
        }

        $companyLabel = $company->nombre_empresa ?: 'Empresa #' . $company->id;
        $ownerLabel = $company->usuario?->nombre_completo;

        return $ownerLabel ? $companyLabel . ' · ' . $ownerLabel : $companyLabel;
    }

    private function offerLocationLabel(?int $ubicacionId): string
    {
        if (!$ubicacionId) {
            return 'N/D';
        }

        return $this->formatLocation(Ubicacion::find($ubicacionId)) ?: ('Ubicación #' . $ubicacionId);
    }

    private function offerStatusLabel(?int $estadoPublicacionId): string
    {
        if (!$estadoPublicacionId) {
            return 'N/D';
        }

        return EstadoPublicacion::find($estadoPublicacionId)?->nombre ?? ('Estado #' . $estadoPublicacionId);
    }

    private function buildAuditChanges(array $before, array $after, array $labels): array
    {
        $changes = [];

        foreach ($labels as $field => $label) {
            $beforeValue = $this->auditDisplayValue($before[$field] ?? null);
            $afterValue = $this->auditDisplayValue($after[$field] ?? null);

            if ($beforeValue !== $afterValue) {
                $changes[] = [
                    'field' => $label,
                    'before' => $beforeValue,
                    'after' => $afterValue,
                ];
            }
        }

        return $changes;
    }

    private function auditDisplayValue(mixed $value): string
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        if (is_bool($value)) {
            return $value ? 'Sí' : 'No';
        }

        if ($value === null || $value === '') {
            return 'N/D';
        }

        return (string) $value;
    }

    private function auditDetailsSummary(mixed $details): string
    {
        if (empty($details) || !is_array($details)) {
            return 'Sin detalle';
        }

        return collect($details)
            ->map(function (array $detail) {
                return ($detail['field'] ?? 'Campo') . ': ' . ($detail['before'] ?? 'N/D') . ' -> ' . ($detail['after'] ?? 'N/D');
            })
            ->implode(' | ');
    }

    private function roleLabel(int $roleId): string
    {
        return [1 => 'Estudiante', 2 => 'Empresa', 3 => 'Administrador'][$roleId] ?? 'Usuario';
    }

    private function userProfileSummary(User $user): string
    {
        if ($user->rol_id === 1 && $user->perfilEstudiante) {
            return trim($user->perfilEstudiante->universidad . ' - ' . $user->perfilEstudiante->carrera);
        }

        if ($user->rol_id === 2 && $user->perfilEmpresa) {
            return trim($user->perfilEmpresa->nombre_empresa . ' - ' . $user->perfilEmpresa->industria);
        }

        return 'Sin perfil';
    }

    private function formatLocation(?Ubicacion $location): string
    {
        if (!$location) {
            return 'Sin ubicación';
        }

        return collect([$location->ciudad, $location->region, $location->pais])
            ->filter()
            ->implode(', ');
    }
}