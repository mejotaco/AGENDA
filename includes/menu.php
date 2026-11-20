<?php
$inicio = $_SESSION['inicio'];
$ahora = time();
$activo = $ahora - $inicio;
$minutos = intdiv($activo, 60);
$segundos = $activo % 60;
?>
<header class="navbar">
    <div class="navbar-inner">
        <span class="brand">Programación Web — Mini Proyecto 1</span>
        <nav class="menu">
            <a href="index.php"<?php echo $paginaActiva === 'index' ? ' class="activo"' : ''; ?>>Inicio</a>
            <a href="variables.php"<?php echo $paginaActiva === 'variables' ? ' class="activo"' : ''; ?>>Variables</a>
            <a href="condicionales.php"<?php echo $paginaActiva === 'condicionales' ? ' class="activo"' : ''; ?>>Condicionales</a>
            <a href="bucles.php"<?php echo $paginaActiva === 'bucles' ? ' class="activo"' : ''; ?>>Bucles</a>
            <a href="arreglos.php"<?php echo $paginaActiva === 'arreglos' ? ' class="activo"' : ''; ?>>Arreglos</a>
            <a href="sesiones.php"<?php echo $paginaActiva === 'sesiones' ? ' class="activo"' : ''; ?>>Sesiones</a>
        </nav>
    </div>
    <div class="session-panel">
        <div class="session-grid">
            <div><span class="session-label">Hora inicio sesión:</span> <span class="value"><?php echo escapar(date('H:i:s', $inicio)); ?></span></div>
            <div><span class="session-label">Hora actual:</span> <span class="value"><?php echo escapar(date('H:i:s', $ahora)); ?></span></div>
            <div><span class="session-label">Tiempo activo:</span> <span class="value"><?php echo escapar($minutos); ?> minutos <?php echo escapar($segundos); ?> segundos</span></div>
        </div>
    </div>
</header>
<main class="container">
