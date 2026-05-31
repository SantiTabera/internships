<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoEstudiante extends Model
{
    protected $table = 'documentos_estudiante';
    public $timestamps = false;

    protected $fillable = [
        'perfil_estudiante_id',
        'tipo_documento_id',
        'nombre_original',
        'ruta_almacenamiento',
        'tipo_mime',
        'tamano_bytes'
    ];

    protected $casts = [
        'tamano_bytes' => 'integer',
    ];

    public function perfilEstudiante()
    {
        return $this->belongsTo(PerfilEstudiante::class, 'perfil_estudiante_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    public function documentosPostulacion()
    {
        return $this->hasMany(DocumentoPostulacion::class, 'documento_estudiante_id');
    }
}
