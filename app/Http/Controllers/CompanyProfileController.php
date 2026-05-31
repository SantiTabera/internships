<?php

namespace App\Http\Controllers;

use App\Models\PerfilEmpresa;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Obtener perfil de empresa
     */
    public function show($usuarioId)
    {
        $perfil = PerfilEmpresa::where('usuario_id', $usuarioId)
            ->with(['ofertasPasantia'])
            ->firstOrFail();

        return response()->json($perfil);
    }

    /**
     * Crear o actualizar perfil de empresa
     */
    public function store(Request $request, $usuarioId)
    {
        $validated = $request->validate([
            'nombre_empresa' => 'required|string|max:200',
            'industria' => 'required|string|max:100',
            'sitio_web' => 'nullable|url|max:255',
            'verificada' => 'sometimes|boolean',
        ]);

        $perfil = PerfilEmpresa::updateOrCreate(
            ['usuario_id' => $usuarioId],
            $validated
        );

        return response()->json([
            'message' => 'Perfil de empresa actualizado',
            'perfil' => $perfil,
        ]);
    }
}
