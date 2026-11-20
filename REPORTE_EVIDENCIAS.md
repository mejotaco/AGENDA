# Reporte de Evidencias Técnicas

**Materia:** Programación Web
**Unidad:** Unidad 4 — Programación del lado del servidor con PHP
**Actividad:** Mini Proyecto 1 — modalidad en equipo
**Integrantes:**

- Manuel de Jesus Flores de la Cruz
- Sebastian Emiliano Anzueto Escobar
- Cesar Francisco Salazar Sanchez

**Sistema:** sitio web de demostración de conceptos de PHP del lado del servidor, sin base de datos, sin formularios y sin inicio de sesión de usuarios.

---

## Entregas finales

- Link del repositorio público en GitHub: `[pendiente de agregar]`
- Link del sistema publicado en Internet: `[pendiente de agregar]`
- Reporte PDF de evidencias: `Reporte_Evidencias.pdf`

---

## Especificación 1 — Uso de variables

### 1. Captura del código fuente

`[img evidencia01_variables_codigo — editor mostrando variables.php, líneas 7-14]`

```php
$nombre = 'Ana Torres';
$edad = 20;
$promedio = 8.75;
$esEstudiante = true;
$materias = ['PHP', 'HTML', 'CSS'];

$fechaActual = date('d/m/Y H:i:s');
$cantidadMaterias = count($materias);
```

Archivo: `variables.php`, líneas 7–14.

### 2. Captura de ejecución

`[img evidencia01_variables_ejecucion — navegador con URL https://<dominio-publico>/variables.php y la tabla "Valores ejecutados en esta página"]`

En la pantalla se observan los valores de las variables impresos directamente con `echo` dentro de la tabla: `Ana Torres`, `20`, `8.75`, `true` y `PHP, HTML, CSS`. La fecha y la cantidad de materias también aparecen calculadas en tiempo de ejecución.

### 3. Explicación técnica

En `variables.php` declaramos `$nombre`, `$edad`, `$promedio`, `$esEstudiante` y `$materias`. PHP no pide declarar el tipo: lo decide según el valor asignado. Los tres primeros guardan los datos de una persona, `$esEstudiante` guarda un estado y `$materias` agrupa varias materias.

Para mostrarlos usamos `echo`. También llamamos a `date()` para la fecha del servidor y a `count($materias)` para saber cuántos elementos tiene el arreglo. Los datos simples quedaron en variables escalares y las materias en un arreglo indexado.

---

## Especificación 2 — Tipos de datos

### 1. Captura del código fuente

`[img evidencia02_tipos_codigo — editor mostrando variables.php, líneas 16-22 y 47-54]`

```php
$tipos = [
    ['tipo' => 'string', 'variable' => '$nombre', 'valor' => $nombre, 'uso' => 'Almacena texto, como nombres, mensajes o etiquetas.'],
    ['tipo' => 'int', 'variable' => '$edad', 'valor' => $edad, 'uso' => 'Almacena números enteros, como edades o cantidades.'],
    ['tipo' => 'float', 'variable' => '$promedio', 'valor' => $promedio, 'uso' => 'Almacena números con decimales, como promedios o medidas.'],
    ['tipo' => 'boolean', 'variable' => '$esEstudiante', 'valor' => var_export($esEstudiante, true), 'uso' => 'Almacena verdadero o falso para representar estados.'],
    ['tipo' => 'array', 'variable' => '$materias', 'valor' => implode(', ', $materias), 'uso' => 'Agrupa varios valores bajo una misma variable.'],
];
```

```php
<?php foreach ($tipos as $dato): ?>
    <tr>
        <td><span class="type"><?php echo escapar($dato['tipo']); ?></span></td>
        <td><code class="code"><?php echo escapar($dato['variable']); ?></code></td>
        <td><span class="value"><?php echo escapar($dato['valor']); ?></span></td>
        <td><?php echo escapar($dato['uso']); ?></td>
    </tr>
<?php endforeach; ?>
```

