<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'perfil_estudiante_id',
        'oferta_pasantia_id',
        'estado_postulacion_id',
        'puntaje_topsis'
    ];

    protected $casts = [
        'puntaje_topsis' => 'decimal:2',
    ];

    public function perfilEstudiante()
    {
        return $this->belongsTo(PerfilEstudiante::class, 'perfil_estudiante_id');
    }

    public function ofertaPasantia()
    {
        return $this->belongsTo(OfertaPasantia::class, 'oferta_pasantia_id');
    }

    public function estadoPostulacion()
    {
        return $this->belongsTo(EstadoPostulacion::class, 'estado_postulacion_id');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoPostulacion::class, 'postulacion_id');
    }

    public function detalePuntajeTopsis()
    {
        return $this->hasMany(DetallePuntajeTopsis::class, 'postulacion_id');
    }
}
