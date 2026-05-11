
# Product Backlog

## Sistema Municipal de Información Ambiental (SMIA)

El presente Product Backlog consolida los requerimientos funcionales priorizados para el desarrollo del Sistema Municipal de Información Ambiental (SMIA), plataforma orientada a centralizar, gestionar y visualizar información ambiental del Gobierno Autónomo Municipal de La Paz (GAMLP).

El backlog fue estructurado considerando los lineamientos establecidos en los Términos de Referencia, integrando funcionalidades relacionadas con:

* Gestión ambiental municipal.
* Monitoreo ambiental en tiempo real.
* Interoperabilidad institucional.
* Integración GIS.
* Transparencia ciudadana.
* Automatización de reportes ambientales.
* Gestión de denuncias e inspecciones.

La priorización de historias se basa en el modelo:

* **Must:** Funcionalidad crítica obligatoria.
* **Should:** Funcionalidad importante pero no bloqueante.
* **Could:** Funcionalidad complementaria o deseable.

---

# Estructura del Product Backlog

Cada Historia de Usuario (HU) contiene:

* Identificador único.
* Descripción funcional.
* Criterios de aceptación.
* Prioridad.
* Estimación de esfuerzo.
* Responsable asignado.
* Relación con requerimientos funcionales (RF).
* Relación con requerimientos no funcionales (RNF).

---

# Resumen General del Backlog

| Módulo                            | Historias     | Prioridad Predominante |
| --------------------------------- | ------------- | ---------------------- |
| Seguridad y Autenticación         | HU-01 a HU-05 | Must                   |
| Gestión Ambiental                 | HU-06 a HU-13 | Must                   |
| Visor GIS y Visualización         | HU-14 a HU-19 | Must / Should          |
| Interoperabilidad e Integraciones | HU-20 a HU-34 | Must / Should          |
| Ciudadanía, Normativa y Auditoría | HU-35 a HU-41 | Must / Could           |

---

---

## Módulo 1: Seguridad y Autenticación (HU-01 a HU-05)

### HU-01: Autenticación de Usuarios
**Como** usuario del sistema  
**Quiero** autenticarme mediante protocolos seguros (OAuth2/JWT)  
**Para** proteger el acceso a mi información personal y técnica

**Criterios de Aceptación:**
- [ ] Login con email/password funcional
- [ ] Generación de token JWT válido
- [ ] Expiración de sesión configurable
- [ ] Redirección al dashboard tras login

**Estimación:** 8h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-01 | **RNF:** RNF-01

---

### HU-02: Gestión de Usuarios
**Como** administrador  
**Quiero** crear, editar y eliminar usuarios  
**Para** gestionar el personal que tiene acceso a la plataforma

**Criterios de Aceptación:**
- [ ] CRUD completo de usuarios funcional
- [ ] Validación de campos obligatorios
- [ ] Listado de usuarios con búsqueda
- [ ] Activación/desactivación de cuentas

**Estimación:** 6h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-02 | **RNF:** RNF-11

---

### HU-03: Roles y Permisos
**Como** administrador  
**Quiero** definir y aplicar roles diferenciados (Admin, Técnico, Ciudadano)  
**Para** asegurar que cada usuario acceda solo a las funciones autorizadas

**Criterios de Aceptación:**
- [ ] Creación de roles personalizados
- [ ] Asignación de permisos por módulo
- [ ] Validación de acceso por rol
- [ ] Matriz de permisos visible

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-03 | **RNF:** RNF-01

---

### HU-04: Bloqueo por Intentos Fallidos
**Como** administrador de seguridad  
**Quiero** que el sistema bloquee el acceso tras 3 intentos fallidos  
**Para:** prevenir ataques de fuerza bruta

**Criterios de Aceptación:**
- [ ] Contador de intentos fallidos
- [ ] Bloqueo automático a los 3 intentos
- [ ] Temporizador de desbloqueo (30 min)
- [ ] Notificación al administrador

**Estimación:** 5h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-04 | **RNF:** RNF-01

---

### HU-05: Acceso Público sin Autenticación
**Como** ciudadano  
**Quiero** acceder a datos públicos sin autenticación  
**Para** informarme sobre el estado ambiental de mi ciudad de forma rápida

