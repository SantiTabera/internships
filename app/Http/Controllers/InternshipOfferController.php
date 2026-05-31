<?php

namespace App\Http\Controllers;

use App\Models\OfertaPasantia;
use Illuminate\Http\Request;

class InternshipOfferController extends Controller
{
    /**
     * Obtener todas las ofertas de pasantía
     */
    public function index(Request $request)
    {
        $query = OfertaPasantia::with(['perfilEmpresa.usuario', 'ubicacion', 'estadoPublicacion']);

        // Filtros opcionales
        if ($request->has('estado')) {
            $query->where('estado_publicacion_id', $request->estado);
        }

        if ($request->has('ubicacion')) {
            $query->where('ubicacion_id', $request->ubicacion);
        }

        if ($request->has('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        return response()->json($query->paginate(15));
    }

    /**
     * Obtener una oferta específica
     */
    public function show($id)
    {
        $oferta = OfertaPasantia::with([
            'perfilEmpresa.usuario',
            'ubicacion',
            'estadoPublicacion',
            'requisitosHabilidad.habilidad',
            'postulaciones'
        ])->findOrFail($id);

        return response()->json($oferta);
    }

    /**
     * Crear nueva oferta de pasantía
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'perfil_empresa_id' => 'required|exists:perfiles_empresa,id',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'estado_publicacion_id' => 'required|exists:estados_publicacion,id',
            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
        ]);

        $oferta = OfertaPasantia::create($validated);

        return response()->json([
            'message' => 'Oferta de pasantía creada',
            'oferta' => $oferta,
        ], 201);
    }

    /**
     * Actualizar oferta de pasantía
     */
    public function update(Request $request, $id)
    {
        $oferta = OfertaPasantia::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:200',
            'descripcion' => 'sometimes|string',
            'estado_publicacion_id' => 'sometimes|exists:estados_publicacion,id',
            'ubicacion_id' => 'sometimes|exists:ubicaciones,id',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'sometimes|date',
        ]);

        $oferta->update($validated);

        return response()->json([
            'message' => 'Oferta actualizada',
            'oferta' => $oferta,
        ]);
    }

    /**
     * Eliminar oferta de pasantía
     */
    public function destroy($id)
    {
        $oferta = OfertaPasantia::findOrFail($id);
        $oferta->delete();

        return response()->json([
            'message' => 'Oferta eliminada',
        ]);
    }
}
