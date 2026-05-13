# ANEXOS

---

# ANEXO A — Entrevistas y Sesiones de Definición Técnica

## A.1 Objetivo

El presente anexo documenta las sesiones de levantamiento y validación de requerimientos realizadas entre la contraparte técnica del Gobierno Autónomo Municipal de La Paz (GAMLP) y el equipo consultor responsable del desarrollo del Sistema Municipal de Información Ambiental (SMIA).

Estas entrevistas constituyen evidencia formal para:
- Identificación de requerimientos funcionales y no funcionales.
- Validación de procesos operativos.
- Definición de reglas de negocio.
- Priorización de módulos críticos.
- Identificación de restricciones técnicas y normativas.
- Construcción del Product Backlog.

---

## A.2 Información General

| Campo | Descripción |
|---|---|
| Proyecto | Sistema Municipal de Información Ambiental (SMIA) |
| Institución | Gobierno Autónomo Municipal de La Paz (GAMLP) |
| Unidad Responsable | Secretaría Municipal de Gestión Ambiental (SMGA) |
| Participantes | Contraparte Técnica GAMLP / Equipo Consultor |
| Tipo de Evidencia | Entrevistas Técnicas |
| Objetivo | Levantamiento y validación de requerimientos |

---

## A.3 Registro de Entrevistas Técnicas

---

### ET-01 — Validación de Datos y Normativa

#### Pregunta
¿Qué sucede cuando un técnico registra datos fuera de los rangos permitidos o inconsistentes con la normativa?

#### Respuesta Técnica
> "El sistema debe actuar como un filtro de calidad inmediato. Si un técnico intenta cargar un dato que rompe los parámetros de la Norma Boliviana 62011 (aire) o los límites de la Ley 1333, la plataforma debe emitir una alerta visual impidiendo el guardado o solicitando una justificación técnica obligatoria. Se requiere una validación en tiempo real, semaforización en los dashboards y una auditoría de errores que registre quién, cuándo y qué valor original se intentó ingresar para evitar manipulaciones de información oficial."

#### Requerimientos Derivados
- Validación automática de datos.
- Alertas visuales.
- Auditoría de errores.
- Registro de intentos inválidos.
- Semaforización de indicadores.

#### Historias Relacionadas
- HU-06
- HU-07
- HU-41

---

### ET-02 — Flujo de Denuncias Ambientales

#### Pregunta
¿Cuál es el flujo completo de una denuncia y qué estados intermedios existen?

#### Respuesta Técnica
> "El flujo inicia como 'Registrada' (vía app o web), pasando a 'En Revisión' para validar competencia. El estado crítico es 'Asignada a Inspección', donde se genera la hoja de ruta. Tras la visita, cambia a 'Con Informe Técnico', derivando en 'Notificación/Sanción' o 'Archivo'. El ciclo solo se considera 'Cerrado' con la resolución administrativa cargada y la notificación automática al ciudadano."

#### Requerimientos Derivados
- Gestión de estados de denuncia.
- Generación automática de tickets.
- Notificaciones ciudadanas.
- Flujo de inspección ambiental.

#### Historias Relacionadas
- HU-25
- HU-30
- HU-31

---

### ET-03 — Alcance Mínimo Viable (MVP)

#### Pregunta
Si el tiempo o presupuesto no alcanzan, ¿qué módulos son obligatorios?

#### Respuesta Técnica
> "Los pilares no negociables son: Gestión de Residuos (Basura 0), Denuncias Ambientales, Visualizador de Calidad del Aire/Ruido (Red MONICA) y Administración/Geodatabase."

#### Requerimientos Derivados
- Priorización de módulos críticos.
- Definición del MVP.
- Clasificación Must para módulos esenciales.

#### Historias Relacionadas
- HU-09
- HU-14
- HU-15
- HU-30

---

### ET-04 — Definición de Tiempo Real

