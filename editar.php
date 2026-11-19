<?php
require_once __DIR__ . '/config/db.php';

$id = validarId($_GET['id'] ?? null);
if ($id === null) {
    redirigir('index.php');
}

$stmt = $pdo->prepare('SELECT * FROM contactos WHERE id = :id');
$stmt->execute([':id' => $id]);
$contacto = $stmt->fetch();

if (!$contacto) {
    $_SESSION['error'] = 'El contacto solicitado no existe.';
    redirigir('index.php');
}

$errores = $_SESSION['errores'] ?? [];
$antiguos = $_SESSION['antiguos'] ?? [];
unset($_SESSION['errores'], $_SESSION['antiguos']);

if (!empty($antiguos)) {
    $contacto = array_merge($contacto, $antiguos);
}

$titulo = 'Editar contacto';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<div class="toolbar">
    <h1 class="page-title">Editar contacto</h1>
    <a class="btn btn-light" href="ver.php?id=<?php echo (int) $id; ?>">Ver detalle</a>
</div>

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
    <form action="actualizar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo (int) $contacto['id']; ?>">

        <div class="form-group">
            <label for="nombre">Nombre <span class="req">*</span></label>
            <input type="text" id="nombre" name="nombre" maxlength="100" required
                   value="<?php echo escapar($contacto['nombre']); ?>">
        </div>

        <div class="form-group">
            <label for="apellido">Apellido <span class="req">*</span></label>
            <input type="text" id="apellido" name="apellido" maxlength="100" required
                   value="<?php echo escapar($contacto['apellido']); ?>">
        </div>

        <div class="form-group">
            <label for="telefono">Telefono <span class="req">*</span></label>
            <input type="tel" id="telefono" name="telefono" maxlength="20" required
                   pattern="[0-9+\-\s]{7,20}"
                   value="<?php echo escapar($contacto['telefono']); ?>">
        </div>

        <div class="form-group">
            <label for="foto">Foto (dejar vacio para mantener la actual)</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            <p class="hint">Actual: <?php echo escapar($contacto['foto']); ?> - Formatos JPG, PNG o GIF, maximo 2 MB.</p>
        </div>

        <div class="form-group">
            <label for="email">Email (opcional)</label>
            <input type="email" id="email" name="email" maxlength="150"
                   value="<?php echo escapar($contacto['email'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="direccion">Direccion (opcional)</label>
            <input type="text" id="direccion" name="direccion" maxlength="255"
                   value="<?php echo escapar($contacto['direccion'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="notas">Notas (opcional)</label>
            <textarea id="notas" name="notas" rows="4" maxlength="1000"><?php echo escapar($contacto['notas'] ?? ''); ?></textarea>
        </div>

        <div class="form-actions">
            <button class="btn" type="submit">Actualizar contacto</button>
            <a class="btn btn-light" href="index.php">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
