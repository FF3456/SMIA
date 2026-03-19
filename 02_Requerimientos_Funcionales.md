# Requerimientos Funcionales 

| ID | Descripción | Prioridad | Criterio de Aceptación |
|----|------------|----------|------------------------|
| RF-01 | Autenticación de usuarios mediante OAuth2/JWT | Must | Token válido y expiración configurable |
| RF-02 | Gestión de usuarios (crear, editar, eliminar) | Must | CRUD funcional |
| RF-03 | Definición de roles (Admin, Técnico, Ciudadano) | Must | Acceso restringido por rol |
| RF-04 | Bloqueo tras 3 intentos fallidos | Must | Usuario bloqueado automáticamente |
| RF-05 | Acceso público sin login | Should | Acceso libre + registro opcional |
| RF-06 | Validación y persistencia de datos | Must | Validación 100% + guardado < 500ms |
| RF-07 | Monitoreo de calidad del aire | Must | Cálculo automático según norma |
| RF-08 | Monitoreo de calidad de agua | Must | Clasificación automática |
| RF-09 | Gestión de residuos | Must | Validación normativa + geolocalización |
| RF-10 | Monitoreo del parque automotor | Must | Datos vinculados a placa |
| RF-11 | Monitoreo acústico | Must | Mapas de calor < 3s |
| RF-12 | Control industrial | Must | Requiere firma digital y evidencia |
| RF-13 | Seguimiento de proyectos ambientales | Must | Alertas automáticas |
| RF-14 | Visor GIS interactivo | Must | Capas activables sin errores |
| RF-15 | Visualización de calidad del aire | Must | Actualización automática |
| RF-16 | Visualización de rutas y zonas | Must | Datos correctos en mapa |
| RF-17 | Visualización de ruido | Must | Mapas de calor funcionales |
| RF-18 | Generación de reportes PDF/Excel | Must | Descarga < 10s con firma digital |
| RF-19 | Portal público de indicadores | Should | Datos actualizados < 24h |
| RF-20 | Sincronización con sensores | Must | Respuesta < 1s |
| RF-21 | Extracción automática de datos | Must | Datos reflejados < 5 min |
| RF-22 | Envío de alertas | Should | Logs automáticos |
| RF-23 | Integración con SIGIR | Must | Estados consistentes |
| RF-24 | Importación de rutas GPS | Must | Visualización en tiempo real |
| RF-25 | Reporte de incidencias | Must | Ticket automático generado |
| RF-26 | Validación de formatos JSON/XML | Must | 100% validación |
| RF-27 | Actualización de normativa | Should | Cambios automáticos |
| RF-28 | Envío de reporte al sistema nacional | Must | Confirmación HTTP 200 |
| RF-29 | Sincronización de denuncias | Must | Categorías iguales |
| RF-30 | Recepción de denuncias | Must | Ticket generado < 2 min |
| RF-31 | Actualización de estado de denuncias | Must | Seguimiento visible |
| RF-32 | Validación geográfica (WGS84) | Must | Error < 0.5 m |
| RF-33 | Importación de predios | Must | Información visible al hacer clic |
| RF-34 | Notificación de zonas restringidas | Should | Estado actualizado |
| RF-35 | Notificaciones por umbrales | Could | Alertas por correo/SMS |
| RF-36 | Validación normativa de residuos | Must | Datos validados + firma digital |
| RF-37 | Informe anual de KPIs | Must | Resumen de 7 áreas |
| RF-38 | Registro con firma digital | Must | Datos inmutables |
| RF-39 | Gestión de inspecciones vehiculares | Must | Integración con emisiones |
| RF-40 | Restricción por unidad técnica | Must | Acceso limitado |
| RF-41 | Log de auditoría | Must | Registro completo de cambios |