<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnioEscolar extends Model
{
    protected $table = 'anios_escolares';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'institucion_id',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'anio_escolar_id');
    }

    public function resultadosAcademicos()
    {
        return $this->hasMany(ResultadoAcademico::class, 'anio_escolar_id');
    }
}
