<?php
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $id = validarId($_GET['id'] ?? null);
    if ($id === null) {
        redirigir('index.php');
    }

    $stmt = $pdo->prepare('SELECT id, nombre, apellido FROM contactos WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $contacto = $stmt->fetch();

    if (!$contacto) {
        $_SESSION['error'] = 'El contacto solicitado no existe.';
        redirigir('index.php');
    }

    $titulo = 'Confirmar eliminacion';
    require_once __DIR__ . '/includes/header.php';
    require_once __DIR__ . '/includes/menu.php';
    ?>
    <h1 class="page-title">Confirmar eliminacion</h1>
    <div class="form-box">
        <p>¿Seguro que deseas eliminar a <strong><?php echo escapar($contacto['nombre'] . ' ' . $contacto['apellido']); ?></strong>? Esta accion no se puede deshacer.</p>
        <div class="form-actions" style="margin-top:18px;">
            <form action="eliminar.php" method="post">
                <input type="hidden" name="id" value="<?php echo (int) $contacto['id']; ?>">
                <button class="btn btn-danger" type="submit">Si, eliminar</button>
            </form>
            <a class="btn btn-light" href="index.php">Cancelar</a>
        </div>
    </div>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$id = validarId($_POST['id'] ?? null);
if ($id === null) {
    $_SESSION['error'] = 'Contacto no valido.';
    redirigir('index.php');
}

$stmt = $pdo->prepare('SELECT id, foto FROM contactos WHERE id = :id');
$stmt->execute([':id' => $id]);
$contacto = $stmt->fetch();

if (!$contacto) {
    $_SESSION['error'] = 'El contacto a eliminar no existe.';
    redirigir('index.php');
}

try {
    $stmt = $pdo->prepare('DELETE FROM contactos WHERE id = :id');
    $stmt->execute([':id' => $id]);
} catch (PDOException $e) {
    error_log('Error al eliminar contacto: ' . $e->getMessage());
    $_SESSION['error'] = 'No se pudo eliminar el contacto.';
    redirigir('index.php');
}

$rutaFoto = __DIR__ . '/uploads/' . $contacto['foto'];
if (is_file($rutaFoto)) {
    @unlink($rutaFoto);
}

$_SESSION['mensaje'] = 'Contacto eliminado correctamente.';
redirigir('index.php');
