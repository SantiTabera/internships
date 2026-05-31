<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePuntajeTopsis extends Model
{
    protected $table = 'detalle_puntaje_topsis';
    public $timestamps = false;

    protected $fillable = [
        'postulacion_id',
        'habilidad_id',
        'valor_bruto',
        'valor_normalizado',
        'valor_ponderado'
    ];

    protected $casts = [
        'valor_bruto' => 'decimal:2',
        'valor_normalizado' => 'decimal:4',
        'valor_ponderado' => 'decimal:4',
    ];

    public function postulacion()
    {
        return $this->belongsTo(Postulacion::class, 'postulacion_id');
    }

    public function habilidad()
    {
        return $this->belongsTo(Habilidad::class, 'habilidad_id');
    }
}
