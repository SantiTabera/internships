<?php

namespace App\Http\Controllers;

use App\Models\EstadoPublicacion;
use App\Models\OfertaPasantia;
use App\Models\PerfilEmpresa;
use App\Models\Postulacion;
use App\Models\Ubicacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CompanyDashboardController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $user = Auth::user();
        $companyProfile = $user?->perfilEmpresa;

        if (!$companyProfile) {
            return redirect()->route('dashboard')->with('error', 'No se encontró el perfil de empresa para tu cuenta.');
        }

        $offers = OfertaPasantia::with(['ubicacion', 'estadoPublicacion'])
            ->withCount('postulaciones')
            ->where('perfil_empresa_id', $companyProfile->id)
            ->orderByDesc('id')
            ->get();

        $applications = Postulacion::with(['perfilEstudiante.usuario', 'perfilEstudiante', 'ofertaPasantia', 'estadoPostulacion'])
            ->whereHas('ofertaPasantia', function ($query) use ($companyProfile) {
                $query->where('perfil_empresa_id', $companyProfile->id);
            })
            ->orderByDesc('id')
            ->limit(15)
            ->get();

        $today = now()->toDateString();
        $activeOffers = $offers->filter(function (OfertaPasantia $offer) use ($today) {
            return !$offer->fecha_fin || optional($offer->fecha_fin)->format('Y-m-d') >= $today;
        })->count();

        $stats = [
            'total_offers' => $offers->count(),
            'active_offers' => $activeOffers,
            'total_applications' => $applications->count(),
            'pending_applications' => $applications->filter(fn (Postulacion $p) => str_contains(strtolower($p->estadoPostulacion?->nombre ?? ''), 'pend'))->count(),
        ];

        $locations = Ubicacion::orderBy('pais')->orderBy('region')->orderBy('ciudad')->get();
        $publicationStates = EstadoPublicacion::orderBy('nombre')->get();

        return view('dashboard_company', [
            'activeTab' => $request->query('tab', 'inicio'),
            'companyProfile' => $companyProfile,
            'offers' => $offers,
            'applications' => $applications,
            'stats' => $stats,
            'locations' => $locations,
            'publicationStates' => $publicationStates,
        ]);
    }

    public function storeOffer(Request $request): RedirectResponse
    {
        $companyProfile = $this->companyProfileOrFail();

        $validated = $this->validateOffer($request);
        $validated['perfil_empresa_id'] = $companyProfile->id;

        OfertaPasantia::create($validated);

        return redirect()->route('dashboard.company', ['tab' => 'ofertas'])->with('success', 'Oferta creada correctamente.');
    }

    public function updateOffer(Request $request, OfertaPasantia $offer): RedirectResponse
    {
        $companyProfile = $this->companyProfileOrFail();
        $this->authorizeOfferOwnership($offer, $companyProfile);

        $offer->update($this->validateOffer($request));

        return redirect()->route('dashboard.company', ['tab' => 'ofertas'])->with('success', 'Oferta actualizada correctamente.');
    }

    public function destroyOffer(OfertaPasantia $offer): RedirectResponse
    {
        $companyProfile = $this->companyProfileOrFail();
        $this->authorizeOfferOwnership($offer, $companyProfile);

        $offer->delete();

        return redirect()->route('dashboard.company', ['tab' => 'ofertas'])->with('success', 'Oferta eliminada correctamente.');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $companyProfile = $this->companyProfileOrFail();

        $validated = $request->validate([
            'nombre_empresa' => ['required', 'string', 'max:200'],
            'industria' => ['required', 'string', 'max:100'],
            'sitio_web' => ['nullable', 'url', 'max:255'],
            'verificada' => ['sometimes', 'boolean'],
        ]);

        $companyProfile->update([
            'nombre_empresa' => $validated['nombre_empresa'],
            'industria' => $validated['industria'],
            'sitio_web' => $validated['sitio_web'] ?? null,
            'verificada' => $validated['verificada'] ?? $companyProfile->verificada,
        ]);

        return redirect()->route('dashboard.company', ['tab' => 'perfil'])->with('success', 'Perfil de empresa actualizado correctamente.');
    }

    private function validateOffer(Request $request): array
    {
        return $request->validate([
            'ubicacion_id' => ['required', Rule::exists('ubicaciones', 'id')],
            'estado_publicacion_id' => ['required', Rule::exists('estados_publicacion', 'id')],
            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['required', 'string'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
        ]);
    }

    private function companyProfileOrFail(): PerfilEmpresa
    {
        $profile = Auth::user()?->perfilEmpresa;

        abort_if(!$profile, 403, 'No existe perfil de empresa para esta cuenta.');

        return $profile;
    }

    private function authorizeOfferOwnership(OfertaPasantia $offer, PerfilEmpresa $companyProfile): void
    {
        abort_if((int) $offer->perfil_empresa_id !== (int) $companyProfile->id, 403, 'No puedes gestionar ofertas de otra empresa.');
    }
}
