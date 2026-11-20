# Mini Proyecto 1 — PHP

Sitio de demostración de conceptos de PHP del lado del servidor. Está compuesto por seis páginas ejecutables, comparte una cabecera y un menú comunes, y muestra en pantalla el resultado real de cada ejemplo. No necesita persistencia externa ni control de acceso.

## Integrantes del equipo

Manuel de Jesus Flores de la Cruz

Sebastian Emiliano Anzueto Escobar

Cesar Francisco Salazar Sanchez

## Materia

Programación Web — Unidad 4

Programación del lado del servidor con PHP.

## Descripción del proyecto

Cada página presenta un tema de PHP con ejemplos que se ejecutan al cargar la página: declaración de variables, evaluación de condiciones, recorridos con bucles, trabajo con arreglos y manejo de sesiones. La navegación es común a todo el sitio y la información de la sesión se muestra en todas las páginas.

El proyecto no usa base de datos, formularios, inicio de sesión ni guardado de archivos. Toda la información se genera en cada petición; la sesión se emplea solo para registrar la hora de inicio, la hora actual y el tiempo activo.

## Temas PHP implementados

- Variables y tipos de datos: declaración con `$`, tipos `string`, `int`, `float`, `boolean` y `array`; salida con `echo`, fechas con `date()` y conteo de elementos con `count()`.
- Estructuras de control: `if`, `elseif`, `else` y `switch`, evaluados con variables y arreglos.
- Bucles: `for` para una tabla de multiplicar, `while` para una secuencia y `foreach` para recorrer arreglos.
- Arreglos: indexado, asociativo y multidimensional, con una condición dentro del recorrido con `foreach`.
- Sesiones: inicio protegido con `session_start()` y `session_status()`, datos persistentes en `$_SESSION`, control de tiempo con `time()` y reinicio con `session_destroy()`.

## Estructura del proyecto

```
/
├── index.php              Inicio y reinicio de la sesión
├── variables.php          Variables y tipos de datos
├── condicionales.php      if, elseif, else y switch
├── bucles.php             for, while y foreach
├── arreglos.php           Arreglos indexado, asociativo y multidimensional
├── sesiones.php           Contador persistente y control de tiempo
├── config/
│   └── app.php            Inicio de sesión y función escapar()
├── includes/
│   ├── header.php         Cabecera HTML común
│   ├── menu.php           Menú y bloque de sesión
│   └── footer.php         Pie de página común
├── css/
│   └── styles.css         Estilos del sitio
└── img/
    └── .gitkeep           Carpeta de imágenes del proyecto
```

## Cómo ejecutarlo

1. Ubicarse en la raíz del proyecto.
2. Ejecutar `php -S localhost:8000`.
3. Abrir `http://localhost:8000/index.php` en el navegador.

No es necesario configurar una base de datos ni ejecutar scripts de instalación.

## Requisitos

- PHP 8 o superior.
- Servidor con sesiones habilitadas.
- Sin base de datos.
