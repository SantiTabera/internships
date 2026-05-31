<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequisitoHabilidadOferta extends Model
{
    protected $table = 'requisitos_habilidad_oferta';
    public $timestamps = false;

    protected $fillable = ['oferta_pasantia_id', 'habilidad_id', 'peso', 'nivel_minimo'];

    protected $casts = [
        'peso' => 'decimal:2',
        'nivel_minimo' => 'integer',
    ];

    public function ofertaPasantia()
    {
        return $this->belongsTo(OfertaPasantia::class, 'oferta_pasantia_id');
    }

    public function habilidad()
    {
        return $this->belongsTo(Habilidad::class, 'habilidad_id');
    }
}
