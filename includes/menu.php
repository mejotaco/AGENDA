<header class="navbar">
    <div class="navbar-inner">
        <span class="brand">Agenda de Contactos</span>
        <nav class="menu">
            <a href="index.php">Contactos</a>
            <a href="crear.php">Nuevo contacto</a>
        </nav>
    </div>
</header>
<main class="container">
<?php if (!empty($_SESSION['mensaje'])): ?>
    <div class="alert alert-ok"><?php echo escapar($_SESSION['mensaje']); unset($_SESSION['mensaje']); ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-error"><?php echo escapar($_SESSION['error']); unset($_SESSION['error']); ?></div>
<?php endif; ?>