#### Pregunta
¿Qué significa exactamente “tiempo real” para cada módulo?

#### Respuesta Técnica
> "Red MONICA: entre 15 y 30 minutos máximo. Denuncias: instantáneo para el registro inicial. Residuos: actualización diaria o por turno."

#### Requerimientos Derivados
- Restricciones temporales.
- Sincronización automática.
- Actualización periódica.
- Gestión de latencia.

#### Historias Relacionadas
- HU-20
- HU-21
- HU-35

---

### ET-05 — Historial, Auditoría y Borrado

#### Pregunta
¿Se permiten versiones anteriores? ¿Está permitido eliminar registros?

#### Respuesta Técnica
> "Debe existir un historial de versiones y una bitácora de transacciones inalterable. No está permitido eliminar registros, solo baja lógica."

#### Requerimientos Derivados
- Auditoría inmutable.
- Historial de cambios.
- Baja lógica obligatoria.
- Registro de responsables.

#### Historias Relacionadas
- HU-38
- HU-40
- HU-41

---

### ET-06 — Roles y Jerarquías

#### Pregunta
¿Se requieren permisos granulares?

#### Respuesta Técnica
> "Sí. Se definen niveles: Administrador, Operador, Validador y Consulta Externa."

#### Requerimientos Derivados
- Gestión de roles.
- Restricción por permisos.
- Jerarquía de validación.
- Separación de privilegios.

#### Historias Relacionadas
- HU-02
- HU-03
- HU-40

---

### ET-07 — Sincronización y Conectividad

#### Pregunta
¿Debe permitir registro sin conexión?

#### Respuesta Técnica
> "Es una exigencia operativa. El sistema debe permitir carga offline y sincronización posterior."

#### Requerimientos Derivados
- Soporte offline.
- Sincronización diferida.
- Resolución de conflictos.
- Persistencia temporal local.

#### Historias Relacionadas
- HU-20
- HU-24
- HU-30

---

### ET-08 — Calidad de Datos Históricos

#### Pregunta
¿Qué nivel de calidad tienen los históricos y deben limpiarse?

#### Respuesta Técnica
> "La consultoría es responsable del proceso ETL. Se deben normalizar categorías, eliminar duplicados y marcar registros incompletos."

#### Requerimientos Derivados
- Procesos ETL.
- Limpieza de datos.
- Eliminación de duplicados.
- Migración histórica.

#### Historias Relacionadas
- HU-06
- HU-18
- HU-37

---

### ET-09 — Responsabilidad y Mantenimiento

#### Pregunta
¿Quién es responsable de la veracidad y del soporte posterior?

#### Respuesta Técnica
> "El técnico que registra es el responsable primario de la veracidad. La empresa provee garantía y soporte técnico posterior."

#### Requerimientos Derivados
- Trazabilidad de usuarios.
- Garantía técnica.
- Entrega de código fuente.
- Manuales obligatorios.

#### Historias Relacionadas
- HU-02
- HU-18
- HU-41

---

### ET-10 — Accesibilidad y Visibilidad Ciudadana

#### Pregunta
¿Existen requerimientos de discapacidad? ¿Qué ve el ciudadano?

#### Respuesta Técnica
> "El sistema debe cumplir estándares de accesibilidad. El ciudadano verá mapas de calor, puntos de reciclaje y estado de denuncias."

#### Requerimientos Derivados
- Accesibilidad WCAG 2.1.
- Portal ciudadano.
- Open Data.
- Visualización ejecutiva.

#### Historias Relacionadas
- HU-05
- HU-15
- HU-19

---

## A.4 Conclusiones

Las entrevistas realizadas permitieron:
- Validar los requerimientos críticos del sistema.
- Definir restricciones operativas y normativas.
- Priorizar funcionalidades esenciales del MVP.
- Identificar necesidades de interoperabilidad institucional.
- Establecer criterios de auditoría, seguridad y trazabilidad.

