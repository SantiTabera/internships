<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfertaPasantia extends Model
{
    protected $table = 'ofertas_pasantia';
    public $timestamps = false;

    protected $fillable = [
        'perfil_empresa_id',
        'ubicacion_id',
        'estado_publicacion_id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function perfilEmpresa()
    {
        return $this->belongsTo(PerfilEmpresa::class, 'perfil_empresa_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    public function estadoPublicacion()
    {
        return $this->belongsTo(EstadoPublicacion::class, 'estado_publicacion_id');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'oferta_pasantia_id');
    }

    public function requisitosHabilidad()
    {
        return $this->hasMany(RequisitoHabilidadOferta::class, 'oferta_pasantia_id');
    }
}