**Criterios de Aceptación:**
- [ ] Portal público accesible sin login
- [ ] Registro opcional para seguimiento
- [ ] Datos con máximo 24h de desfase
- [ ] Navegación intuitiva para ciudadanos

**Estimación:** 8h | **Prioridad:** Should  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-05 | **RNF:** RNF-08

---

## Módulo 2: Gestión Ambiental (HU-06 a HU-13)

### HU-06: Validación de Tipos de Datos
**Como** técnico ambiental  
**Quiero** que el sistema valide automáticamente los tipos de datos al registrarlos  
**Para** garantizar la integridad de la base de datos PostgreSQL

**Criterios de Aceptación:**
- [ ] Validación de tipos de datos al 100%
- [ ] Persistencia en PostgreSQL en < 500ms
- [ ] Generación automática de IDs únicos
- [ ] Mensajes de error claros

**Estimación:** 6h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-06 | **RNF:** RNF-12

---

### HU-07: Monitoreo de Calidad del Aire (Red MONICA)
**Como** encargado de la Red MONICA  
**Quiero** que el sistema calcule automáticamente promedios horarios de gases (NO₂, SO₂, O₃)  
**Para** cumplir con la Norma NB 62011

**Criterios de Aceptación:**
- [ ] Registro de PM10, PM2.5, NO₂, SO₂, O₃
- [ ] Cálculo automático de promedios horarios y diarios
- [ ] Cumplimiento Norma NB 62011
- [ ] Historial de mediciones

**Estimación:** 12h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-07 | **RNF:** RNF-10

---

### HU-08: Monitoreo de Calidad de Agua
**Como** encargado de cuerpos de agua  
**Quiero** clasificar automáticamente el tipo de agua y su aptitud de uso  
**Para** dar cumplimiento a la Ley 1333

**Criterios de Aceptación:**
- [ ] Registro de parámetros físico-químicos y bacteriológicos
- [ ] Clasificación automática según Ley 1333
- [ ] Aptitud de uso definida
- [ ] Alertas por contaminación

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-08 | **RNF:** RNF-12

---

### HU-09: Gestión Integral de Residuos (GIR)
**Como** encargado de residuos  
**Quiero** validar obligatoriamente los códigos de origen de los desechos  
**Para** cumplir con la normativa de la Ley 755

**Criterios de Aceptación:**
- [ ] Validación de códigos Ley 755
- [ ] Georreferenciación del origen
- [ ] Control de manifiestos y pesaje
- [ ] Seguimiento a operadores autorizados

**Estimación:** 14h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-09 | **RNF:** RNF-17

---

### HU-10: Monitoreo del Parque Automotor (CRTV)
**Como** encargado del parque automotor  
**Quiero** vincular automáticamente los datos de emisiones al número de placa  
**Para** agilizar el control de fuentes móviles

**Criterios de Aceptación:**
- [ ] Captura de datos de CO y HC
- [ ] Vinculación automática a placa vehicular
- [ ] Registro de inspecciones de gases y opacidad
- [ ] Historial por vehículo

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-10 | **RNF:** RNF-06

---

### HU-11: Monitoreo Acústico
**Como** técnico de monitoreo acústico  
**Quiero** generar visualizaciones de isófonas en el visor GIS  
**Para** identificar zonas de alta contaminación sonora en menos de 3 segundos

**Criterios de Aceptación:**
- [ ] Captura de niveles de presión sonora (dB)
- [ ] Generación de mapas de calor en < 3s
- [ ] Gestión de puntos fijos/móviles
- [ ] Zonas de alta sensibilidad acústica

**Estimación:** 12h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-11 | **RNF:** RNF-10

---

### HU-12: Control a Unidades Industriales
**Como** inspector de unidades industriales  
**Quiero** que el sistema bloquee registros que no adjunten firma digital y evidencia fotográfica  
**Para** asegurar la veracidad de las inspecciones

**Criterios de Aceptación:**
- [ ] Bloqueo sin firma digital (ADSIB)
- [ ] Evidencia fotográfica obligatoria
- [ ] Control de efluentes y emisiones
- [ ] Seguimiento al registro RAI

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-12 | **RNF:** RNF-17

---

### HU-13: Monitoreo AOP (Actividades, Obras y Proyectos)
**Como** planificador ambiental  
**Quiero** recibir alertas automáticas ante el vencimiento de plazos de licencias ambientales  
**Para** realizar un seguimiento efectivo de las medidas de mitigación