La información obtenida fue incorporada en:
- Product Backlog.
- Historias de Usuario.
- Reglas de Negocio.
- Requerimientos Funcionales y No Funcionales.
- Diseño de Arquitectura del SMIA.
---

# ANEXO B — Acrónimos y Siglas

| Sigla | Descripción |
|---|---|
| SMIA | Sistema Municipal de Información Ambiental |
| GAMLP | Gobierno Autónomo Municipal de La Paz |
| SMGA | Secretaría Municipal de Gestión Ambiental |
| MONICA | Red de Monitoreo de Calidad del Aire |
| SIGIR | Sistema de Gestión Integral de Residuos |
| SNIA | Sistema Nacional de Información Ambiental |
| ADSIB | Agencia para el Desarrollo de la Sociedad de la Información en Bolivia |
| ETL | Extracción, Transformación y Carga |
| GIS | Sistema de Información Geográfica |
| ICA | Índice de Calidad del Aire |
| MVP | Producto Mínimo Viable |

---

# ANEXO C — Evidencia de Levantamiento de Requerimientos

## C.1 Introducción

El presente anexo recopila fragmentos relevantes obtenidos durante las sesiones de entrevista y validación técnica realizadas con personal del Gobierno Autónomo Municipal de La Paz (GAMLP), con el propósito de sustentar las decisiones funcionales, técnicas y arquitectónicas consideradas durante la construcción del Sistema Municipal de Información Ambiental (SMIA).

Los extractos incluidos reflejan necesidades operativas, preocupaciones institucionales y lineamientos técnicos expresados por los actores involucrados durante el proceso de levantamiento de información.

---

# C.2 Extractos Relevantes de Entrevistas

---

## C.2.1 Centralización de Información Ambiental

### Contexto
Sesión inicial de recepción y encuadre del proyecto.

### Extracto
> “Estamos impulsando el Sistema Municipal de Información Ambiental (SMIA) para centralizar todos nuestros indicadores de calidad del aire, agua y residuos.”

### Observación Técnica
Durante la entrevista se evidenció la necesidad institucional de consolidar múltiples fuentes de información ambiental dentro de una única plataforma municipal, permitiendo la integración de indicadores y la interoperabilidad entre áreas técnicas.

---

## C.2.2 Gestión de Información Histórica

### Contexto
Discusión sobre migración de datos existentes.

### Extracto
> “¿Usted viene por el tema del diagnóstico de infraestructura o por la migración de la base de datos histórica?”

### Observación Técnica
La contraparte técnica dejó en evidencia la existencia de información histórica previamente almacenada, así como la necesidad de realizar procesos de diagnóstico, migración y consolidación de datos ambientales existentes.

---

## C.2.3 Interoperabilidad Institucional

### Contexto
Discusión metodológica y enfoque de desarrollo.

### Extracto
> “Si el intercambio de datos entre módulos falla o no cumple con los protocolos de seguridad del GAMLP, el sistema no nos sirve.”

### Observación Técnica
Se identificó como prioridad institucional la comunicación correcta entre módulos y sistemas externos, enfatizando requisitos de interoperabilidad, consistencia de información y cumplimiento de estándares internos de seguridad.

---

## C.2.4 Seguridad y Protección de Servicios

### Contexto
Definición de arquitectura técnica.

### Extracto
> “¿Cómo piensa implementar la seguridad basada en tokens?”

### Observación Técnica
La entrevista permitió identificar requerimientos relacionados con autenticación segura, protección de servicios REST y mecanismos de control de acceso para usuarios internos y externos.

---

## C.2.5 Arquitectura Basada en Servicios

### Contexto
Validación de arquitectura propuesta.

### Extracto
> “Los TDR ya estipulan explícitamente el desarrollo de servicios Web REST bajo este esquema para facilitar la interacción con otros sistemas institucionales.”

