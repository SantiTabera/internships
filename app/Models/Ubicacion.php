<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    public $timestamps = false;

    protected $fillable = ['ciudad', 'region', 'pais', 'codigo_pais'];

    public function ofertasPasantia()
    {
        return $this->hasMany(OfertaPasantia::class, 'ubicacion_id');
    }
}
