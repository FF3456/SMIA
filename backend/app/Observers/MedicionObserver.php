<?php

namespace App\Observers;

use App\Models\MedicionAire;
use App\Services\PromedioHorarioService;
use Illuminate\Support\Facades\Log;

/**
 * MedicionObserver — Patrón Observer (GoF)
 *
 * Se registra automáticamente sobre el modelo MedicionAire
 * mediante el atributo #[ObservedBy([MedicionObserver::class])] en el modelo.
 *
 * Responsabilidad:
 *   Cuando una medición transiciona al estado VALIDADA,
 *   dispara automáticamente el recálculo del promedio horario
 *   para esa estación y gas.
 *
 * Flujo: Nueva medición → saved() → estado == VALIDADA → recalcular()
 */
class MedicionObserver
{
    public function __construct(
        private readonly PromedioHorarioService $promedioService
    ) {}

    /**
     * Escucha CUALQUIER creación/actualización del modelo.
     * Solo actúa cuando el estado cambia a VALIDADA.
     */
    public function saved(MedicionAire $medicion): void
    {
        // El cálculo de promedio solo aplica a mediciones VALIDADAS
        if ($medicion->estado !== MedicionAire::ESTADO_VALIDADA) {
            return;
        }

        // Solo recalcular si el estado acaba de cambiar a VALIDADA
        // (evitar recálculos duplicados en updates sin cambio de estado)
        if (! $medicion->wasChanged('estado') && ! $medicion->wasRecentlyCreated) {
            return;
        }

        $this->dispararRecalculo($medicion);
    }

    /**
     * También escucha la creación directa en estado VALIDADA
     * (por ejemplo, importaciones masivas validadas automáticamente).
     */
    public function created(MedicionAire $medicion): void
    {
        if ($medicion->estado === MedicionAire::ESTADO_VALIDADA) {
            $this->dispararRecalculo($medicion);
        }
    }

    // -------------------------------------------------------------------------
    // Lógica interna
    // -------------------------------------------------------------------------

    private function dispararRecalculo(MedicionAire $medicion): void
    {
        Log::info('SMIA Observer: Disparando recálculo de promedio horario', [
            'medicion_id' => $medicion->id,
            'estacion_id' => $medicion->estacion_id,
            'gas_tipo'    => $medicion->gas_tipo,
            'timestamp'   => $medicion->timestamp->toISOString(),
        ]);

        try {
            $promedio = $this->promedioService->calcularPromedioHorario(
                estacionId: $medicion->estacion_id,
                gasTipo:    $medicion->gas_tipo,
                hora:       $medicion->timestamp
            );

            if ($promedio) {
                Log::info('SMIA Observer: Promedio horario recalculado', [
                    'promedio_id'  => $promedio->id,
                    'gas_tipo'     => $promedio->gas_tipo,
                    'promedio'     => $promedio->promedio,
                    'n_mediciones' => $promedio->n_mediciones,
                ]);
            }
        } catch (\Throwable $e) {
            // El Observer NO debe bloquear la persistencia de la medición
            // ante un fallo en el cálculo del promedio
            Log::error('SMIA Observer: Error en recálculo de promedio', [
                'medicion_id' => $medicion->id,
                'error'       => $e->getMessage(),
                'trace'       => $e->getTraceAsString(),
            ]);
        }
    }
}
