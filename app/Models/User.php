<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'contrasena_hash', 'rol_id', 'activo'])]
#[Hidden(['contrasena_hash'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    public $timestamps = false;
    protected $appends = ['nombre_completo'];

    // Mapear los nombres de las columnas personalizadas para Laravel
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = null;

    // Mapear columnas de la BD a propiedades de Eloquent para autenticación
    protected function casts(): array
    {
        return [
            'creado_en' => 'datetime',
            'contrasena_hash' => 'hashed',
            'activo' => 'boolean',
        ];
    }

    public function getNombreCompletoAttribute(): string
    {
        $parts = array_filter([
            $this->nombre,
            $this->apellido_paterno,
            $this->apellido_materno,
        ], fn ($value) => filled($value));

        return trim(implode(' ', $parts));
    }

    // CONFIGURACIÓN CRÍTICA DE AUTENTICACIÓN
    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'correo'; // Usar correo como identificador único
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->contrasena_hash; // Usar contrasena_hash como contraseña
    }

    /**
     * Mapear el email para compatibilidad con notificaciones
     */
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function perfilEstudiante()
    {
        return $this->hasOne(PerfilEstudiante::class, 'usuario_id');
    }

    public function perfilEmpresa()
    {
        return $this->hasOne(PerfilEmpresa::class, 'usuario_id');
    }

    public function registrosAuditoria()
    {
        return $this->hasMany(RegistroAuditoria::class, 'usuario_id');
    }
}
