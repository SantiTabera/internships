<?php

namespace App\Http\Controllers;

use App\Models\OfertaPasantia;
use Illuminate\View\View;

class ExploreController extends Controller
{
    public function index(): View
    {
        $offers = OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion'])
            ->withCount('postulaciones')
            ->whereHas('perfilEmpresa', function ($query) {
                $query->where('verificada', true);
            })
            ->where(function ($query) {
                $query->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', now()->toDateString());
            })
            ->orderByDesc('id')
            ->get();

        return view('explora', [
            'offers' => $offers,
        ]);
    }
}
