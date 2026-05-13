<?php

namespace App\Models;

use App\Observers\MedicionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo: MedicionAire
 *
 * Representa una medición puntual de concentración de gas
 * en una estación de la Red MONICA.
 *
 * Ciclo de vida del estado:
 *   REGISTRADA → PENDIENTE_VALIDACION → VALIDADA
 *
 * @property int    $id
 * @property int    $estacion_id
 * @property string $gas_tipo        NO2 | SO2 | O3
 * @property float  $valor           Concentración en µg/m³
 * @property string $estado
 * @property \Carbon\Carbon $timestamp
 */
#[ObservedBy([MedicionObserver::class])]
class MedicionAire extends Model
{
    use HasFactory;

    protected $table = 'mediciones_aire';

    protected $fillable = [
        'estacion_id',
        'gas_tipo',
        'valor',
        'estado',
        'timestamp',
        'registrado_por',
        'observaciones',
    ];

    protected $casts = [
        'valor'        => 'decimal:4',
        'timestamp'    => 'datetime',
        'validado_en'  => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Constantes de estado (Diagrama de estados HU-07)
    // -------------------------------------------------------------------------
    const ESTADO_REGISTRADA           = 'REGISTRADA';
    const ESTADO_PENDIENTE_VALIDACION = 'PENDIENTE_VALIDACION';
    const ESTADO_VALIDADA             = 'VALIDADA';

    const GAS_NO2 = 'NO2';
    const GAS_SO2 = 'SO2';
    const GAS_O3  = 'O3';

    // -------------------------------------------------------------------------
    // Relaciones
    // -------------------------------------------------------------------------
    public function estacion(): BelongsTo
    {
        return $this->belongsTo(EstacionMonica::class, 'estacion_id');
    }

    public function registradoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    public function validadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validado_por');
    }

    // -------------------------------------------------------------------------
    // Scopes para consultas de promedios (solo mediciones VALIDADAS)
    // -------------------------------------------------------------------------
    public function scopeValidadas($query)
    {
        return $query->where('estado', self::ESTADO_VALIDADA);
    }

    public function scopeEnHora($query, \Carbon\Carbon $hora)
    {
        $inicio = $hora->copy()->startOfHour();
        $fin    = $hora->copy()->endOfHour();
        return $query->whereBetween('timestamp', [$inicio, $fin]);
    }

    public function scopePorGas($query, string $gasTipo)
    {
        return $query->where('gas_tipo', $gasTipo);
    }

    public function scopePorEstacion($query, int $estacionId)
    {
        return $query->where('estacion_id', $estacionId);
    }

    // -------------------------------------------------------------------------
    // Transiciones de estado
    // -------------------------------------------------------------------------
    public function enviarAValidacion(): bool
    {
        if ($this->estado !== self::ESTADO_REGISTRADA) {
            return false;
        }
        return $this->update(['estado' => self::ESTADO_PENDIENTE_VALIDACION]);
    }

    public function validar(int $validadoPorId): bool
    {
        if ($this->estado !== self::ESTADO_PENDIENTE_VALIDACION) {
            return false;
        }
        return $this->update([
            'estado'       => self::ESTADO_VALIDADA,
            'validado_por' => $validadoPorId,
            'validado_en'  => now(),
        ]);
    }
}
