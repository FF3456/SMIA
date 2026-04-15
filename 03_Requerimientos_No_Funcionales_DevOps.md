# REQUERIMIENTOS NO FUNCIONALES (RNF)

| ID       | Categoría        | Prioridad | Métrica de Éxito / Estándar |
|----------|----------------|----------|------------------------------|
| RNF-01   | Seguridad       | Must     | Implementación de HTTPS (TLS 1.3), hashing Bcrypt y MFA para roles administrativos. |
| RNF-02   | Rendimiento     | Must     | Carga de mapas con 10k registros en < 3s; consultas en < 2s. |
| RNF-03   | Usabilidad      | Should   | 90% de usuarios internos completan tareas clave sin capacitación formal. |
| RNF-04   | Disponibilidad  | Must     | Uptime del 99.5% mensual; mantenimiento programado en horario no laboral. |
| RNF-05   | Compatibilidad  | Must     | Diseño responsive compatible con Chrome, Firefox y Edge (últimas 2 versiones). |
| RNF-06   | Interoperabilidad | Must   | Cumplimiento de estándares OGC para GIS y formato JSON/XML para APIs. |
| RNF-07   | Escalabilidad   | Should   | Soporte para 500 usuarios concurrentes y 100k registros sin degradación. |
| RNF-08   | Accesibilidad   | Must     | Cumplimiento del nivel AA del estándar WCAG 2.1; contraste 4.5:1. |
| RNF-09   | Tecnología      | Must     | Stack basado en herramientas Open Source (PostgreSQL, Linux, Docker). No licencias pagas. |
| RNF-10   | Rendimiento GIS | Must     | Capas GIS (Aire, Residuos, Ruido, etc.) renderizadas completamente en < 3s. |
| RNF-11   | Trazabilidad    | Must     | Registro (Logs) del 100% de las acciones de usuario para auditoría técnica. |
| RNF-12   | Integridad      | Must     | Garantía de integridad de datos ambientales durante almacenamiento y procesamiento. |
| RNF-13   | Persistencia    | Must     | Consulta de datos históricos (5 gestiones) recuperados en < 5s. |
| RNF-14   | Concurrencia    | Should   | Estabilidad bajo manipulación de múltiples capas geoespaciales simultáneas. |
| RNF-15   | DevOps/Resiliencia | Must  | Backups diarios automáticos y Plan de recuperación ante desastres (DRP). |
| RNF-16   | Versionamiento  | Should   | Mantenimiento de versiones de datos para control de cambios e historial. |
| RNF-17   | Legal / Normativo | Must   | Cumplimiento total con Ley 755, Ley 1333 y estándares de la ADSIB. |

---

# REQUERIMIENTOS NO FUNCIONALES DEVOPS

| ID           | Categoría                | Descripción Técnica | Métrica de Éxito |
|--------------|--------------------------|--------------------|------------------|
| RNF-DEV-01   | CI/CD                   | Implementación de un pipeline de Integración y Despliegue Continuo automatizado para el SMIA. | Despliegue exitoso sin intervención manual en < 10 min. |
| RNF-DEV-02   | Control de versiones     | Gestión de todo el código fuente, scripts de base de datos y configuración en repositorios Git (GitLab/GitHub). | 100% del código fuente versionado y disponible para auditoría. |
| RNF-DEV-03   | Automatización de pruebas | Ejecución obligatoria de pruebas unitarias y de integración en cada ciclo de despliegue. | Cobertura de pruebas ≥ 80%. |
| RNF-DEV-04   | Entornos                | Segregación total de entornos de trabajo para evitar contaminación de datos. | Entornos Dev, QA y Producción con 0 conflictos. |
| RNF-DEV-05   | Contenerización         | Empaquetamiento de la aplicación (Laravel/Angular) mediante contenedores Docker. | Despliegue reproducible y consistente. |
| RNF-DEV-06   | Monitoreo              | Implementación de herramientas de monitoreo en tiempo real. | Alertas automáticas en < 1 min ante fallos críticos. |
| RNF-DEV-07   | Logging centralizado    | Recolección y centralización de logs de aplicación, base de datos y servidor. | 100% de trazabilidad de eventos y errores. |
| RNF-DEV-08   | Seguridad DevOps        | Gestión cifrada de credenciales, tokens y secretos (Vault/Secrets). | 0 exposición de credenciales en el código. |
| RNF-DEV-09   | Escaneo de vulnerabilidades | Análisis automático del código y dependencias (SAST/DAST). | 0 vulnerabilidades críticas antes de producción. |
| RNF-DEV-10   | Backup automatizado     | Copias de seguridad automáticas de PostgreSQL y archivos. | Backup diario exitoso con verificación de integridad. |
| RNF-DEV-11   | Recuperación           | Definición y prueba de un Plan de Recuperación ante Desastres. | Tiempo de restauración < 1 hora. |
| RNF-DEV-12   | Infraestructura como Código | Definición de infraestructura mediante scripts (Terraform/Ansible). | Infraestructura 100% reproducible. |