### Observación Técnica
La contraparte técnica confirmó la necesidad de una arquitectura desacoplada basada en servicios REST, orientada a facilitar integraciones futuras y comunicación entre plataformas municipales.

---

## C.2.6 Persistencia y Gestión de Datos Geográficos

### Contexto
Discusión sobre tecnologías de almacenamiento.

### Extracto
> “¿Tienen ya un esquema preliminar de cómo manejarán la persistencia de datos considerando que usaremos PostgreSQL y posiblemente MongoDB para los datos georreferenciados?”

### Observación Técnica
Durante la sesión se evidenció la necesidad de administrar información geográfica y datos espaciales, así como el uso de tecnologías híbridas para soportar distintos tipos de almacenamiento.

---

## C.2.7 Cumplimiento Normativo TIC

### Contexto
Revisión de estándares institucionales.

### Extracto
> “Toda la documentación técnica debe ajustarse estrictamente a la normativa TIC 337 del municipio.”

### Observación Técnica
Se estableció la obligatoriedad de cumplir lineamientos técnicos institucionales relacionados con desarrollo, documentación, seguridad y despliegue de plataformas municipales.

---

## C.2.8 Contenedorización y Portabilidad

### Contexto
Discusión sobre infraestructura de despliegue.

### Extracto
> “El uso de Docker no es solo una opción, es prácticamente una necesidad para nosotros.”

### Observación Técnica
La contraparte técnica manifestó la necesidad de garantizar portabilidad, homogeneidad entre entornos y facilidad de despliegue mediante tecnologías de contenedorización.

---

## C.2.9 Persistencia y Protección de Información Ambiental

### Contexto
Infraestructura y despliegue.

### Extracto
> “¿Cómo van a gestionar los volúmenes para que la información ambiental no se pierda si el contenedor se reinicia?”

### Observación Técnica
Se identificaron requerimientos relacionados con persistencia de datos, respaldo de información crítica y continuidad operativa ante reinicios o fallos de infraestructura.

---

## C.2.10 Gestión Segura de Configuración

### Contexto
Definición de despliegue y seguridad.

### Extracto
> “¿Qué tienen planificado para el manejo de secretos y variables de entorno sensibles?”

### Observación Técnica
La entrevista evidenció la necesidad de implementar mecanismos seguros para el manejo de credenciales, configuraciones sensibles y variables de entorno dentro de la infraestructura del sistema.

---

## C.2.11 Optimización de Infraestructura

### Contexto
Revisión técnica de despliegue.

### Extracto
> “Necesito que las imágenes sean ligeras (...) para no saturar nuestro ancho de banda interno durante los despliegues.”

### Observación Técnica
La contraparte técnica remarcó restricciones operativas relacionadas con rendimiento, consumo de recursos y optimización del proceso de despliegue institucional.

---

## C.2.12 Compatibilidad Tecnológica

### Contexto
Definición preliminar del entorno tecnológico.

### Extracto
> “¿Están esperando definir las versiones exactas de Node/Python y la base de datos?”

### Observación Técnica
Se identificó la necesidad de establecer compatibilidad tecnológica y control de versiones para asegurar estabilidad en el entorno de desarrollo y producción.

---

# C.3 Conclusiones

Las sesiones de levantamiento permitieron identificar de manera progresiva:

- Necesidades de interoperabilidad institucional.
- Requisitos de seguridad y autenticación.
- Restricciones técnicas de infraestructura.
- Necesidades de persistencia y respaldo.
- Requerimientos GIS y georreferenciación.
- Necesidades de integración de datos históricos.
- Cumplimiento de estándares municipales TIC.
- Prioridades operativas de la Secretaría Municipal de Gestión Ambiental.

Los elementos identificados fueron considerados en:
- Requerimientos funcionales.
- Requerimientos no funcionales.
- Historias de usuario.
- Arquitectura lógica.
- Diseño de interoperabilidad.
- Estrategia de despliegue.

---