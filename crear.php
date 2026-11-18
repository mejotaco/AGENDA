<?php
require_once __DIR__ . '/config/db.php';

$errores = $_SESSION['errores'] ?? [];
$antiguos = $_SESSION['antiguos'] ?? [];
unset($_SESSION['errores'], $_SESSION['antiguos']);

$titulo = 'Nuevo contacto';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<h1 class="page-title">Crear contacto</h1>

<?php if (!empty($errores)): ?>
    <div class="alert alert-error">
        <strong>Corrige los siguientes errores:</strong>
        <ul>
            <?php foreach ($errores as $e): ?>
                <li><?php echo escapar($e); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="form-box">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre">Nombre <span class="req">*</span></label>
            <input type="text" id="nombre" name="nombre" maxlength="100" required
                   value="<?php echo escapar($antiguos['nombre'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="apellido">Apellido <span class="req">*</span></label>
            <input type="text" id="apellido" name="apellido" maxlength="100" required
                   value="<?php echo escapar($antiguos['apellido'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="telefono">Telefono <span class="req">*</span></label>
            <input type="tel" id="telefono" name="telefono" maxlength="20" required
                   pattern="[0-9+\-\s]{7,20}"
                   value="<?php echo escapar($antiguos['telefono'] ?? ''); ?>">
            <p class="hint">Ejemplo: 55 1234 5678</p>
        </div>

        <div class="form-group">
            <label for="foto">Foto <span class="req">*</span></label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
            <p class="hint">Formatos JPG, PNG o GIF, maximo 2 MB.</p>
        </div>

        <div class="form-group">
            <label for="email">Email (opcional)</label>
            <input type="email" id="email" name="email" maxlength="150"
                   value="<?php echo escapar($antiguos['email'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="direccion">Direccion (opcional)</label>
            <input type="text" id="direccion" name="direccion" maxlength="255"
                   value="<?php echo escapar($antiguos['direccion'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="notas">Notas (opcional)</label>
            <textarea id="notas" name="notas" rows="4" maxlength="1000"><?php echo escapar($antiguos['notas'] ?? ''); ?></textarea>
        </div>

        <div class="form-actions">
            <button class="btn" type="submit">Guardar contacto</button>
            <a class="btn btn-light" href="index.php">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
