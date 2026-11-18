# Agenda de Contactos

## Integrantes del equipo

- _(nombre del integrante 1)_
- _(nombre del integrante 2)_

## Materia

Programacion Web - Unidad 4: Programacion del lado del servidor con PHP

## Descripcion

Aplicacion web dinamica para gestionar una agenda de contactos con operaciones CRUD completas (Crear, Leer, Actualizar, Eliminar), desarrollada en PHP con base de datos MySQL y conexion mediante PDO.

## Tecnologias utilizadas

- PHP 8
- MySQL / MariaDB
- PDO con sentencias preparadas
- HTML5 y CSS3

## Funcionalidades implementadas

- Listado de contactos con busqueda (index.php)
- Alta de contacto con formulario validado en cliente y servidor (crear.php / guardar.php)
- Detalle de un contacto (ver.php)
- Edicion de contacto (editar.php / actualizar.php)
- Eliminacion con confirmacion via POST (eliminar.php)
- Subida de foto obligatoria a uploads/
- Salida sanitizada con htmlspecialchars()

## Base de datos

Ejecutar el archivo `database/agenda.sql` para crear la base de datos `agenda` y la tabla `contactos`.

La conexion se configura en `config/db.php`.

## Estructura

```
/
├── index.php        // Listado + busqueda (READ)
├── crear.php        // Formulario de creacion (CREATE vista)
├── guardar.php      // Procesa INSERT (CREATE logica)
├── editar.php       // Formulario de edicion (UPDATE vista)
├── actualizar.php   // Procesa UPDATE (UPDATE logica)
├── ver.php          // Detalle de contacto (READ individual)
├── eliminar.php     // Eliminacion con confirmacion (DELETE)
├── database/
│   └── agenda.sql   // Esquema de la base de datos
├── config/
│   └── db.php       // Conexion PDO
├── includes/
│   ├── header.php
│   ├── menu.php
│   └── footer.php
├── css/
│   └── styles.css
└── uploads/         // Fotos de contactos
```
