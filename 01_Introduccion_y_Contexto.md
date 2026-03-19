# Introducción y Contexto

## Introducción
Este documento describe el proceso de identificación y análisis de requerimientos para el desarrollo de un sistema de software. Un correcto levantamiento de requerimientos permite reducir riesgos, evitar sobrecostos y mejorar la comunicación con el cliente.

## ¿Qué es un requerimiento?
Un requerimiento es una condición o capacidad que debe cumplir un sistema para satisfacer una necesidad o resolver un problema específico.

## Contexto del Proyecto
El proyecto consiste en el desarrollo de una plataforma denominada SMIA (Sistema Municipal de Información Ambiental).

Esta plataforma tiene como objetivo centralizar y gestionar información ambiental del municipio, incluyendo:
- Calidad del aire
- Recursos hídricos
- Residuos sólidos
- Ruido ambiental

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

| Nivel de Interés \ Poder | Bajo Poder | Alto Poder |
| :--- | :--- | :--- |
| **Alto Interés** | **Mantener Informados:** Ciudadanía, ONGs Ambientales, Investigadores UAB. | **Gestionar Atentamente (Key Players):** Alcalde, Secretaría de Gestión Ambiental (SMGA), Ministerio de Medio Ambiente (MMAyA). |
| **Bajo Interés** | **Monitorear (Mínimo Esfuerzo):** Proveedores de hardware, Público general no residente. | **Mantener Satisfechos:** Dirección de Finanzas (GAMLP), Ente Regulador de Telecomunicaciones. |

---

## 2. Registro Detallado de Interesados

| Nombre / Grupo | Rol en el Proyecto | Expectativa Principal | Impacto |
| :--- | :--- | :--- | :--- |
| **Secretaría de Gestión Ambiental (SMGA)** | Cliente / Dueño del Producto | Centralizar datos de aire, agua y residuos para toma de decisiones. | Crítico |
| **Dirección de Tecnologías (i-Gob)** | Socio Tecnológico | Asegurar la interoperabilidad con la plataforma i-Gob 24/7. | Alto |
| **Red MONICA** | Proveedor de Datos | Automatizar la carga de datos de calidad del aire sin errores manuales. | Alto |
| **Operadores de Residuos (SIGIR)** | Usuario Operativo | Validar manifiestos de transporte bajo la Ley 755 de forma digital. | Medio |
| **Ministerio de Medio Ambiente (MMAyA)** | Ente Regulador | Recibir reportes consolidados (SNIA) con validez legal y firma digital. | Alto |
| **Ciudadanía de La Paz** | Usuario Final / Beneficiario | Acceder a información transparente sobre el estado del ambiente (ICA). | Medio |
| **Grupo ScrumMaster - 6** | Equipo de Desarrollo | Cumplir con los hitos de entrega del TDR y estándares WCAG 2.1. | Crítico |

---

## 3. Estrategia de Comunicación

* **Stakeholders Críticos:** Reuniones semanales de seguimiento (Sprint Reviews).
* **Stakeholders Operativos:** Manuales de usuario y capacitación técnica.
* **Ciudadanía:** Portal público de datos abiertos y visualización GIS interactiva.