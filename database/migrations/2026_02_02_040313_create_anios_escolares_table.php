<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anios_escolares', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');           // ← ESTA FALTABA
            $table->date('fecha_inicio');       // ← ESTA FALTABA  
            $table->date('fecha_fin');          // ← ESTA FALTABA
            $table->foreignId('institucion_id')->constrained('instituciones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anios_escolares');
    }
};
