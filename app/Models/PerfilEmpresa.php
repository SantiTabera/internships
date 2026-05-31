<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilEmpresa extends Model
{
    protected $table = 'perfiles_empresa';
    public $timestamps = false;

    protected $fillable = ['usuario_id', 'nombre_empresa', 'industria', 'sitio_web', 'verificada'];

    protected $casts = [
        'verificada' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function ofertasPasantia()
    {
        return $this->hasMany(OfertaPasantia::class, 'perfil_empresa_id');
    }
}