**Criterios de Aceptación:**
- [ ] Seguimiento a licencias ambientales
- [ ] Alertas automáticas por vencimiento
- [ ] Registro de manifiestos y PASA
- [ ] Dashboard de cumplimiento

**Estimación:** 8h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-13 | **RNF:** RNF-04

---

## Módulo 3: Visor GIS e Integración (HU-14 a HU-19)

### HU-14: Visor GIS Interactivo
**Como** usuario del visor GIS  
**Quiero** activar y desactivar capas ambientales de forma independiente  
**Para** analizar variables específicas sin errores de renderizado

**Criterios de Aceptación:**
- [ ] Activación/desactivación de capas independiente
- [ ] Navegación (zoom/pan) sin errores
- [ ] Proyección WGS84
- [ ] Rendimiento < 3s por capa

**Estimación:** 16h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-14 | **RNF:** RNF-10

---

### HU-15: Capa de Calidad del Aire (Semáforo ICA)
**Como** ciudadano  
**Quiero** visualizar puntos de monitoreo atmosférico con simbología de semáforo (ICA)  
**Para** conocer la calidad del aire en tiempo real según la norma NB 62011

**Criterios de Aceptación:**
- [ ] Puntos de monitoreo en mapa
- [ ] Simbología de semáforo (5 colores)
- [ ] Actualización automática cada hora
- [ ] Tooltip con detalles de estación

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-15 | **RNF:** RNF-10

---

### HU-16: Capas de Residuos e Industrias
**Como** planificador urbano  
**Quiero** visualizar las rutas de recolección de basura y polígonos industriales  
**Para** mejorar la gestión del catastro industrial municipal

**Criterios de Aceptación:**
- [ ] Líneas de ruta de recolección
- [ ] Polígonos de zonas industriales
- [ ] Vinculación a base de datos municipal
- [ ] Información al hacer clic

**Estimación:** 12h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-16 | **RNF:** RNF-06

---

### HU-17: Capa de Zonas Acústicas
**Como** técnico de la alcaldía  
**Quiero** desplegar mapas de calor de presión sonora sobre el catastro municipal  
**Para** identificar áreas críticas de ruido

**Criterios de Aceptación:**
- [ ] Mapa de calor de presión sonora
- [ ] Superposición sobre catastro municipal
- [ ] Identificación de zonas críticas
- [ ] Leyenda de niveles dB

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-17 | **RNF:** RNF-10

---

### HU-18: Generación de Reportes Técnicos y Legales
**Como** directivo municipal  
**Quiero** generar informes consolidados en PDF/Excel de los 7 módulos ambientales  
**Para** automatizar el Reporte Anual del Estado del Ambiente

**Criterios de Aceptación:**
- [ ] Exportación PDF/Excel en < 10s
- [ ] Logo municipal incluido
- [ ] Fecha/hora y foliado automático
- [ ] Firma digital (ADSIB) e integridad vía QR

**Estimación:** 14h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-18 | **RNF:** RNF-17

---

### HU-19: Portal Público de Indicadores
**Como** usuario externo  
**Quiero** acceder a un portal público con indicadores ambientales actualizados cada 24 horas  
**Para** fomentar la transparencia ciudadana

**Criterios de Aceptación:**
- [ ] Acceso sin login
- [ ] Datos con máximo 24h de desfase
- [ ] Indicadores de las 7 áreas
- [ ] Diseño responsive

**Estimación:** 10h | **Prioridad:** Should  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-19 | **RNF:** RNF-08

---

## Módulo 4: Interoperabilidad - APIs (HU-20 a HU-34)

### HU-20: Sincronización Bidireccional Red MONICA
**Como** administrador de sistemas  
**Quiero** mantener un canal de sincronización bidireccional con la Red MONICA  
**Para** validar constantemente el estado de los sensores

**Criterios de Aceptación:**
- [ ] API de enlace activa
- [ ] Respuesta "Heartbeat" en < 1s
- [ ] Validación de estados de conexión
- [ ] Log de sincronización

**Estimación:** 12h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-20 | **RNF:** RNF-06

---

### HU-21: Extracción de Datos MONICA (Pull)
**Como** analista de datos  
**Quiero** extraer datos (Pull) de parámetros PM₁₀ y NO₂ cada hora  
**Para** que se reflejen en el visor GIS en menos de 5 minutos

