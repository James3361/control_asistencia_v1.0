<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = 'secciones';  // ← ¡ESTO ES CLAVE!
    
    protected $fillable = ['nombre', 'institucion_id'];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
