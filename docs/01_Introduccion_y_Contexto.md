# Introducción y Contexto

## Introducción
Este documento describe el proceso de identificación y análisis de requerimientos para el desarrollo de un sistema de software. Un correcto levantamiento de requerimientos permite reducir riesgos, evitar sobrecostos y mejorar la comunicación con el cliente.

## ¿Qué es un requerimiento?
Un requerimiento es una condición o capacidad que debe cumplir un sistema para satisfacer una necesidad o resolver un problema específico.

## Contexto del Proyecto
El proyecto consiste en el desarrollo e implementación de una plataforma integral para el Gobierno Autónomo Municipal de La Paz (GAMLP), financiada por la cooperación sueca (ASDI) a través de la alianza "Basura 0". 

Esta plataforma tiene como objetivo centralizar y gestionar información ambiental del municipio, incluyendo:
- Calidad del aire
- Recursos hídricos
- Residuos sólidos
- Ruido ambiental

Para mejorar la gestión pública y cumplir con la normativa ambiental vigente.

## Problema
Actualmente la información ambiental se encuentra:
- Dispersa (Excel, papel, sistemas aislados)
- No estandarizada
- Difícil de analizar

## Objetivo
Centralizar, gestionar y visualizar la información ambiental en una plataforma única para mejorar la toma de decisiones y la transparencia.

# Registro y Matriz de Stakeholders - Proyecto SMIA

En esta sección se identifican los actores clave que intervienen en el Sistema Municipal de Información Ambiental (SMIA), clasificados por su nivel de influencia y el impacto que el proyecto tiene sobre sus actividades.

## 1. Matriz de Stakeholders (Poder vs. Interés)

| Nivel de Interés \ Poder | Bajo Poder                                                                                                                                                           | Alto Poder                                                                                                                                                 |
| :----------------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------- | :--------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Alto Interés**         | **Mantener Informados:** Ciudadanos, instituciones académicas, investigadores, empresas de recolección y transporte de residuos, actividades económicas y proyectos. | **Gestionar Atentamente (Key Players):** Gerencia de Gestión Ambiental Municipal, ASDI, MMAyA, DTI-GAMLP, encargados de monitoreo ambiental e inspectores. |
| **Bajo Interés**         | **Monitorear (Mínimo Esfuerzo):** Público general no involucrado directamente, proveedores tecnológicos externos.                                                    | **Mantener Satisfechos:** Entidades gubernamentales nacionales, planificadores municipales, organismos de fiscalización.                                   |

---

## 2. Registro Detallado de Interesados
| Rol                            | Nombre / Cargo                                                                                                                                                                                                                                            | Nivel de Influencia | Expectativa Principal                                                                                                                                                                                                                                                                                                                                       |
| :----------------------------- | :-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | :------------------ | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Cliente / Patrocinador**     | Cliente: Gerencia de Gestión Ambiental Municipal. <br> Patrocinador: Agencia Sueca de Cooperación Internacional para el Desarrollo (ASDI).                                                                                                                | Alto                | Transformar el SMIA en la columna vertebral de la planificación municipal, automatizando el Reporte Anual del Estado del Ambiente para eliminar la carga manual. Garantizar la interoperabilidad entre la Red MONICA y el sistema de Residuos bajo la Ley 755, asegurando transparencia mediante acceso ciudadano a indicadores ambientales en tiempo real. |
| **Usuario Final (Interno)**    | Encargados del monitoreo del aire, monitoreo de cuerpos de agua, monitoreo de residuos, monitoreo del parque automotor, monitoreo acústico, control de unidades industriales, monitoreo de actividades en obra y proyectos, inspectores y planificadores. | Alto                | Registrar, validar y consultar datos ambientales de forma rápida, confiable y centralizada para optimizar las actividades de control, monitoreo y fiscalización ambiental.                                                                                                                                                                                  |
| **Usuario Final (Externo)**    | Ciudadanos, empresas de recolección y transporte de residuos, actividades económicas y proyectos, entidades gubernamentales nacionales, instituciones académicas e investigadores.                                                                        | Medio               | Acceder a información ambiental pública de manera transparente, actualizada y verificable, facilitando el seguimiento de indicadores ambientales y el cumplimiento normativo.                                                                                                                                                                               |
| **Equipo Técnico (Consultor)** | Facilitador: Mijael Vega. <br> Modelador de Datos: Cristhian Cepeda. <br> Generadores: Fidel Jairo Flores Arratia, Yamil Ramos. <br> Escribano: Luis Lazo.                                                                                                | Medio               | Entregar una plataforma escalable, interoperable, documentada y mantenible, cumpliendo estándares de calidad, trazabilidad de datos y requerimientos técnicos definidos en el proyecto.                                                                                                                                                                     |
| **Ente Regulador**             | Ministerio de Medio Ambiente y Agua (MMAyA) / Dirección de Tecnologías de Información (DTI - GAMLP).                                                                                                                                                      | Alto                | Contar con una plataforma interoperable mediante API REST que garantice la integridad, trazabilidad y disponibilidad de los datos ambientales conforme a las Leyes 755 y 1333, permitiendo la generación automatizada de reportes estatales y la fiscalización en tiempo real sin intervención manual.                                                      |

---

## 3. Estrategia de Comunicación

* **Stakeholders Críticos:** Reuniones semanales de seguimiento (Sprint Reviews).
* **Stakeholders Operativos:** Manuales de usuario y capacitación técnica.
* **Ciudadanía:** Portal público de datos abiertos y visualización GIS interactiva.