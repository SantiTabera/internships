<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PerfilEstudiante;
use App\Models\PerfilEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('login');
    }

    /**
     * Procesar login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required|string|min:6',
        ], [
            'correo.required' => 'El correo es requerido.',
            'correo.email' => 'El correo debe ser válido.',
            'contrasena.required' => 'La contraseña es requerida.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        // Intentar autenticar usando el correo
        $user = User::where('correo', $validated['correo'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'correo' => 'La cuenta no existe.',
            ]);
        }

        if (!Hash::check($validated['contrasena'], $user->contrasena_hash)) {
            throw ValidationException::withMessages([
                'contrasena' => 'La contraseña es incorrecta.',
            ]);
        }

        if (!$user->activo) {
            throw ValidationException::withMessages([
                'correo' => 'Esta cuenta está inactiva. Contacta con administración.',
            ]);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        if ((int) $user->rol_id === 3) {
            return redirect()->route('dashboard.admin');
        }

        return $this->redirectByRole($user);
    }

    /**
     * Mostrar formulario de registro
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('registro');
    }

    /**
     * Procesar registro de estudiante
     */
    public function registerStudent(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido_paterno' => 'required|string|max:150',
            'apellido_materno' => 'required|string|max:150',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|string|min:8|confirmed',
            'universidad' => 'required|string|max:200',
            'carrera' => 'required|string|max:200',
            'anio_graduacion' => 'nullable|integer|min:2000|max:' . (date('Y') + 10),
        ], [
            'nombre.required' => 'El nombre es requerido.',
            'correo.required' => 'El correo es requerido.',
            'correo.email' => 'El correo debe ser válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'contrasena.required' => 'La contraseña es requerida.',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
            'universidad.required' => 'La universidad es requerida.',
            'carrera.required' => 'La carrera es requerida.',
        ]);

        // Crear usuario con rol de estudiante (ID: 1)
        $user = User::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'correo' => $validated['correo'],
            'contrasena_hash' => Hash::make($validated['contrasena']),
            'rol_id' => 1, // Estudiante
            'activo' => true,
        ]);

        // Crear perfil de estudiante
        PerfilEstudiante::create([
            'usuario_id' => $user->id,
            'universidad' => $validated['universidad'],
            'carrera' => $validated['carrera'],
            'anio_graduacion' => $validated['anio_graduacion'] ?? null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard.student')->with('success', 'Perfil de estudiante creado correctamente');
    }

    /**
     * Procesar registro de empresa
     */
    public function registerCompany(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido_paterno' => 'required|string|max:150',
            'apellido_materno' => 'required|string|max:150',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|string|min:8|confirmed',
            'nombre_empresa' => 'required|string|max:200',
            'industria' => 'required|string|max:100',
            'sitio_web' => 'nullable|url|max:255',
        ], [
            'nombre.required' => 'El nombre de contacto es requerido.',
            'correo.required' => 'El correo es requerido.',
            'correo.email' => 'El correo debe ser válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'contrasena.required' => 'La contraseña es requerida.',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
            'nombre_empresa.required' => 'El nombre de la empresa es requerido.',
            'industria.required' => 'La industria es requerida.',
        ]);

        // Crear usuario con rol de empresa (ID: 2)
        $user = User::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'correo' => $validated['correo'],
            'contrasena_hash' => Hash::make($validated['contrasena']),
            'rol_id' => 2, // Empresa
            'activo' => false, // Requiere verificación de admin
        ]);

        // Crear perfil de empresa
        PerfilEmpresa::create([
            'usuario_id' => $user->id,
            'nombre_empresa' => $validated['nombre_empresa'],
            'industria' => $validated['industria'],
            'sitio_web' => $validated['sitio_web'] ?? null,
            'verificada' => false,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard.company')->with('success', 'Registro exitoso.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Sesión cerrada correctamente');
    }

    /**
     * Redirigir según el rol del usuario
     */
    private function redirectByRole(User $user)
    {
        $roleMap = [
            1 => 'dashboard.student',
            2 => 'dashboard.company',
            3 => 'dashboard.admin',
        ];

        return redirect()->route($roleMap[$user->rol_id] ?? 'dashboard');
    }
}