**Criterios de Aceptación:**
- [ ] Captura horaria automática
- [ ] Datos en visor GIS en < 5 min
- [ ] Almacenamiento en base de datos local
- [ ] Validación de consistencia

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-21 | **RNF:** RNF-02

---

### HU-22: Envío de Alertas MONICA (Push)
**Como** técnico de soporte  
**Quiero** que el sistema envíe alertas automáticas (Push) ante fallos de consistencia  
**Para** corregir errores de transmisión de forma inmediata

**Criterios de Aceptación:**
- [ ] Detección de fallos de consistencia
- [ ] Notificación automática a administrador MONICA
- [ ] Registro de log de errores
- [ ] Reintento automático

**Estimación:** 8h | **Prioridad:** Should  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-22 | **RNF:** RNF-06

---

### HU-23: Sincronización Bidireccional SIGIR
**Como** encargado de residuos  
**Quiero** intercambiar estados de manifiestos con el SIGIR  
**Para** asegurar que la información de residuos peligrosos sea idéntica en ambos sistemas

**Criterios de Aceptación:**
- [ ] Intercambio de estados (Pendiente/Aprobado)
- [ ] Consistencia idéntica en ambos sistemas
- [ ] Validación de manifiestos
- [ ] Log de sincronización

**Estimación:** 14h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-23 | **RNF:** RNF-06

---

### HU-24: Extracción de Rutas SIGIR (Pull)
**Como** supervisor de recolección  
**Quiero** importar coordenadas GPS y horarios de rutas desde el SIGIR  
**Para** visualizarlos en tiempo real en el SMIA

**Criterios de Aceptación:**
- [ ] Importación de coordenadas GPS
- [ ] Horarios de rutas actualizados
- [ ] Visualización en tiempo real
- [ ] Sin retrasos en el mapa

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-24 | **RNF:** RNF-10

---

### HU-25: Envío de Infracciones SIGIR (Push)
**Como** inspector municipal  
**Quiero** reportar incidentes de recolección (Push) directamente al SIGIR  
**Para** generar tickets de incidencia automáticos

**Criterios de Aceptación:**
- [ ] Creación de ticket de incidencia
- [ ] ID único generado por SMIA
- [ ] Envío automático a SIGIR
- [ ] Confirmación de recepción

**Estimación:** 8h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-25 | **RNF:** RNF-06

---

### HU-26: Validación de Esquemas JSON/XML
**Como** desarrollador  
**Quiero** validar esquemas JSON/XML según estándares nacionales  
**Para** garantizar la compatibilidad del 100% con el Ministerio

**Criterios de Aceptación:**
- [ ] Validación del 100% de campos obligatorios
- [ ] Cumplimiento estándar nacional
- [ ] Esquemas actualizables
- [ ] Reporte de validación

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-26 | **RNF:** RNF-06

---

### HU-27: Captura de Normativa SNIA (Pull)
**Como** administrador ambiental  
**Quiero** capturar normativas y parámetros legales desde el servidor del SNIA  
**Para** que los umbrales de alerta se actualicen automáticamente

**Criterios de Aceptación:**
- [ ] Actualización automática de umbrales
- [ ] Sincronización con servidor SNIA
- [ ] Historial de cambios de norma
- [ ] Notificación de actualizaciones

**Estimación:** 8h | **Prioridad:** Should  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-27 | **RNF:** RNF-06

---

### HU-28: Reporte Ambiental SNIA (Push)
**Como** gerente ambiental  
**Quiero** enviar automáticamente el informe consolidado al servidor nacional  
**Para** cumplir con las obligaciones de reporte estatal

**Criterios de Aceptación:**
- [ ] Envío automático del informe
- [ ] Confirmación HTTP 200 OK
- [ ] Sello digital de recibido SNIA
- [ ] Reintento en caso de fallo

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-28 | **RNF:** RNF-17

---

### HU-29: Enlace de Comunicación Línea 155
**Como** operador de denuncias  
**Quiero** sincronizar los catálogos de tipos de denuncia con la línea 155  
**Para** que las categorías sean idénticas en todas las plataformas

**Criterios de Aceptación:**
- [ ] Catálogos sincronizados
- [ ] Categorías idénticas (Quema, Ruido, Escombros)
- [ ] Actualización bidireccional
- [ ] Validación de categorías

