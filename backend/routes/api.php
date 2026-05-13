<?php

use App\Http\Controllers\MedicionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SMIA — API Routes
| Módulo: Red MONICA — Cálculo de Promedios Horarios (HU-07)
|
| Todos los endpoints requieren:
|   1. JWT válido (auth:api)
|   2. Rol: tecnico | encargado_monica (rol.monica)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api', 'rol.monica'])->prefix('v1')->group(function () {

    // ------------------------------------------------------------------
    // Mediciones — CRUD y ciclo de vida
    // ------------------------------------------------------------------
    Route::prefix('mediciones')->group(function () {
        Route::post('/',                            [MedicionController::class, 'store']);
        Route::get('/{id}',                         [MedicionController::class, 'show']);
        Route::put('/{id}/enviar-validacion',       [MedicionController::class, 'enviarAValidacion']);

        // Solo encargado_monica puede validar
        Route::put('/{id}/validar', [MedicionController::class, 'validar'])
            ->middleware('rol.encargado');
    });

    // ------------------------------------------------------------------
    // Promedios horarios — NB 62011
    // ------------------------------------------------------------------
    Route::prefix('promedios')->group(function () {
        Route::get('/{estacionId}',            [MedicionController::class, 'promediosActuales']);
        Route::get('/{estacionId}/historico',  [MedicionController::class, 'historico']);
    });
});
