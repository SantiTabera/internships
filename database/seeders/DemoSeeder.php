<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PerfilEstudiante;
use App\Models\PerfilEmpresa;

class DemoSeeder extends Seeder
{
    private const TEST_PASSWORD = '12345ABCd!';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin de prueba
        $admin = User::firstOrCreate(
            ['correo' => 'admin@internconnect.com'],
            [
                'nombre' => 'Administrador',
                'contrasena_hash' => Hash::make(self::TEST_PASSWORD),
                'rol_id' => 3,
                'activo' => true,
            ]
        );
        echo "✓ Admin creado: admin@internconnect.com / " . self::TEST_PASSWORD . "\n";

        // Crear estudiante de prueba
        $student = User::firstOrCreate(
            ['correo' => 'estudiante@example.com'],
            [
                'nombre' => 'Juan Pérez',
                'contrasena_hash' => Hash::make(self::TEST_PASSWORD),
                'rol_id' => 1,
                'activo' => true,
            ]
        );

        PerfilEstudiante::firstOrCreate(
            ['usuario_id' => $student->id],
            [
                'universidad' => 'Universidad Mayor de San Andrés',
                'carrera' => 'Ingeniería Informática',
                'anio_graduacion' => 2025,
            ]
        );
        echo "✓ Estudiante creado: estudiante@example.com / " . self::TEST_PASSWORD . "\n";

        // Crear empresa de prueba
        $company = User::firstOrCreate(
            ['correo' => 'empresa@example.com'],
            [
                'nombre' => 'Contacto Empresa',
                'contrasena_hash' => Hash::make(self::TEST_PASSWORD),
                'rol_id' => 2,
                'activo' => true,
            ]
        );

        PerfilEmpresa::firstOrCreate(
            ['usuario_id' => $company->id],
            [
                'nombre_empresa' => 'TechCompany Bolivia',
                'industria' => 'Tecnología',
                'sitio_web' => 'https://techcompany.bo',
                'verificada' => true,
            ]
        );
        echo "✓ Empresa creada: empresa@example.com / " . self::TEST_PASSWORD . "\n";

        echo "\n✅ Datos de prueba creados correctamente\n";
        echo "\nCuentas disponibles:\n";
        echo "  Admin: admin@internconnect.com / " . self::TEST_PASSWORD . "\n";
        echo "  Estudiante: estudiante@example.com / " . self::TEST_PASSWORD . "\n";
        echo "  Empresa: empresa@example.com / " . self::TEST_PASSWORD . "\n";
    }
}
