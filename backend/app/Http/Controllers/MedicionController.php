<?php

namespace App\Http\Controllers;

use App\Models\MedicionAire;
use App\Services\PromedioHorarioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * MedicionController
 *
 * Capa de Presentación (MVC) — Orquesta el flujo HTTP.
 * NO contiene lógica de negocio; delega en PromedioHorarioService.
 *
 * Rutas protegidas por:
 *   - Middleware auth:api (JWT)
 *   - Middleware role:tecnico,encargado_monica
 *
 * Endpoints:
 *   POST   /api/mediciones              → store()
 *   GET    /api/mediciones/{id}         → show()
 *   PUT    /api/mediciones/{id}/validar → validar()
 *   GET    /api/promedios/{estacionId}  → promediosActuales()
 *   GET    /api/promedios/{estacionId}/historico → historico()
 */
class MedicionController extends Controller
{
    public function __construct(
        private readonly PromedioHorarioService $promedioService
    ) {}

    // -------------------------------------------------------------------------
    // POST /api/mediciones
    // Registrar nueva medición — estado inicial: REGISTRADA
    // -------------------------------------------------------------------------
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'estacion_id' => ['required', 'integer', 'exists:estaciones_monica,id'],
            'gas_tipo'    => ['required', Rule::in(['NO2', 'SO2', 'O3'])],
            'valor'       => [
                'required',
                'numeric',
                'min:0',       // Concentraciones no pueden ser negativas
                'max:9999.9999',
            ],
            'timestamp'   => ['required', 'date', 'before_or_equal:now'],
            'observaciones' => ['nullable', 'string', 'max:500'],
        ]);

        $medicion = MedicionAire::create([
            ...$validated,
            'estado'         => MedicionAire::ESTADO_REGISTRADA,
            'registrado_por' => Auth::id(),
        ]);

        // El Observer se activará automáticamente si el estado llega a VALIDADA
        return response()->json([
            'message'  => 'Medición registrada correctamente',
            'data'     => $medicion,
            'estado'   => $medicion->estado,
        ], 201);
    }

    // -------------------------------------------------------------------------
    // GET /api/mediciones/{id}
    // -------------------------------------------------------------------------
    public function show(int $id): JsonResponse
    {
        $medicion = MedicionAire::with(['estacion', 'registradoPor', 'validadoPor'])
            ->findOrFail($id);

        return response()->json(['data' => $medicion]);
    }

    // -------------------------------------------------------------------------
    // PUT /api/mediciones/{id}/validar
    // Transición PENDIENTE_VALIDACION → VALIDADA
    // Dispara el Observer que recalcula el promedio horario
    // -------------------------------------------------------------------------
    public function validar(int $id): JsonResponse
    {
        $medicion = MedicionAire::findOrFail($id);

        if ($medicion->estado !== MedicionAire::ESTADO_PENDIENTE_VALIDACION) {
            return response()->json([
                'message' => 'La medición no está en estado PENDIENTE_VALIDACION',
                'estado_actual' => $medicion->estado,
            ], 422);
        }

        $medicion->validar(Auth::id());
        // El Observer (MedicionObserver::saved) se dispara aquí automáticamente

        return response()->json([
            'message'  => 'Medición validada. Promedio horario recalculado.',
            'data'     => $medicion->fresh(),
            'estado'   => $medicion->estado,
        ]);
    }

    // -------------------------------------------------------------------------
    // PUT /api/mediciones/{id}/enviar-validacion
    // Transición REGISTRADA → PENDIENTE_VALIDACION
    // -------------------------------------------------------------------------
    public function enviarAValidacion(int $id): JsonResponse
    {
        $medicion = MedicionAire::findOrFail($id);

        if (! $medicion->enviarAValidacion()) {
            return response()->json([
                'message' => 'La medición no puede pasar a validación desde su estado actual',
                'estado_actual' => $medicion->estado,
            ], 422);
        }

        return response()->json([
            'message' => 'Medición enviada a validación',
            'data'    => $medicion->fresh(),
        ]);
    }

    // -------------------------------------------------------------------------
    // GET /api/promedios/{estacionId}
    // Promedios horarios actuales — alimenta el dashboard Angular
    // -------------------------------------------------------------------------
    public function promediosActuales(int $estacionId): JsonResponse
    {
        $promedios = $this->promedioService->obtenerPromediosActuales($estacionId);

        return response()->json([
            'estacion_id' => $estacionId,
            'timestamp'   => now()->toISOString(),
            'datos'       => $promedios,
        ]);
    }

    // -------------------------------------------------------------------------
    // GET /api/promedios/{estacionId}/historico?gas=NO2&desde=...&hasta=...
    // -------------------------------------------------------------------------
    public function historico(Request $request, int $estacionId): JsonResponse
    {
        $validated = $request->validate([
            'gas_tipo' => ['required', Rule::in(['NO2', 'SO2', 'O3'])],
            'desde'    => ['required', 'date'],
            'hasta'    => ['required', 'date', 'after_or_equal:desde'],
        ]);

        $historico = $this->promedioService->obtenerHistorico(
            estacionId: $estacionId,
            gasTipo:    $validated['gas_tipo'],
            desde:      \Carbon\Carbon::parse($validated['desde']),
            hasta:      \Carbon\Carbon::parse($validated['hasta'])
        );

        return response()->json([
            'estacion_id' => $estacionId,
            'gas_tipo'    => $validated['gas_tipo'],
            'datos'       => $historico,
        ]);
    }
}
