<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPostulacion extends Model
{
    protected $table = 'estados_postulacion';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion', 'es_terminal'];

    protected $casts = [
        'es_terminal' => 'boolean',
    ];

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'estado_postulacion_id');
    }
}
