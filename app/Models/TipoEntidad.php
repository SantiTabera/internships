<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEntidad extends Model
{
    protected $table = 'tipos_entidad';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function registrosAuditoria()
    {
        return $this->hasMany(RegistroAuditoria::class, 'tipo_entidad_id');
    }
}