**Estimación:** 6h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-29 | **RNF:** RNF-06

---

### HU-30: Recepción de Denuncias Línea 155 (Pull)
**Como** técnico de área  
**Quiero** recibir denuncias registradas telefónicamente en mi bandeja de entrada  
**Para** generar tickets de inspección en menos de 2 minutos

**Criterios de Aceptación:**
- [ ] Importación automática de quejas
- [ ] Generación de ticket en < 2 min
- [ ] Bandeja de entrada del técnico
- [ ] Priorización de denuncias

**Estimación:** 8h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-30 | **RNF:** RNF-02

---

### HU-31: Actualización de Estado Línea 155 (Push)
**Como** ciudadano denunciante  
**Quiero** recibir actualizaciones automáticas sobre el progreso de mi denuncia  
**Para** conocer si mi reporte fue inspeccionado o resuelto

**Criterios de Aceptación:**
- [ ] Envío de progreso a plataforma 155
- [ ] Estados: "En inspección", "Resuelto"
- [ ] Ciudadano puede ver avance con código original
- [ ] Notificación al ciudadano

**Estimación:** 8h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-31 | **RNF:** RNF-04

---

### HU-32: Validación de Capas WGS84
**Como** especialista GIS  
**Quiero** sincronizar proyecciones geográficas (WGS84)  
**Para** evitar desplazamientos de predios al superponer capas en el mapa

**Criterios de Aceptación:**
- [ ] Proyección WGS84 configurada
- [ ] Error de precisión < 0.5 metros
- [ ] Superposición correcta de predios
- [ ] Validación de coordenadas

**Estimación:** 8h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-32 | **RNF:** RNF-06

---

### HU-33: Importación de Predios i-Gob (Pull)
**Como** fiscalizador  
**Quiero** importar polígonos de industrias desde el servidor i-Gob  
**Para** visualizar el registro legal del dueño del predio con un solo clic

**Criterios de Aceptación:**
- [ ] Consumo de polígonos de i-Gob
- [ ] Visualización de nombre y registro legal
- [ ] Clic en mapa muestra información
- [ ] Zonificación urbana incluida

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-33 | **RNF:** RNF-06

---

### HU-34: Sincronización de Eventos i-Gob (Push)
**Como** administrador municipal  
**Quiero** notificar zonas con clausura ambiental al catastro municipal  
**Para** que se marquen automáticamente como áreas restringidas

**Criterios de Aceptación:**
- [ ] Notificación de clausura ambiental
- [ ] Actualización en visor de catastro
- [ ] Estado "Restringido por Sanción Ambiental"
- [ ] Sincronización automática

**Estimación:** 8h | **Prioridad:** Should  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-34 | **RNF:** RNF-06

---

## Módulo 5: Ciudadanía y Normativa (HU-35 a HU-41)

### HU-35: Notificaciones por Superación de Umbrales
**Como** técnico responsable  
**Quiero** recibir notificaciones por correo/SMS ante la superación de umbrales ambientales  
**Para** actuar de manera inmediata

**Criterios de Aceptación:**
- [ ] Detección de superación de umbrales
- [ ] Alerta por correo/SMS en < 5 minutos
- [ ] Notificación al técnico responsable
- [ ] Registro de notificaciones enviadas

**Estimación:** 8h | **Prioridad:** Could  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-35 | **RNF:** RNF-04

---

### HU-36: Estandarización Normativa Ley 755
**Como** operador de pesaje  
**Quiero** validar automáticamente los datos de residuos (Peso y Placa)  
**Para** asegurar que la paridad de datos con el nivel nacional sea total

**Criterios de Aceptación:**
- [ ] Validación de campos (Peso, Tipo, Placa, Operador)
- [ ] Bloqueo si unidad fuera de geocerca GAMLP
- [ ] Conversión a Kg y generación de Hash
- [ ] Firma digital obligatoria del operador

**Estimación:** 12h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-36 | **RNF:** RNF-17

---

### HU-37: Informe Anual de KPIs
**Como** directivo del GAMLP  
**Quiero** generar un informe anual que integre KPIs de las 7 áreas ambientales  
**Para** facilitar la toma de decisiones estratégicas

**Criterios de Aceptación:**
- [ ] Resumen ejecutivo por cada área (7)
- [ ] Comparación contra límites Ley 1333 y 755
- [ ] Indicadores clave (KPIs)
- [ ] Exportación PDF/Excel

