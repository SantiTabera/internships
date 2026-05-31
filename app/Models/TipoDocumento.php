<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipos_documento';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function documentosEstudiante()
    {
        return $this->hasMany(DocumentoEstudiante::class, 'tipo_documento_id');
    }
}
