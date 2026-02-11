<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('estudiantes', function (Blueprint $table) {
        $table->string('cedula', 20)->nullable()->unique()->after('apellidos');
        if (!Schema::hasColumn('estudiantes', 'email')) {
            $table->string('email')->nullable()->after('telefono');
        }
    });
}


public function down()
{
    Schema::table('estudiantes', function (Blueprint $table) {
        if (Schema::hasColumn('estudiantes', 'cedula')) {
            $table->dropColumn('cedula');
        }
        if (Schema::hasColumn('estudiantes', 'email')) {
            $table->dropColumn('email');
        }
    });
}



};
