# INFORME: FILOSOFÍA, ARQUITECTURA Y PATRONES DE DISEÑO – SMIA (VERSIÓN DETALLADA)

---

# 1. INTRODUCCIÓN

El presente informe describe las decisiones técnicas adoptadas para el desarrollo del **Sistema de Monitoreo de Información Ambiental (SMIA)**, considerando su aplicación práctica dentro del proyecto, la organización del trabajo en equipo y la metodología de desarrollo utilizada.

El documento expone la filosofía de desarrollo seleccionada, la arquitectura implementada, los patrones arquitectónicos y los patrones de diseño aplicados para garantizar escalabilidad, mantenibilidad, desacoplamiento y facilidad de integración entre componentes del sistema.

---

# 2. FILOSOFÍA DE DESARROLLO

## 2.1 Filosofía Elegida: Data-Driven

La filosofía **Data-Driven** se centra en la recolección, validación, procesamiento y análisis de datos como eje principal del sistema.

En el caso del SMIA, esta filosofía resulta adecuada debido a que la plataforma depende directamente del tratamiento de información ambiental proveniente de múltiples fuentes y módulos especializados.

## Justificación de la Filosofía

El SMIA gestiona información relacionada con:

- Calidad del aire
- Calidad del agua
- Gestión de residuos
- Denuncias ambientales
- Monitoreo acústico
- Reportes regulatorios
- Visualización GIS

Todas las funcionalidades principales dependen directamente de los datos procesados por el sistema, entre ellas:

- Registro de mediciones ambientales
- Generación automática de reportes
- Visualización de dashboards e indicadores
- Activación de alertas ambientales
- Integración con plataformas externas
- Análisis histórico de información ambiental

## Beneficios de Aplicar un Enfoque Data-Driven

La implementación de esta filosofía permite:

- Validación rigurosa de datos
- Generación de reportes confiables
- Automatización de procesos y alertas
- Toma de decisiones basada en evidencia
- Integridad y trazabilidad de la información
- Centralización de datos ambientales

## Impacto en el Desarrollo del Proyecto

La filosofía Data-Driven influye directamente en el desarrollo del sistema debido a que:

- Define reglas claras de validación desde las primeras etapas
- Facilita la división modular del trabajo
- Reduce inconsistencias y errores
- Permite escalabilidad orientada a datos
- Mejora la interoperabilidad entre servicios

## Filosofía Complementaria: User-Centered Design

Como complemento, el proyecto adopta principios de **User-Centered Design (UCD)** para el diseño de interfaces y experiencia de usuario.

Este enfoque se aplica principalmente en:

- Mockups
- Formularios
- Dashboards
- Visualizaciones GIS
- Portal ciudadano

El objetivo es garantizar interfaces intuitivas y accesibles para usuarios técnicos y ciudadanos.

---

# 3. ARQUITECTURA

## 3.1 Arquitectura Combinada: Capas + Microservicios

El SMIA implementa una arquitectura híbrida basada en:

- Arquitectura de Microservicios
- Arquitectura en Capas

La combinación de ambos enfoques permite desacoplamiento, mantenibilidad y escalabilidad.

A nivel global, el sistema se organiza como un conjunto de microservicios independientes.

A nivel interno, cada microservicio implementa una arquitectura en capas.

---

## 3.2 Organización en Microservicios (Nivel Macro)

El sistema se divide en servicios independientes organizados por dominio funcional:

- Servicio de Seguridad
- Servicio Ambiental
- Servicio de Ciudadanía
- Servicio GIS
- Servicio de Reportes
- Servicio de Interoperabilidad

Cada microservicio:

- Posee lógica de negocio independiente
- Tiene autonomía funcional
- Expone APIs REST
- Puede desplegarse de forma individual
- Puede escalar independientemente
- Mantiene desacoplamiento con otros servicios

## Beneficios de los Microservicios

- Escalabilidad selectiva
- Desarrollo paralelo por equipos
- Menor acoplamiento
- Facilidad de mantenimiento
- Mayor tolerancia a fallos
- Despliegues independientes

---

## 3.3 Arquitectura en Capas (Nivel Interno)

Cada microservicio implementa internamente una arquitectura basada en capas:

- Capa de Presentación
- Capa de Lógica de Negocio
- Capa de Acceso a Datos

### Capa de Presentación

Responsable de:

- Exposición de endpoints REST
- Recepción de solicitudes HTTP
- Validación inicial de datos
- Manejo de respuestas JSON

### Capa de Lógica de Negocio

Responsable de:

