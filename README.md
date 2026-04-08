# Halcón Pedidos Web

Sistema web para la gestión y seguimiento de pedidos, desarrollado como parte de la evidencia práctica del curso. Permite administrar usuarios, pedidos y consultar el estado de entregas mediante un sistema basado en roles.

---

## 📚 Documentación del proyecto

📄 Documentación completa:
- https://docs.google.com/document/d/1Bqt3jw_ud83PJtv1vuXBGRjAG3vOSVKEF8qBMSYn3jI/edit?usp=sharing

## Descripción del proyecto

Este sistema permite:

- Gestionar usuarios con roles o departamentos
- Crear, editar y administrar pedidos
- Consultar pedidos mediante número de factura
- Controlar estados del pedido (en proceso, en ruta, entregado)
- Subir evidencia fotográfica en entregas
- Manejar eliminación lógica (soft delete) y recuperación de pedidos

---

## Tecnologías utilizadas

- PHP
- Laravel
- MySQL
- Blade (vistas)
- HTML / CSS básico

---

## Funcionalidades principales

### Usuario no registrado

- Página principal con búsqueda por número de factura
- Visualización del estado del pedido:
  - En proceso
  - En ruta
  - Entregado (con evidencia)

---

### Usuario registrado

#### Dashboard
- Panel principal con acceso a módulos

---

### Gestión de usuarios

- Listado de usuarios (activos e inactivos)
- Creación de usuarios con rol/departamento
- Edición de datos
- Activación / desactivación

---

### Gestión de pedidos

- Listado ordenado por fecha
- Crear y editar pedidos
- Cambio de estado:
  - En proceso
  - En ruta (con evidencia)
  - Entregado (con evidencia)
- Visualización de detalles
- Eliminación lógica (soft delete)

---

### Pedidos archivados

- Visualización de pedidos eliminados
- Restauración de registros

---

## Base de datos

- Migraciones con relaciones entre entidades
- Llaves primarias y foráneas
- Seeders y factories para datos de prueba

---

## Instalación y ejecución

```bash
git clone https://github.com/eltavo321/halcon-pedidos-web.git