<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AnioEscolarController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ReporteController;

// ============================
// LOGIN + LOGOUT (NUEVO)
// ============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ============================
// RUTAS PÚBLICAS
// ============================
Route::get('/', function () {
    return redirect()->route('login');
});

// ============================
// TUS RUTAS PROTEGIDAS (ANTIGUAS + NUEVAS)
// ============================
Route::middleware('auth')->group(function () {
    // Dashboard (mantengo tu AsistenciaController)
    Route::get('/dashboard', [AsistenciaController::class, 'dashboard'])->name('dashboard');
    
    // TUS RUTAS CRUD EXISTENTES
    Route::resource('anios', AnioEscolarController::class);
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('matriculas', MatriculaController::class);
    Route::resource('asistencias', AsistenciaController::class);
    
    // TUS REPORTES EXISTENTES
    Route::get('/reporte-estudiante', [AsistenciaController::class, 'reporteEstudiante'])->name('reporte.estudiantes');
    Route::get('/reporte-area', [AsistenciaController::class, 'reporteArea'])->name('reporte.area');

        Route::get('/asistencias/create', [AsistenciaController::class, 'create'])->name('asistencias.create');
    Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');

    Route::resource('reportes', ReporteController::class)->names(['index' => 'reportes.index']);

});