- Aplicación de reglas ambientales
- Procesamiento de información
- Validaciones regulatorias
- Automatización de alertas
- Gestión de flujos funcionales

### Capa de Acceso a Datos

Responsable de:

- Persistencia de información
- Consultas a base de datos
- Manejo de repositorios
- Integridad de datos

---

## 3.4 Beneficios de Combinar Ambos Enfoques

La combinación de microservicios y arquitectura en capas proporciona:

- Separación clara de responsabilidades
- Organización interna limpia
- Desarrollo modular
- Escalabilidad horizontal
- Reutilización de componentes
- Facilidad de pruebas
- Integración sencilla con CI/CD

Además, esta arquitectura facilita la evolución futura del sistema.

---

## 3.5 Consideraciones Técnicas

La arquitectura considera los siguientes aspectos técnicos:

- Comunicación entre servicios mediante APIs REST
- Posible despliegue mediante Docker
- Integración con pipelines CI/CD
- Autenticación centralizada
- Logging distribuido
- Integración GIS
- Interoperabilidad con plataformas externas

---

# 4. PATRÓN ARQUITECTÓNICO

## 4.1 Patrón Principal: MVC

Cada microservicio implementa internamente el patrón arquitectónico **MVC (Model-View-Controller)**.

### Componentes MVC

#### Model

Encargado de:

- Representación de entidades
- Persistencia
- Reglas de negocio
- Validaciones

#### View

Representado mediante:

- Respuestas JSON
- APIs REST
- Serialización de datos

#### Controller

Responsable de:

- Gestión de peticiones HTTP
- Coordinación del flujo del sistema
- Comunicación entre capas

## Justificación del Uso de MVC

MVC permite:

- Separación de responsabilidades
- Organización estructurada
- Facilidad de mantenimiento
- Escalabilidad interna
- Reutilización de componentes

---

## 4.2 Patrón Complementario: MVVM (Frontend)

En el frontend desarrollado con Angular se aplica el patrón **MVVM (Model-View-ViewModel)**.

### Beneficios del MVVM

- Mejor interacción con datos
- Sincronización automática de interfaces
- Gestión eficiente de estados
- Separación entre lógica y presentación
- Mayor mantenibilidad del frontend

Este patrón resulta especialmente útil para:

- Dashboards ambientales
- Formularios dinámicos
- Visualizaciones GIS
- Indicadores en tiempo real

---

# 5. PATRONES DE DISEÑO

## 5.1 Observer

El patrón **Observer** se utiliza en:

- Alertas ambientales
- Notificaciones
- Eventos del sistema
- Actualización de dashboards

### Beneficios

- Reacción automática a eventos
- Desacoplamiento entre componentes
- Actualización en tiempo real
- Automatización de procesos

---

## 5.2 Factory Method

El patrón **Factory Method** se aplica en:

- Generación de reportes
- Creación de tipos de medición
- Generación de objetos especializados

### Beneficios

- Código desacoplado
- Facilidad de extensión
- Reutilización de lógica
- Reducción de dependencias

---

## 5.3 Singleton

El patrón **Singleton** se utiliza en:

- Configuraciones globales
- Gestión de conexiones
- Configuración por servicio
- Recursos compartidos

### Beneficios

- Control centralizado
- Optimización de recursos
- Gestión eficiente de instancias
- Consistencia de configuración

---

# 6. CONCLUSIONES

El SMIA implementa una arquitectura híbrida basada en microservicios y arquitectura en capas, permitiendo:

- Escalabilidad
- Modularidad
- Separación de responsabilidades
- Desarrollo paralelo
- Integración eficiente
- Mantenibilidad
- Automatización de procesos

La filosofía Data-Driven proporciona una base sólida para el manejo de información ambiental crítica, permitiendo validaciones rigurosas y toma de decisiones basada en datos.

Además, los patrones arquitectónicos y de diseño seleccionados garantizan:

- Flexibilidad
- Bajo acoplamiento
- Extensibilidad
- Reutilización de componentes
- Adaptabilidad futura

La arquitectura propuesta se adapta adecuadamente al contexto del proyecto SMIA y facilita futuras integraciones tecnológicas.

---
## Arquitectura de Despliegue del SMIA

![DD-Despliegue](Diagramas/DIAGRAMA-DESPLIEGUE.png)

Fuente: Elaboración propia.

# 7. RESUMEN FINAL

| Elemento | Implementación |
|---|---|
| Filosofía | Data-Driven |
| Arquitectura | Microservicios + Capas |
| Patrón Arquitectónico | MVC + MVVM |
| Patrones de Diseño | Observer, Factory Method, Singleton |