Archivo: `variables.php`, líneas 16–22 y 47–54.

### 2. Captura de ejecución

`[img evidencia02_tipos_ejecucion — navegador con URL https://<dominio-publico>/variables.php y la tabla con columnas Tipo, Variable, Valor mostrado con echo y Función del tipo]`

La tabla muestra las cinco filas correspondientes a `string`, `int`, `float`, `boolean` y `array`. Para el tipo boolean se usa `var_export()` para convertir `true` en texto visible, y para el arreglo se usa `implode()` para unir sus elementos en una sola cadena.

### 3. Explicación técnica

Los cinco tipos pedidos están en `$tipos`: `string`, `int`, `float`, `boolean` y `array`. Cada fila guarda el tipo, el nombre de la variable, el valor y una breve descripción de para qué sirve.

El arreglo se recorre con `foreach` y cada vuelta escribe una fila de la tabla con `echo`. El valor de `boolean` se convierte con `var_export()` para que se vea `true` como texto, y `$materias` se une con `implode()`. La salida pasa por `escapar()`, que aplica `htmlspecialchars()` para no inyectar HTML.

---

## Especificación 3 — Uso de `if`

### 1. Captura del código fuente

`[img evidencia03_if_codigo — editor mostrando condicionales.php, líneas 11-25]`

```php
if ($nota >= 18) {
    $calificacion = 'Excelente';
} elseif ($nota >= 14) {
    $calificacion = 'Satisfactoria';
} elseif ($nota >= 11) {
    $calificacion = 'En proceso';
} else {
    $calificacion = 'Necesita refuerzo';
}

if ($asistencia >= 80) {
    $mensajeAsistencia = 'La asistencia es suficiente según el criterio definido.';
} else {
    $mensajeAsistencia = 'La asistencia está por debajo del criterio definido.';
}
```

Archivo: `condicionales.php`, líneas 11–25.

### 2. Captura de ejecución

`[img evidencia03_if_ejecucion — navegador con URL https://<dominio-publico>/condicionales.php y la sección "Cadena if / elseif / else ejecutada"]`

Con `$nota = 16` el resultado mostrado es `Satisfactoria`, porque la condición `>= 18` es falsa y la condición `>= 14` es verdadera. Con `$asistencia = 92` se muestra el mensaje de asistencia suficiente.

### 3. Explicación técnica

Para clasificar `$nota` usamos una cadena `if / elseif / else`. PHP revisa las condiciones en orden y se queda con la primera que se cumple; por eso `16` cae en `Satisfactoria` y no en la última rama. El `else` queda para cuando ningún rango aplica.

Además hay un `if / else` para `$asistencia` con `>= 80`. Los resultados `$calificacion` y `$mensajeAsistencia` se imprimen más adelante, así que en la página se ve qué decisión tomó el código.

---

## Especificación 4 — Uso de `switch`

### 1. Captura del código fuente

`[img evidencia04_switch_codigo — editor mostrando condicionales.php, líneas 27-53]`

```php
$dia = (int) date('N');
switch ($dia) {
    case 1:
        $nombreDia = 'lunes';
        break;
    case 2:
        $nombreDia = 'martes';
        break;
    case 3:
        $nombreDia = 'miércoles';
        break;
    case 4:
        $nombreDia = 'jueves';
        break;
    case 5:
        $nombreDia = 'viernes';
        break;
    case 6:
        $nombreDia = 'sábado';
        break;
    case 7:
        $nombreDia = 'domingo';
        break;
    default:
        $nombreDia = 'día no identificado';
        break;
}
```

Archivo: `condicionales.php`, líneas 27–53.

### 2. Captura de ejecución

`[img evidencia04_switch_ejecucion — navegador con URL https://<dominio-publico>/condicionales.php y la sección "switch ejecutado sobre (int) date('N')"]`

