<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    protected $table = 'habilidades';
    public $timestamps = false;

    protected $fillable = ['nombre', 'categoria', 'descripcion', 'activa'];

    protected $casts = [
        'activa' => 'boolean',
    ];

    public function estudiantesHabilidades()
    {
        return $this->hasMany(HabilidadEstudiante::class, 'habilidad_id');
    }

    public function requisitosOferta()
    {
        return $this->hasMany(RequisitoHabilidadOferta::class, 'habilidad_id');
    }

    public function detalePuntajeTopsis()
    {
        return $this->hasMany(DetallePuntajeTopsis::class, 'habilidad_id');
    }
}
