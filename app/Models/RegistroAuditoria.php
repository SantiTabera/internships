<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroAuditoria extends Model
{
    protected $table = 'registro_auditoria';
    public $timestamps = false;

    protected $fillable = ['usuario_id', 'tipo_entidad_id', 'entidad_id', 'accion', 'detalles'];

    protected $casts = [
        'creado_en' => 'datetime',
        'detalles' => 'array',
    ];

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = null;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function tipoEntidad()
    {
        return $this->belongsTo(TipoEntidad::class, 'tipo_entidad_id');
    }
}