Se muestran dos datos: el valor numérico del día, obtenido de `date('N')`, y el nombre del día calculado por el `switch`. Al cambiar el día del sistema, la salida cambia sola porque la comparación se hace en tiempo de ejecución.

### 3. Explicación técnica

El `switch` compara `$dia`, que sale de `(int) date('N')`, con los siete días de la semana. Cada `case` asigna el nombre y cierra con `break`; si no hubiera `break`, la ejecución seguiría con los casos siguientes. `default` cubre valores fuera de 1 a 7.

Como todas las ramas comparan la misma variable, el `switch` queda más claro que una cadena larga de `elseif`. El nombre resultante se guarda en `$nombreDia` y se muestra con `echo`.

---

## Especificación 5 — Uso de `for`

### 1. Captura del código fuente

`[img evidencia05_for_codigo — editor mostrando bucles.php, líneas 35-41]`

```php
<?php for ($i = 1; $i <= 10; $i++): ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><code class="code"><?php echo $i . ' × ' . $base; ?></code></td>
        <td><span class="value"><?php echo $i * $base; ?></span></td>
    </tr>
<?php endfor; ?>
```

Archivo: `bucles.php`, líneas 35–41. La variable `$base = 7` se define en la línea 7 del mismo archivo.

### 2. Captura de ejecución

`[img evidencia05_for_ejecucion — navegador con URL https://<dominio-publico>/bucles.php y la tabla "Tabla de multiplicar generada con for"]`

La tabla contiene diez filas generadas dinámicamente: `1 × 7 = 7`, `2 × 7 = 14`, hasta `10 × 7 = 70`. El contenido no está escrito a mano en el HTML.

### 3. Explicación técnica

El bucle `for` tiene las tres partes claras: `$i = 1`, `$i <= 10` e `$i++`. Eso da diez vueltas. En cada una multiplico `$i * $base` (con `$base = 7`) y escribo una fila `<tr>` de la tabla.

Usé la forma alternativa `for / endfor` para mezclar HTML y `echo` sin llaves. Aquí se sabe de antemano cuántas iteraciones habrá, por eso `for` encaja mejor que `while`.

---

## Especificación 6 — Uso de `while`

### 1. Captura del código fuente

`[img evidencia06_while_codigo — editor mostrando bucles.php, líneas 48-52]`

```php
<?php $contador = 1; ?>
<?php while ($contador <= 5): ?>
    <li>Iteración <span class="value"><?php echo $contador; ?></span> del bucle <code class="code">while</code>.</li>
    <?php $contador++; ?>
<?php endwhile; ?>
```

Archivo: `bucles.php`, líneas 48–52.

### 2. Captura de ejecución

`[img evidencia06_while_ejecucion — navegador con URL https://<dominio-publico>/bucles.php y la sección "Secuencia generada con while"]`

Aparece una lista con cinco elementos, de la iteración 1 a la iteración 5. Cada línea se genera en el servidor durante la petición.

### 3. Explicación técnica

El contador empieza en 1 y la condición `$contador <= 5` se revisa antes de cada vuelta. El incremento `$contador++` está dentro del cuerpo, así que la condición acaba siendo falsa y el bucle no se queda colgado.

Escribimos la forma `while / endwhile` y dentro voy emitiendo los `<li>` con `echo`. A diferencia de `for`, aquí el número de repeticiones depende de una condición que cambia mientras corre el ciclo.

---

## Especificación 7 — Uso de `foreach`

### 1. Captura del código fuente

`[img evidencia07_foreach_codigo — editor mostrando bucles.php, líneas 58-60]`

```php
<?php foreach ($tareas as $indice => $tarea): ?>
    <li><span class="badge"><?php echo $indice + 1; ?></span> <?php echo escapar($tarea); ?></li>
<?php endforeach; ?>
```

