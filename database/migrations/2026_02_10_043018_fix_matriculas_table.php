<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('matriculas', function (Blueprint $table) {
        // Solo agregar lo que FALTA
        if (!Schema::hasColumn('matriculas', 'estudiante_id')) {
            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
        }
        // area_formacion YA EXISTE → NO tocar
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            //
        });
    }
};
