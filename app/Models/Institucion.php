<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $fillable = ['nombre', 'codigo', 'direccion'];

    protected $table = 'instituciones';
    
    public function aniosEscolares()
    {
        return $this->hasMany(AnioEscolar::class);
    }

    public function secciones()
    {
        return $this->hasMany(Seccion::class);
    }

    public function areasFormacion()
    {
        return $this->hasMany(AreaFormacion::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
