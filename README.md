# Halcón Pedidos Web

Sistema web para la gestión y seguimiento de pedidos, desarrollado como parte de la evidencia práctica del curso. Permite administrar usuarios, pedidos y consultar el estado de entregas mediante un sistema basado en roles.

---

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
  - En proceso → muestra estado y fecha
  - En ruta → muestra información del proceso
  - Entregado → muestra evidencia (imagen)

---

### Usuario registrado

#### Dashboard
- Panel principal con acceso a módulos

---

### Gestión de usuarios

- Listado de usuarios (activos e inactivos)
- Creación de usuarios con asignación de rol/departamento
- Edición de datos del usuario
- Activación / desactivación de usuarios

---

### Gestión de pedidos

- Listado de pedidos (ordenados del más reciente al más antiguo)
- Crear pedidos
- Editar pedidos
- Cambiar estado del pedido:
  - En proceso
  - En ruta (permite subir evidencia)
  - Entregado (permite subir evidencia)
- Visualizar detalles del pedido
- Eliminación lógica (soft delete)

---

### Pedidos archivados

- Listado de pedidos eliminados
- Restauración de pedidos eliminados

---

## Base de datos

El sistema incluye:

- Migraciones con relaciones entre entidades
- Llaves primarias y foráneas
- Seeders para generación de datos de prueba

---

## Datos de prueba

Se incluyen seeders/factories para poblar la base de datos con información inicial para pruebas.

---

##  Instalación y ejecución

1. Clonar el repositorio:

```bash
git clone https://github.com/eltavo321/halcon-pedidos-web.git
