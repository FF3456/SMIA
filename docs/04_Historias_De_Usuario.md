# Historias de Usuario del Sistema de Monitoreo e Información Ambiental (SMIA)

## Registro de Avance

Las historias de usuario del proyecto SMIA describen las funcionalidades requeridas por las distintas áreas involucradas en la gestión ambiental municipal del Gobierno Autónomo Municipal de La Paz (GAMLP). Estas historias reflejan necesidades relacionadas con el monitoreo ambiental, interoperabilidad institucional, visualización geoespacial, automatización de reportes y transparencia ciudadana.

El propósito de este registro es documentar el avance en el levantamiento y definición de requerimientos funcionales que permitirán transformar el SMIA en una plataforma centralizada e interoperable para la gestión de información ambiental, integrando módulos como calidad del aire, monitoreo hídrico, residuos sólidos, contaminación acústica, parque automotor, denuncias ambientales y sistemas GIS.

Cada historia de usuario se redacta utilizando la siguiente estructura:

> **Como** [rol involucrado], **quiero** [funcionalidad requerida], **para** [beneficio esperado].

Este registro facilita la identificación de necesidades de usuarios internos y externos, la priorización de funcionalidades críticas y el seguimiento del cumplimiento de los objetivos establecidos para el proyecto.

---

# 1. Gestión de Autenticación y Seguridad

| ID    | Historia de Usuario                                                                                                                                 | Prioridad |
| ----- | --------------------------------------------------------------------------------------------------------------------------------------------------- | --------- |
| HU-01 | Como usuario del sistema, quiero autenticarme mediante credenciales seguras, para proteger la información ambiental y mi acceso personal.           | Alta      |
| HU-02 | Como administrador, quiero crear, editar y desactivar usuarios, para controlar el acceso al sistema.                                                | Alta      |
| HU-03 | Como administrador, quiero asignar roles y permisos específicos, para restringir funcionalidades según responsabilidades.                           | Alta      |
| HU-04 | Como administrador, quiero bloquear accesos después de múltiples intentos fallidos, para prevenir ataques de fuerza bruta y accesos no autorizados. | Alta      |
| HU-40 | Como técnico ambiental, quiero acceder únicamente a los módulos autorizados según mi área, para evitar modificaciones incorrectas o accidentales.   | Media     |
| HU-41 | Como auditor, quiero visualizar el historial de cambios realizados en el sistema, para garantizar trazabilidad y control institucional.             | Alta      |

---

# 2. Acceso y Transparencia Ciudadana

| ID    | Historia de Usuario                                                                                                                  | Prioridad |
| ----- | ------------------------------------------------------------------------------------------------------------------------------------ | --------- |
| HU-05 | Como ciudadano, quiero consultar información ambiental sin iniciar sesión, para acceder fácilmente a datos públicos y transparentes. | Alta      |
| HU-19 | Como usuario externo, quiero visualizar indicadores ambientales actualizados, para conocer el estado ambiental del municipio.        | Alta      |
| HU-31 | Como ciudadano, quiero consultar el estado de mis denuncias ambientales, para realizar seguimiento a su atención.                    | Media     |

---

# 3. Gestión y Monitoreo Ambiental

| ID    | Historia de Usuario                                                                                                                                          | Prioridad |
| ----- | ------------------------------------------------------------------------------------------------------------------------------------------------------------ | --------- |
| HU-06 | Como técnico ambiental, quiero validar automáticamente los datos ingresados, para reducir errores humanos y asegurar consistencia.                           | Alta      |
| HU-07 | Como encargado del monitoreo del aire, quiero calcular automáticamente promedios de contaminantes, para verificar el cumplimiento de la normativa ambiental. | Alta      |
| HU-08 | Como encargado del monitoreo hídrico, quiero clasificar la calidad de cuerpos de agua, para evaluar riesgos y posibles usos.                                 | Alta      |
| HU-09 | Como encargado de residuos sólidos, quiero validar registros conforme a la Ley 755, para garantizar el cumplimiento normativo.                               | Alta      |
| HU-10 | Como encargado del parque automotor, quiero registrar emisiones vehiculares, para controlar fuentes móviles de contaminación.                                | Media     |
| HU-36 | Como operador ambiental, quiero validar datos de monitoreo según la normativa vigente, para asegurar cumplimiento legal.                                     | Alta      |
| HU-37 | Como directivo institucional, quiero visualizar indicadores ambientales globales, para apoyar la toma de decisiones estratégicas.                            | Alta      |

