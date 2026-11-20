<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/app.php';

$paginaActiva = 'sesiones';
$titulo = 'Sesiones';

if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
}
$_SESSION['contador']++;

$inicioSesion = $_SESSION['inicio'];
$horaActual = time();
$tiempoActivo = $horaActual - $inicioSesion;
$minutosSesion = intdiv($tiempoActivo, 60);
$segundosSesion = $tiempoActivo % 60;

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>
<section class="cards">
    <article class="card">
        <h1 class="page-title">Sesiones</h1>
        <p>Una sesión permite conservar información de un visitante entre distintas peticiones al servidor. PHP inicia la sesión con <code class="code">session_start()</code> y guarda los datos en el arreglo superglobal <code class="code">$_SESSION</code>.</p>
        <p>El código de inicio protegido es el siguiente: <code class="code"><?php echo escapar("if (session_status() === PHP_SESSION_NONE) { session_start(); }"); ?></code></p>
        <p>La persistencia en memoria significa que los valores de <code class="code">$_SESSION</code> permanecen disponibles en el servidor mientras la sesión esté activa. El navegador solo conserva un identificador de sesión; los datos reales se liberan cuando la sesión se destruye o expira. No son almacenamiento permanente.</p>
    </article>
    <article class="card">
        <h2>Contador persistente en $_SESSION</h2>
        <p>Valor actual del contador: <span class="badge"><?php echo escapar($_SESSION['contador']); ?></span></p>
        <p class="hint">Actualice esta página para comprobar que el valor aumenta porque se conserva en la sesión.</p>
    </article>
    <article class="card">
        <h2>Control de tiempo de la sesión</h2>
        <div class="session-grid session-grid-local">
            <div><span class="session-label">Hora inicio sesión:</span> <span class="value"><?php echo escapar(date('H:i:s', $inicioSesion)); ?></span></div>
            <div><span class="session-label">Hora actual:</span> <span class="value"><?php echo escapar(date('H:i:s', $horaActual)); ?></span></div>
            <div><span class="session-label">Tiempo activo:</span> <span class="value"><?php echo escapar($minutosSesion); ?> minutos <?php echo escapar($segundosSesion); ?> segundos</span></div>
        </div>
        <p>En la página de inicio se usa <code class="code">session_destroy()</code> para finalizar la sesión y comenzar una nueva con un tiempo de inicio reciente.</p>
    </article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
