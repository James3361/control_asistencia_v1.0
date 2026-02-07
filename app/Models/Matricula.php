<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = [
        'estudiante_id',
        'anio_escolar_id',
        'seccion_id',
    ];

    

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function anioEscolar()
    {
        return $this->belongsTo(AnioEscolar::class, 'anio_escolar_id');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }

    public function areas()
    {
        return $this->hasMany(MatriculaArea::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function resultadosAcademicos()
    {
        return $this->hasMany(ResultadoAcademico::class);
    }
}

