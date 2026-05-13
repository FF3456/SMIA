<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: mediciones_aire
 * HU-07 — Sistema Municipal de Información Ambiental (SMIA)
 * Norma NB 62011 — Monitoreo de calidad del aire
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estaciones_monica', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique()->comment('Código único de estación Red MONICA');
            $table->string('nombre', 100);
            $table->string('ubicacion', 200)->nullable();
            $table->decimal('latitud', 10, 7)->nullable();
            $table->decimal('longitud', 10, 7)->nullable();
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });

        Schema::create('mediciones_aire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estacion_id')
                  ->constrained('estaciones_monica')
                  ->onDelete('cascade')
                  ->comment('Estación de la Red MONICA');

            $table->enum('gas_tipo', ['NO2', 'SO2', 'O3'])
                  ->comment('Tipo de gas según Norma NB 62011');

            $table->decimal('valor', 10, 4)
                  ->comment('Concentración en µg/m³ — debe ser >= 0');

            $table->enum('estado', ['REGISTRADA', 'PENDIENTE_VALIDACION', 'VALIDADA'])
                  ->default('REGISTRADA')
                  ->comment('Ciclo de vida: solo VALIDADA entra al cálculo de promedios');

            $table->timestamp('timestamp')
                  ->comment('Fecha/hora exacta de la medición');

            $table->foreignId('registrado_por')
                  ->nullable()
                  ->constrained('users')
                  ->comment('Usuario técnico que registró la medición');

            $table->foreignId('validado_por')
                  ->nullable()
                  ->constrained('users')
                  ->comment('Encargado que validó la medición');

            $table->timestamp('validado_en')->nullable();
            $table->string('observaciones', 500)->nullable();
            $table->timestamps();

            // Índices para consultas de promedios horarios (rendimiento < 500ms)
            $table->index(['estacion_id', 'gas_tipo', 'timestamp'], 'idx_promedio_horario');
            $table->index(['estado', 'timestamp'], 'idx_estado_tiempo');
            $table->index('timestamp');

            // Restricción: valor no puede ser negativo (concentraciones de gas)
            // Se implementa a nivel de BD como constraint adicional
        });

        // Constraint CHECK para valores no negativos (PostgreSQL)
        \DB::statement('ALTER TABLE mediciones_aire ADD CONSTRAINT chk_valor_positivo CHECK (valor >= 0)');

        Schema::create('promedios_horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estacion_id')->constrained('estaciones_monica');
            $table->enum('gas_tipo', ['NO2', 'SO2', 'O3']);
            $table->timestamp('hora_inicio')->comment('Inicio del período horario');
            $table->timestamp('hora_fin')->comment('Fin del período horario');
            $table->decimal('promedio', 10, 4)->comment('Promedio horario NB 62011');
            $table->integer('n_mediciones')->comment('Cantidad de mediciones válidas incluidas');
            $table->decimal('desviacion_estandar', 10, 4)->nullable();
            $table->decimal('valor_minimo', 10, 4)->nullable();
            $table->decimal('valor_maximo', 10, 4)->nullable();
            $table->timestamp('calculado_en')->useCurrent();
            $table->timestamps();

            $table->unique(['estacion_id', 'gas_tipo', 'hora_inicio'], 'uq_promedio_horario');
            $table->index(['estacion_id', 'gas_tipo', 'hora_inicio'], 'idx_consulta_promedios');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promedios_horarios');
        Schema::dropIfExists('mediciones_aire');
        Schema::dropIfExists('estaciones_monica');
    }
};
