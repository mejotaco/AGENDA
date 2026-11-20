<?php
require_once __DIR__ . '/config/app.php';

$paginaActiva = 'condicionales';
$titulo = 'Estructuras condicionales';

$nota = 16;
$asistencia = 92;
$tareas = ['php' => true, 'css' => false];

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

$mensajeTarea = $tareas['php'] ? 'La tarea de PHP está entregada.' : 'La tarea de PHP está pendiente.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>
<section class="cards">
    <article class="card">
        <h1 class="page-title">Estructuras condicionales</h1>
        <p>Las estructuras condicionales permiten ejecutar distintas instrucciones según el valor de una variable. <code class="code">if</code> evalúa una condición, <code class="code">elseif</code> añade más opciones y <code class="code">else</code> atiende el resto de los casos. <code class="code">switch</code> compara un valor con varios casos posibles.</p>
    </article>
    <article class="card">
        <h2>Cadena if / elseif / else ejecutada</h2>
        <p>Condición evaluada: <code class="code"><?php echo escapar('$nota = ' . $nota . '; if ($nota >= 18) ... elseif ($nota >= 14) ... else ...'); ?></code></p>
        <p>Resultado calculado: <span class="badge"><?php echo escapar($calificacion); ?></span></p>
        <h2>Condición if / else con una variable</h2>
        <p>Asistencia registrada: <span class="value"><?php echo escapar($asistencia); ?></span>. <?php echo escapar($mensajeAsistencia); ?></p>
        <h2>Condición con un arreglo asociativo</h2>
        <p><?php echo escapar($mensajeTarea); ?></p>
    </article>
    <article class="card">
        <h2>switch ejecutado sobre (int) date('N')</h2>
        <p>Valor numérico del día: <span class="badge"><?php echo escapar($dia); ?></span></p>
        <p>Según el <code class="code">switch</code>, hoy es <strong class="value"><?php echo escapar($nombreDia); ?></strong>.</p>
    </article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