**Estimación:** 14h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @FidelFlores  
**RF:** RF-37 | **RNF:** RNF-18

---

### HU-38: Formularios con Firma Digital Inmutable
**Como** inspector de campo  
**Quiero** registrar formularios con firma digital inmutable  
**Para** que los reportes de inspección tengan plena validez legal

**Criterios de Aceptación:**
- [ ] Registro no se guarda sin firma válida
- [ ] Datos firmados son inmutables
- [ ] PDF generado incluye sello digital municipal
- [ ] Validación ADSIB

**Estimación:** 12h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @YamilRamos  
**RF:** RF-38 | **RNF:** RNF-17

---

### HU-39: Gestión de Inspecciones CRTV
**Como** encargado del CRTV  
**Quiero** vincular el registro de emisiones al número de placa y deuda tributaria  
**Para** gestionar las inspecciones vehiculares de forma integral

**Criterios de Aceptación:**
- [ ] Interoperabilidad con analizadores de gases
- [ ] Registro vinculado a número de placa
- [ ] Validación de deuda tributaria en tiempo real
- [ ] Historial de inspecciones

**Estimación:** 12h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @LuisLazo  
**RF:** RF-39 | **RNF:** RNF-06

---

### HU-40: Restricción de Acceso por Unidad Técnica
**Como** usuario técnico  
**Quiero** que mi acceso esté restringido a mi unidad de pertenencia  
**Para** evitar la edición accidental de datos de otras áreas ambientales

**Criterios de Aceptación:**
- [ ] Técnico solo edita registros de su área
- [ ] Admin con visión 360°
- [ ] Validación de unidad técnica en cada acción
- [ ] Mensaje de acceso denegado claro

**Estimación:** 8h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @MijaelVega  
**RF:** RF-40 | **RNF:** RNF-01

---

### HU-41: Log de Auditoría Inmutable
**Como** auditor del sistema  
**Quiero** acceder a un log de auditoría inmutable  
**Para** rastrear quién realizó cada modificación en los datos ambientales críticos

**Criterios de Aceptación:**
- [ ] Registro del 100% de acciones de usuario
- [ ] ID de usuario, fecha, hora guardados
- [ ] "Valor Anterior vs. Valor Nuevo" visible
- [ ] Tabla de solo lectura

**Estimación:** 10h | **Prioridad:** Must  
**Estado:** Todo | **Asignado:** @CristhianCepeda  
**RF:** RF-41 | **RNF:** RNF-11

---


# Resumen Consolidado

| Prioridad | Cantidad de HU | Horas Estimadas |
| --------- | -------------- | --------------- |
| Must      | 37             | 380 h           |
| Should    | 3              | 26 h            |
| Could     | 1              | 8 h             |
| Total     | 41             | 414 h           |

---

# Definición de Terminado (Definition of Done)

Una historia de usuario será considerada finalizada cuando:

* El código esté versionado en Git.
* Existan pruebas funcionales y unitarias.
* La funcionalidad haya sido validada por usuarios responsables.
* El despliegue funcione en ambiente QA.
* La documentación técnica esté actualizada.
* El módulo esté integrado al sistema principal.

---

# Planificación General de Sprints

| Sprint       | Periodo       | Historias     | Entregable          |
| ------------ | ------------- | ------------- | ------------------- |
| Sprint 1-2   | Semanas 1-2   | HU-01 a HU-05 | Seguridad y Acceso  |
| Sprint 3-4   | Semanas 3-4   | HU-06 a HU-13 | Gestión Ambiental   |
| Sprint 5-6   | Semanas 5-6   | HU-14 a HU-19 | GIS y Visualización |
| Sprint 7-9   | Semanas 7-9   | HU-20 a HU-34 | Interoperabilidad   |
| Sprint 10-12 | Semanas 10-12 | HU-35 a HU-41 | Auditoría y Cierre  |

---

# Hitos Relacionados al TDR

| Hito          | Fecha Aproximada | Resultado Esperado               |
| ------------- | ---------------- | -------------------------------- |
| Informe 1     | Día 40           | Arquitectura + Módulos Base      |
| Informe 2     | Día 80           | Integraciones + GIS              |
| Informe Final | Día 90           | Sistema funcional + Capacitación |
