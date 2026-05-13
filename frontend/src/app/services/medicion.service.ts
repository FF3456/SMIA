/**
 * services/medicion.service.ts
 * SMIA — Servicio Angular para consumo del API Laravel
 * Patrón MVVM: conecta ViewModel con el backend
 */

import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import {
  Observable, BehaviorSubject, timer, switchMap,
  catchError, retry, of, tap
} from 'rxjs';
import {
  MedicionAire, MedicionForm, PromediosResponse, GasTipo
} from '../models/medicion.model';
import { environment } from '../../environments/environment';

@Injectable({ providedIn: 'root' })
export class MedicionService {

  private readonly apiUrl = `${environment.apiUrl}/v1`;

  // BehaviorSubject para actualización reactiva del dashboard (MVVM)
  private promediosSubject = new BehaviorSubject<PromediosResponse | null>(null);
  public promedios$ = this.promediosSubject.asObservable();

  private cargandoSubject = new BehaviorSubject<boolean>(false);
  public cargando$ = this.cargandoSubject.asObservable();

  private errorSubject = new BehaviorSubject<string | null>(null);
  public error$ = this.errorSubject.asObservable();

  constructor(private http: HttpClient) {}

  // -------------------------------------------------------------------------
  // Polling reactivo: actualiza promedios cada 60 segundos
  // -------------------------------------------------------------------------
  iniciarActualizacionAutomatica(estacionId: number): Observable<PromediosResponse> {
    return timer(0, 60_000).pipe(
      switchMap(() => this.obtenerPromediosActuales(estacionId)),
      tap(data => {
        this.promediosSubject.next(data);
        this.errorSubject.next(null);
      }),
      catchError(err => {
        this.errorSubject.next('Error al obtener promedios del servidor.');
        return of(null as any);
      })
    );
  }

  // -------------------------------------------------------------------------
  // Obtener promedios horarios actuales (NB 62011)
  // -------------------------------------------------------------------------
  obtenerPromediosActuales(estacionId: number): Observable<PromediosResponse> {
    return this.http.get<PromediosResponse>(
      `${this.apiUrl}/promedios/${estacionId}`
    ).pipe(
      retry({ count: 2, delay: 1000 })
    );
  }

  // -------------------------------------------------------------------------
  // Registrar nueva medición con validación previa de tipos
  // -------------------------------------------------------------------------
  registrarMedicion(form: MedicionForm): Observable<{ message: string; data: MedicionAire }> {
    const errores = this.validarFormulario(form);
    if (errores.length > 0) {
      return new Observable(obs => {
        obs.error({ tipo: 'VALIDACION', errores });
      });
    }

    this.cargandoSubject.next(true);

    const payload: MedicionAire = {
      estacion_id:   form.estacion_id!,
      gas_tipo:      form.gas_tipo as GasTipo,
      valor:         parseFloat(form.valor!.toString()),
      timestamp:     form.timestamp,
      observaciones: form.observaciones || undefined,
    };

    return this.http.post<{ message: string; data: MedicionAire }>(
      `${this.apiUrl}/mediciones`, payload
    ).pipe(
      tap(() => this.cargandoSubject.next(false)),
      catchError(err => {
        this.cargandoSubject.next(false);
        throw err;
      })
    );
  }

  // -------------------------------------------------------------------------
  // Validación de tipos de datos en frontend (antes de enviar al backend)
  // -------------------------------------------------------------------------
  validarFormulario(form: MedicionForm): string[] {
    const errores: string[] = [];

    if (!form.estacion_id || !Number.isInteger(Number(form.estacion_id))) {
      errores.push('El ID de estación debe ser un número entero positivo.');
    }

    if (!form.gas_tipo || !['NO2', 'SO2', 'O3'].includes(form.gas_tipo)) {
      errores.push('El tipo de gas debe ser NO2, SO2 u O3.');
    }

    if (form.valor === null || form.valor === undefined) {
      errores.push('El valor de concentración es obligatorio.');
    } else {
      const valor = parseFloat(form.valor.toString());
      if (isNaN(valor)) {
        errores.push('El valor de concentración debe ser numérico.');
      } else if (valor < 0) {
        errores.push('La concentración de gas no puede ser negativa (µg/m³ ≥ 0).');
      } else if (valor > 9999.9999) {
        errores.push('El valor supera el rango máximo esperado.');
      }
    }

    if (!form.timestamp) {
      errores.push('La fecha y hora de la medición son obligatorias.');
    } else {
      const ts = new Date(form.timestamp);
      if (isNaN(ts.getTime())) {
        errores.push('La fecha y hora no tienen formato válido.');
      } else if (ts > new Date()) {
        errores.push('La fecha de medición no puede ser futura.');
      }
    }

    return errores;
  }
}
