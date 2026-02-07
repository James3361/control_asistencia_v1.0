<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaFormacion extends Model
{
    protected $table = 'areas_formacion';
    
    protected $fillable = ['nombre', 'institucion_id'];  // ← ¡ESTO SOLUCIONA!

    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
