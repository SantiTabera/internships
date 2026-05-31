<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPublicacion extends Model
{
    protected $table = 'estados_publicacion';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function ofertasPasantia()
    {
        return $this->hasMany(OfertaPasantia::class, 'estado_publicacion_id');
    }
}
