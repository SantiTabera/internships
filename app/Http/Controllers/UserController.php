<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Obtener todos los usuarios
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Obtener un usuario específico con sus relaciones
     */
    public function show($id)
    {
        $user = User::with(['rol', 'perfilEstudiante', 'perfilEmpresa'])->findOrFail($id);
        return response()->json($user);
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:150',
            'apellido_paterno' => 'sometimes|string|max:150',
            'apellido_materno' => 'sometimes|string|max:150',
            'correo' => [
                'sometimes',
                'email',
                Rule::unique('usuarios')->ignore($id),
            ],
            'rol_id' => 'sometimes|exists:roles,id',
            'activo' => 'sometimes|boolean',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user,
        ]);
    }

    /**
     * Eliminar usuario
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente',
        ]);
    }

    /**
     * Obtener el usuario autenticado
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
}
