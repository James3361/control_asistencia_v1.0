<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnioEscolarController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AsistenciaController;


Route::get('/', [AnioEscolarController::class, 'index'])->name ('home');

Route::resource('anios', AnioEscolarController::class);
Route::resource('estudiantes', EstudianteController::class);
Route::resource('matriculas', MatriculaController::class);
Route::resource('asistencias', AsistenciaController::class);
Route::get('/reporte-estudiante', [AsistenciaController::class, 'reporteEstudiante'])->name('reporte.estudiantes');
Route::get('/dashboard', [AsistenciaController::class, 'dashboard'])->name('dashboard');
Route::get('/reporte-area', [AsistenciaController::class, 'reporteArea'])->name('reporte.area');

