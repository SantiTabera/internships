<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilEstudiante extends Model
{
    protected $table = 'perfiles_estudiante';
    public $timestamps = false;

    protected $fillable = ['usuario_id', 'universidad', 'carrera', 'anio_graduacion', 'biografia'];

    protected $casts = [
        'anio_graduacion' => 'integer',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function habilidades()
    {
        return $this->hasMany(HabilidadEstudiante::class, 'perfil_estudiante_id');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'perfil_estudiante_id');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoEstudiante::class, 'perfil_estudiante_id');
    }
}
