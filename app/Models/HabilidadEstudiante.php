<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabilidadEstudiante extends Model
{
    protected $table = 'habilidades_estudiante';
    public $timestamps = false;

    protected $fillable = ['perfil_estudiante_id', 'habilidad_id', 'nivel'];

    public function perfilEstudiante()
    {
        return $this->belongsTo(PerfilEstudiante::class, 'perfil_estudiante_id');
    }

    public function habilidad()
    {
        return $this->belongsTo(Habilidad::class, 'habilidad_id');
    }
}
