/**
 * components/dashboard/dashboard.component.ts
 * SMIA — Dashboard de Promedios Horarios Red MONICA
 * Patrón MVVM: ViewModel — expone observables al template HTML (View)
 */

import {
  Component, OnInit, OnDestroy, ChangeDetectionStrategy
} from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';
import { MedicionService } from '../../services/medicion.service';
import {
  PromedioHorario, MedicionForm, GAS_CONFIG, CalidadAire, GasTipo
} from '../../models/medicion.model';

@Component({
  selector: 'app-dashboard-monica',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './dashboard.component.html',
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class DashboardComponent implements OnInit, OnDestroy {

  // Exponer config al template
  readonly GAS_CONFIG = GAS_CONFIG;
  readonly GASES: GasTipo[] = ['NO2', 'SO2', 'O3'];

  // Estado del ViewModel (enlazado reactivamente al template)
  promedios: Record<GasTipo, PromedioHorario | null> = {
    NO2: null, SO2: null, O3: null
  };
  ultimaActualizacion: Date | null = null;
  cargando = false;
  error: string | null = null;
  mensajeExito: string | null = null;
  erroresFormulario: string[] = [];

  // Formulario reactivo de registro
  readonly medicionForm: FormGroup;

  private readonly estacionId = 1; // Demo: Estación Centro
  private sub = new Subscription();

  constructor(
    private medicionService: MedicionService,
    private fb: FormBuilder
  ) {
    this.medicionForm = this.fb.group({
      estacion_id: [this.estacionId, [Validators.required, Validators.min(1)]],
      gas_tipo:    ['',     [Validators.required]],
      valor:       [null,   [Validators.required, Validators.min(0), Validators.max(9999.9999)]],
      timestamp:   [this.ahoraLocal(), [Validators.required]],
      observaciones: [''],
    });
  }

  ngOnInit(): void {
    // Iniciar polling reactivo (MVVM: ViewModel escucha el servicio)
    this.sub.add(
      this.medicionService.iniciarActualizacionAutomatica(this.estacionId)
        .subscribe(data => {
          if (data) {
            this.promedios = {
              NO2: data.datos['NO2'],
              SO2: data.datos['SO2'],
              O3:  data.datos['O3'],
            };
            this.ultimaActualizacion = new Date(data.timestamp);
          }
        })
    );

    this.sub.add(
      this.medicionService.cargando$.subscribe(v => this.cargando = v)
    );

    this.sub.add(
      this.medicionService.error$.subscribe(e => this.error = e)
    );
  }

  ngOnDestroy(): void {
    this.sub.unsubscribe();
  }

  // -------------------------------------------------------------------------
  // Acciones del ViewModel
  // -------------------------------------------------------------------------

  registrarMedicion(): void {
    this.erroresFormulario = [];
    this.mensajeExito = null;

    if (this.medicionForm.invalid) {
      this.medicionForm.markAllAsTouched();
      return;
    }

    const form: MedicionForm = this.medicionForm.value;

    // Validación adicional de tipos en el ViewModel (antes de llamar al servicio)
    const errores = this.medicionService.validarFormulario(form);
    if (errores.length > 0) {
      this.erroresFormulario = errores;
      return;
    }

    this.medicionService.registrarMedicion(form).subscribe({
      next: res => {
        this.mensajeExito = `Medición registrada (ID: ${res.data.id}). Estado: ${res.data.estado}`;
        this.medicionForm.reset({ estacion_id: this.estacionId, timestamp: this.ahoraLocal() });
      },
      error: err => {
        if (err.tipo === 'VALIDACION') {
          this.erroresFormulario = err.errores;
        } else {
          this.error = 'Error al registrar la medición. Intente nuevamente.';
        }
      },
    });
  }

  // -------------------------------------------------------------------------
  // Helpers para el template
  // -------------------------------------------------------------------------

  claseBadge(calidad: CalidadAire | undefined): string {
    const clases: Record<CalidadAire, string> = {
      BUENO:     'badge-bueno',
      MODERADO:  'badge-moderado',
      MALO:      'badge-malo',
      PELIGROSO: 'badge-peligroso',
    };
    return calidad ? clases[calidad] : 'badge-sin-datos';
  }

  iconoCalidad(calidad: CalidadAire | undefined): string {
    const iconos: Record<CalidadAire, string> = {
      BUENO: '✓', MODERADO: '~', MALO: '!', PELIGROSO: '✕'
    };
    return calidad ? iconos[calidad] : '–';
  }

  private ahoraLocal(): string {
    return new Date().toISOString().slice(0, 16);
  }

  trackByGas(_: number, gas: GasTipo): string {
    return gas;
  }
}
