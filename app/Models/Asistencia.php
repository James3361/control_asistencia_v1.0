<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'matricula_id', 
        'area_formacion_id', 
        'fecha', 
        'estado'
    ];  // ← ¡ESTO SOLUCIONA TODO!

    protected $casts = [
        'fecha' => 'date'
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function areaFormacion()
    {
        return $this->belongsTo(AreaFormacion::class);
    }
}