---

# 4. Monitoreo Geoespacial y Visualización GIS

| ID    | Historia de Usuario                                                                                                                                         | Prioridad |
| ----- | ----------------------------------------------------------------------------------------------------------------------------------------------------------- | --------- |
| HU-14 | Como usuario del sistema, quiero activar y desactivar capas geográficas, para analizar información específica en el mapa.                                   | Media     |
| HU-15 | Como ciudadano, quiero visualizar la calidad del aire en mapas interactivos, para conocer el estado ambiental de mi zona.                                   | Alta      |
| HU-16 | Como planificador municipal, quiero visualizar rutas de recolección de residuos, para optimizar la gestión operativa.                                       | Media     |
| HU-17 | Como técnico ambiental, quiero consultar mapas de ruido urbano, para identificar zonas críticas de contaminación acústica.                                  | Media     |
| HU-32 | Como especialista GIS, quiero sincronizar proyecciones cartográficas automáticamente, para evitar desplazamientos entre capas geoespaciales.                | Alta      |
| HU-33 | Como fiscalizador, quiero importar polígonos desde i-Gob y visualizar automáticamente la información del propietario, para agilizar procesos de inspección. | Alta      |
| HU-34 | Como administrador municipal, quiero notificar clausuras al sistema catastral, para marcar automáticamente zonas restringidas.                              | Media     |

---

# 5. Reportes y Analítica

| ID    | Historia de Usuario                                                                                                                                  | Prioridad |
| ----- | ---------------------------------------------------------------------------------------------------------------------------------------------------- | --------- |
| HU-18 | Como directivo institucional, quiero generar reportes automáticos del estado ambiental, para reducir trabajo manual y mejorar la toma de decisiones. | Alta      |
| HU-21 | Como analista ambiental, quiero extraer datos automáticamente desde distintas fuentes, para realizar análisis y estudios especializados.             | Media     |

---

# 6. Integración e Interoperabilidad

| ID    | Historia de Usuario                                                                                                                                      | Prioridad |
| ----- | -------------------------------------------------------------------------------------------------------------------------------------------------------- | --------- |
| HU-20 | Como administrador técnico, quiero sincronizar sensores ambientales en tiempo real, para validar automáticamente los datos recibidos.                    | Alta      |
| HU-22 | Como técnico ambiental, quiero recibir alertas automáticas cuando existan errores de sincronización o inconsistencias, para corregir fallos rápidamente. | Alta      |
| HU-23 | Como encargado del sistema, quiero integrar información con plataformas externas, para mantener consistencia e interoperabilidad institucional.          | Alta      |
| HU-24 | Como supervisor operativo, quiero importar rutas GPS en tiempo real, para visualizar recorridos y actividades operativas en el sistema GIS.              | Media     |
| HU-25 | Como inspector ambiental, quiero reportar incidentes automáticamente desde campo, para agilizar la atención y registro de eventos ambientales.           | Alta      |

---

# 7. Gestión de Denuncias y Alertas

| ID    | Historia de Usuario                                                                                                                                                              | Prioridad |
| ----- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------- |
| HU-30 | Como técnico ambiental, quiero recibir denuncias automáticamente en el sistema, para atender incidentes de forma rápida y organizada.                                            | Alta      |
| HU-35 | Como técnico ambiental, quiero recibir alertas por correo electrónico o SMS cuando se superen umbrales ambientales críticos, para actuar oportunamente ante riesgos ambientales. | Alta      |
| HU-38 | Como inspector ambiental, quiero utilizar firma digital en actas y registros, para otorgar validez legal a los documentos generados.                                             | Alta      |
