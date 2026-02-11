<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('asistencias', function (Blueprint $table) {
        // Solo agregar lo que falta
        if (!Schema::hasColumn('asistencias', 'estado')) {
            $table->enum('estado', ['presente', 'ausente'])->default('presente');
        }
        if (!Schema::hasColumn('asistencias', 'fecha')) {
            $table->date('fecha')->nullable();
        }
    });
}


    public function down()
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropForeign(['matricula_id']);
            $table->dropColumn(['matricula_id', 'estado', 'fecha']);
        });
    }
};
