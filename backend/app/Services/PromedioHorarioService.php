<?php

namespace App\Services;

use App\Models\MedicionAire;
use App\Models\PromedioHorario;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * PromedioHorarioService
 *
 * Capa de Lógica de Negocio — Cálculo de promedios horarios
 * según la Norma Boliviana NB 62011 para calidad del aire.
 *
 * La norma establece:
 *   - El promedio horario se calcula con mediciones del período [HH:00 - HH:59]
 *   - Solo se consideran mediciones en estado VALIDADA
 *   - Se requieren al menos 3 mediciones válidas por período para reportar
 *   - Los gases monitoreados son: NO2, SO2, O3
 *
 * Patrón: Service Layer — centraliza la lógica matemática
 * evitando que Controllers o Models la contengan.
 */
class PromedioHorarioService
{
    /**
     * Número mínimo de mediciones requeridas por período horario
     * según criterio de validez de la Norma NB 62011.
     */
    const MINIMO_MEDICIONES_VALIDAS = 3;

    /**
     * Gases monitoreados por la Red MONICA.
     */
    const GASES_MONITOREADOS = [
        MedicionAire::GAS_NO2,
        MedicionAire::GAS_SO2,
        MedicionAire::GAS_O3,
    ];

    // -------------------------------------------------------------------------
    // Método principal: calcular y persistir promedio horario
    // -------------------------------------------------------------------------

    /**
     * Calcula el promedio horario para una estación, gas y hora específicos.
     * Solo considera mediciones en estado VALIDADA (Norma NB 62011).
     *
     * @param int    $estacionId  ID de la estación de la Red MONICA
     * @param string $gasTipo     NO2 | SO2 | O3
     * @param Carbon $hora        Cualquier instante dentro del período horario
     * @return PromedioHorario|null  null si no hay suficientes mediciones válidas
     */
    public function calcularPromedioHorario(
        int $estacionId,
        string $gasTipo,
        Carbon $hora
    ): ?PromedioHorario {
        $inicio = $hora->copy()->startOfHour();
        $fin    = $hora->copy()->endOfHour();

        $mediciones = $this->obtenerMedicionesValidas($estacionId, $gasTipo, $inicio, $fin);

        if ($mediciones->count() < self::MINIMO_MEDICIONES_VALIDAS) {
            Log::info('SMIA: Insuficientes mediciones para promedio horario', [
                'estacion_id' => $estacionId,
                'gas_tipo'    => $gasTipo,
                'hora_inicio' => $inicio->toISOString(),
                'n_encontradas' => $mediciones->count(),
                'n_requeridas'  => self::MINIMO_MEDICIONES_VALIDAS,
            ]);
            return null;
        }

        $valores = $mediciones->pluck('valor')->map(fn($v) => (float) $v);

        $estadisticas = $this->calcularEstadisticas($valores->toArray());

        return $this->persistirPromedio(
            estacionId: $estacionId,
            gasTipo:    $gasTipo,
            inicio:     $inicio,
            fin:        $fin,
            stats:      $estadisticas,
            nMediciones: $mediciones->count()
        );
    }

    /**
     * Recalcula los promedios de la última hora para todas las estaciones
     * y todos los gases. Disparado por el Observer al recibir nueva medición.
     */
    public function recalcularUltimaHora(int $estacionId, string $gasTipo): ?PromedioHorario
    {
        return $this->calcularPromedioHorario($estacionId, $gasTipo, Carbon::now());
    }

    // -------------------------------------------------------------------------
    // Consultas de promedios almacenados
    // -------------------------------------------------------------------------

    /**
     * Obtiene los promedios horarios más recientes para el dashboard.
     * Retorna el último promedio calculado por estación y gas.
     */
    public function obtenerPromediosActuales(int $estacionId): array
    {
        $resultado = [];

        foreach (self::GASES_MONITOREADOS as $gas) {
            $promedio = PromedioHorario::where('estacion_id', $estacionId)
                ->where('gas_tipo', $gas)
                ->orderByDesc('hora_inicio')
                ->first();

            $resultado[$gas] = $promedio ? [
                'gas_tipo'      => $gas,
                'promedio'      => round((float) $promedio->promedio, 2),
                'hora_inicio'   => $promedio->hora_inicio->toISOString(),
                'hora_fin'      => $promedio->hora_fin->toISOString(),
                'n_mediciones'  => $promedio->n_mediciones,
                'desviacion'    => round((float) $promedio->desviacion_estandar, 4),
                'min'           => round((float) $promedio->valor_minimo, 4),
                'max'           => round((float) $promedio->valor_maximo, 4),
                'calculado_en'  => $promedio->calculado_en->toISOString(),
                'estado'        => $this->evaluarNormaNB62011($gas, (float) $promedio->promedio),
            ] : null;
        }

        return $resultado;
    }