Archivo: `bucles.php`, líneas 58–60. El arreglo `$tareas` se declara en las líneas 8–13 del mismo archivo.

### 2. Captura de ejecución

`[img evidencia07_foreach_ejecucion — navegador con URL https://<dominio-publico>/bucles.php y la sección "Lista de tareas recorrida con foreach"]`

Se muestra una lista numerada del 1 al 4 con las tareas reales del arreglo. El número se obtiene de la clave del arreglo sumando 1, porque los índices empiezan en cero.

### 3. Explicación técnica

Con `foreach ($tareas as $indice => $tarea)` no hace falta conocer el tamaño del arreglo: PHP entrega la clave en `$indice` y el valor en `$tarea` en cada vuelta. La clave se usa para numerar (`$indice + 1`, porque empieza en cero) y el valor se imprime con `escapar()`.

También usamos `foreach / endforeach`. El mismo recorrido aparece en `arreglos.php` con arreglos asociativos y multidimensionales; es el ciclo natural cuando lo que quieres es recorrer un arreglo.

---

## Especificación 8 — Uso de arreglos

### 1. Captura del código fuente

`[img evidencia08_arreglos_codigo — editor mostrando arreglos.php, líneas 7-12 y 45-50]`

```php
$colores = ['Rojo', 'Verde', 'Azul'];
$estudiante = [
    'nombre' => 'Ana Torres',
    'edad' => 20,
    'ciudad' => 'Guatemala',
];
```

```php
<?php foreach ($estudiante as $clave => $valor): ?>
    <tr>
        <td><code class="code"><?php echo escapar($clave); ?></code></td>
        <td><span class="value"><?php echo escapar($valor); ?></span></td>
    </tr>
<?php endforeach; ?>
```

Archivos y líneas: `arreglos.php`, líneas 7–12 y 45–50.

### 2. Captura de ejecución

`[img evidencia08_arreglos_ejecucion — navegador con URL https://<dominio-publico>/arreglos.php mostrando la lista de colores y la tabla Clave/Valor del arreglo asociativo]`

La página muestra, por un lado, los tres colores del arreglo indexado y, por otro, una tabla con las claves `nombre`, `edad` y `ciudad` y sus valores correspondientes.

### 3. Explicación técnica

`$colores` es indexado: las posiciones las pone PHP automáticamente (`0`, `1`, `2`) y se declara con `[...]`. `$estudiante` es asociativo: usa claves con nombre (`nombre`, `edad`, `ciudad`) con `clave => valor`, lo que hace más claro leer cada dato.

Ambos se recorren con `foreach` y se imprimen con `echo`. En el asociativo tomamos clave y valor al mismo tiempo para armar la tabla. Toda la salida pasa por `escapar()`.

---

## Especificación 9 — Uso de arreglo multidimensional

### 1. Captura del código fuente

`[img evidencia09_multidimensional_codigo — editor mostrando arreglos.php, líneas 13-17 y 65-77]`

```php
$servicios = [
    ['nombre' => 'Desarrollo en PHP', 'activo' => true],
    ['nombre' => 'Mantenimiento de HTML', 'activo' => false],
    ['nombre' => 'Diseño con CSS', 'activo' => true],
];
```

```php
<?php foreach ($servicios as $servicio): ?>
    <tr>
        <td><?php echo escapar($servicio['nombre']); ?></td>
        <td>
            <?php if ($servicio['activo']): ?>
                <span class="badge badge-activo">Activo</span>
            <?php else: ?>
                <span class="badge badge-inactivo">Inactivo</span>
            <?php endif; ?>
        </td>
        <td><?php echo escapar($servicio['activo'] ? 'Disponible en el proyecto actual' : 'No disponible en el proyecto actual'); ?></td>
    </tr>
<?php endforeach; ?>
```

Archivo: `arreglos.php`, líneas 13–17 y 65–77.

### 2. Captura de ejecución

