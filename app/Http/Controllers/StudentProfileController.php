<?php

namespace App\Http\Controllers;

use App\Models\PerfilEstudiante;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /**
     * Obtener perfil de estudiante
     */
    public function show($usuarioId)
    {
        $perfil = PerfilEstudiante::where('usuario_id', $usuarioId)
            ->with(['habilidades.habilidad', 'documentos', 'postulaciones'])
            ->firstOrFail();

        return response()->json($perfil);
    }

    /**
     * Crear o actualizar perfil de estudiante
     */
    public function store(Request $request, $usuarioId)
    {
        $validated = $request->validate([
            'universidad' => 'required|string|max:200',
            'carrera' => 'required|string|max:200',
            'anio_graduacion' => 'nullable|integer|min:2000|max:' . date('Y') + 10,
            'biografia' => 'nullable|string',
        ]);

        $perfil = PerfilEstudiante::updateOrCreate(
            ['usuario_id' => $usuarioId],
            $validated
        );

        return response()->json([
            'message' => 'Perfil de estudiante actualizado',
            'perfil' => $perfil,
        ]);
    }
}