    /**
     * Histórico de promedios horarios en un rango de fechas.
     */
    public function obtenerHistorico(
        int $estacionId,
        string $gasTipo,
        Carbon $desde,
        Carbon $hasta
    ): array {
        return PromedioHorario::where('estacion_id', $estacionId)
            ->where('gas_tipo', $gasTipo)
            ->whereBetween('hora_inicio', [$desde, $hasta])
            ->orderBy('hora_inicio')
            ->get()
            ->map(fn($p) => [
                'hora'      => $p->hora_inicio->toISOString(),
                'promedio'  => round((float) $p->promedio, 2),
                'n'         => $p->n_mediciones,
                'estado_nb' => $this->evaluarNormaNB62011($gasTipo, (float) $p->promedio),
            ])
            ->toArray();
    }

    // -------------------------------------------------------------------------
    // Lógica matemática (pura, testeable)
    // -------------------------------------------------------------------------

    /**
     * Calcula estadísticas descriptivas sobre un conjunto de valores.
     * Usa aritmética flotante estándar — suficiente para concentraciones µg/m³.
     */
    private function calcularEstadisticas(array $valores): array
    {
        $n = count($valores);
        $suma = array_sum($valores);
        $promedio = $suma / $n;

        // Desviación estándar muestral (n-1) — criterio estadístico habitual
        $varianza = 0;
        if ($n > 1) {
            foreach ($valores as $v) {
                $varianza += ($v - $promedio) ** 2;
            }
            $varianza /= ($n - 1);
        }

        return [
            'promedio'           => $promedio,
            'desviacion_estandar'=> sqrt($varianza),
            'valor_minimo'       => min($valores),
            'valor_maximo'       => max($valores),
            'n'                  => $n,
        ];
    }

    /**
     * Evalúa si el promedio supera umbrales de la Norma NB 62011.
     * Retorna: 'BUENO' | 'MODERADO' | 'MALO' | 'PELIGROSO'
     *
     * Límites referenciales (µg/m³) — horarios:
     *   NO2: 200 (OMS), 400 (límite NB)
     *   SO2: 350 (OMS), 700 (límite NB)
     *   O3:  100 (OMS), 180 (límite NB)
     */
    private function evaluarNormaNB62011(string $gasTipo, float $promedio): string
    {
        $umbrales = [
            'NO2' => ['bueno' => 100, 'moderado' => 200, 'malo' => 400],
            'SO2' => ['bueno' => 175, 'moderado' => 350, 'malo' => 700],
            'O3'  => ['bueno' =>  50, 'moderado' => 100, 'malo' => 180],
        ];

        $u = $umbrales[$gasTipo] ?? $umbrales['NO2'];

        if ($promedio <= $u['bueno'])    return 'BUENO';
        if ($promedio <= $u['moderado']) return 'MODERADO';
        if ($promedio <= $u['malo'])     return 'MALO';
        return 'PELIGROSO';
    }

    // -------------------------------------------------------------------------
    // Persistencia
    // -------------------------------------------------------------------------

    private function obtenerMedicionesValidas(
        int $estacionId,
        string $gasTipo,
        Carbon $inicio,
        Carbon $fin
    ) {
        return MedicionAire::validadas()
            ->porEstacion($estacionId)
            ->porGas($gasTipo)
            ->whereBetween('timestamp', [$inicio, $fin])
            ->select('valor')
            ->get();
    }

    /**
     * Persiste (INSERT o UPDATE) el promedio horario calculado.
     * Usa updateOrCreate para idempotencia — puede llamarse múltiples veces.
     */
    private function persistirPromedio(
        int $estacionId,
        string $gasTipo,
        Carbon $inicio,
        Carbon $fin,
        array $stats,
        int $nMediciones
    ): PromedioHorario {
        return PromedioHorario::updateOrCreate(
            [
                'estacion_id' => $estacionId,
                'gas_tipo'    => $gasTipo,
                'hora_inicio' => $inicio,
            ],
            [
                'hora_fin'            => $fin,
                'promedio'            => $stats['promedio'],
                'n_mediciones'        => $nMediciones,
                'desviacion_estandar' => $stats['desviacion_estandar'],
                'valor_minimo'        => $stats['valor_minimo'],
                'valor_maximo'        => $stats['valor_maximo'],
                'calculado_en'        => now(),
            ]
        );
    }
}