`[img evidencia09_multidimensional_ejecucion — navegador con URL https://<dominio-publico>/arreglos.php y la tabla "Arreglo multidimensional con condición dentro del foreach"]`

La tabla tiene tres filas. `Desarrollo en PHP` y `Diseño con CSS` aparecen con la etiqueta verde `Activo`, mientras que `Mantenimiento de HTML` aparece con la etiqueta roja `Inactivo`.

### 3. Explicación técnica

`$servicios` es un arreglo de tres arreglos asociativos con las claves `nombre` y `activo`. Para llegar a un dato hay dos niveles, por ejemplo `$servicio['nombre']` dentro del recorrido. Así se representan varios registros con los mismos campos.

Dentro del `foreach` pusimos un `if / else` sobre `$servicio['activo']` para elegir la etiqueta y el texto de detalle. Con eso se cumple la condición de usar condicionales dentro del recorrido y la tabla se arma con datos reales.

---

## Especificación 10 — Uso de sesiones PHP para controlar tiempo activo

### 1. Captura del código fuente

`[img evidencia10_sesiones_codigo — editor mostrando index.php líneas 1-30, config/app.php líneas 1-10 e includes/menu.php líneas 1-6]`

```php
// index.php, líneas 1-30
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$reiniciado = isset($_GET['reiniciar']);

if ($reiniciado) {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $parametrosCookie = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $parametrosCookie['path'],
            $parametrosCookie['domain'],
            $parametrosCookie['secure'],
            $parametrosCookie['httponly']
        );
    }

    session_destroy();
    session_start();
    session_regenerate_id(true);
    $_SESSION['inicio'] = time();
}

require_once __DIR__ . '/config/app.php';
```

```php
// config/app.php, líneas 1-10
date_default_timezone_set('America/Mexico_City');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['inicio'])) {
    $_SESSION['inicio'] = time();
}
```

```php
// includes/menu.php, líneas 1-6
$inicio = $_SESSION['inicio'];
$ahora = time();
$activo = $ahora - $inicio;
$minutos = intdiv($activo, 60);
$segundos = $activo % 60;
```

```php
// sesiones.php, líneas 11-14
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
}
$_SESSION['contador']++;
```

Archivos y líneas: `index.php` 1–30, `config/app.php` 1–10, `includes/menu.php` 1–6 y `sesiones.php` 11–14.

### 2. Captura de ejecución

`[img evidencia10_sesiones_ejecucion — navegador con URL https://<dominio-publico>/sesiones.php, bloque de sesión visible con Hora inicio sesión, Hora actual y Tiempo activo, y contador persistente]`

El bloque visible en todas las páginas muestra, por ejemplo:

```text
Hora inicio sesión: 16:38:06
Hora actual: 16:42:41
Tiempo activo: 4 minutos 35 segundos
```

Al recargar `sesiones.php`, el contador persistente pasa de 1 a 2. Al pulsar `REINICIAR LA SESION` en `index.php`, el tiempo activo vuelve a `0 minutos 0 segundos` y aparece el mensaje de reinicio.

### 3. Explicación técnica

La hora de inicio se guarda en `$_SESSION['inicio']` con `time()`. `config/app.php` llama a `session_start()` solo si no hay una sesión activa y crea ese valor una sola vez, así que la información sobrevive al cambio de página sin base de datos: el navegador solo conserva el identificador de sesión.

La hora actual se toma con otro `time()` y la diferencia se parte en minutos con `intdiv($activo, 60)` y segundos con `$activo % 60`; el bloque se muestra en todas las páginas desde `includes/menu.php`. `REINICIAR LA SESION` ejecuta `session_destroy()`, regenera el identificador y vuelve a registrar la hora. También pusimos `$_SESSION['contador']++` en `sesiones.php` para comprobar que el contador persiste al recargar. La zona horaria es `America/Mexico_City` para que `date()` muestre la hora local.
