/**
 * models/medicion.model.ts
 * SMIA — Tipos de datos para el módulo Red MONICA
 * Patrón MVVM: Model layer
 */

export type GasTipo = 'NO2' | 'SO2' | 'O3';
export type EstadoMedicion = 'REGISTRADA' | 'PENDIENTE_VALIDACION' | 'VALIDADA';
export type CalidadAire = 'BUENO' | 'MODERADO' | 'MALO' | 'PELIGROSO';

export interface MedicionAire {
  id?: number;
  estacion_id: number;
  gas_tipo: GasTipo;
  valor: number;
  estado?: EstadoMedicion;
  timestamp: string;
  observaciones?: string;
}

export interface PromedioHorario {
  gas_tipo: GasTipo;
  promedio: number;
  hora_inicio: string;
  hora_fin: string;
  n_mediciones: number;
  desviacion: number;
  min: number;
  max: number;
  calculado_en: string;
  estado: CalidadAire;
}

export interface PromediosResponse {
  estacion_id: number;
  timestamp: string;
  datos: Record<GasTipo, PromedioHorario | null>;
}

export interface MedicionForm {
  estacion_id: number | null;
  gas_tipo: GasTipo | '';
  valor: number | null;
  timestamp: string;
  observaciones: string;
}

// Unidades y umbrales según Norma NB 62011
export const GAS_CONFIG: Record<GasTipo, {
  nombre: string;
  unidad: string;
  umbrales: { bueno: number; moderado: number; malo: number };
  color: string;
}> = {
  NO2: {
    nombre: 'Dióxido de Nitrógeno',
    unidad: 'µg/m³',
    umbrales: { bueno: 100, moderado: 200, malo: 400 },
    color: '#e67e22',
  },
  SO2: {
    nombre: 'Dióxido de Azufre',
    unidad: 'µg/m³',
    umbrales: { bueno: 175, moderado: 350, malo: 700 },
    color: '#8e44ad',
  },
  O3: {
    nombre: 'Ozono',
    unidad: 'µg/m³',
    umbrales: { bueno: 50, moderado: 100, malo: 180 },
    color: '#2980b9',
  },
};
