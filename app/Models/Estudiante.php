<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'fecha_nacimiento',
        'telefono',
        'correo',
        'institucion_id',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
