<?php
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
$paginaActiva = 'index';
$titulo = 'Inicio — Mini Proyecto 1';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>
<?php if ($reiniciado): ?>
    <div class="alert alert-ok">La sesión se reinició correctamente al cargar esta página.</div>
<?php endif; ?>
<section class="cards">
    <article class="card">
        <h1 class="page-title">Bienvenido al Mini Proyecto 1</h1>
        <p>Este sitio es una demostración ejecutable de los conceptos fundamentales de PHP del lado del servidor. Cada página contiene código real que se ejecuta al cargarla y muestra su resultado en pantalla.</p>
        <p>El proyecto no utiliza base de datos, formularios ni acceso de usuarios: toda la información se genera en cada petición y la sesión se emplea únicamente para medir el tiempo de actividad.</p>
        <p>El temporizador se mantiene al navegar entre las páginas del menú y solo vuelve a cero cuando usas el botón REINICIAR LA SESION.</p>
        <p><a class="btn btn-destacado" href="index.php?reiniciar=1">REINICIAR LA SESION</a></p>
    </article>
    <article class="card">
        <h2>Temas que se demuestran</h2>
        <ul class="topic-list">
            <li><span class="type">Variables y tipos</span>: declaración de variables, uso de <code class="code">echo</code>, <code class="code">date()</code> y <code class="code">count()</code>.</li>
            <li><span class="type">Condicionales</span>: <code class="code">if</code>, <code class="code">elseif</code>, <code class="code">else</code> y <code class="code">switch</code>.</li>
            <li><span class="type">Bucles</span>: <code class="code">for</code>, <code class="code">while</code> y <code class="code">foreach</code>.</li>
            <li><span class="type">Arreglos</span>: indexados, asociativos y multidimensionales.</li>
            <li><span class="type">Sesiones</span>: <code class="code">session_start()</code>, <code class="code">$_SESSION</code> y <code class="code">session_destroy()</code>.</li>
        </ul>
    </article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
