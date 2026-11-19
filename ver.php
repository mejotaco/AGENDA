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

$titulo = 'Detalle de contacto';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<div class="toolbar">
    <h1 class="page-title">Detalle del contacto</h1>
    <div class="actions">
        <a class="btn btn-light" href="index.php">Volver</a>
        <a class="btn" href="editar.php?id=<?php echo (int) $contacto['id']; ?>">Editar</a>
    </div>
</div>

<div class="detail">
    <div class="detail-head">
        <img class="detail-photo" src="uploads/<?php echo escapar($contacto['foto']); ?>" alt="Foto de <?php echo escapar($contacto['nombre']); ?>">
        <div>
            <div class="detail-name"><?php echo escapar($contacto['nombre'] . ' ' . $contacto['apellido']); ?></div>
            <p>ID: <?php echo (int) $contacto['id']; ?></p>
        </div>
    </div>
    <dl class="detail-list">
        <div><dt>Telefono</dt><dd><?php echo escapar($contacto['telefono']); ?></dd></div>
        <div><dt>Email</dt><dd><?php echo $contacto['email'] ? escapar($contacto['email']) : 'No registrado'; ?></dd></div>
        <div><dt>Direccion</dt><dd><?php echo $contacto['direccion'] ? escapar($contacto['direccion']) : 'No registrada'; ?></dd></div>
        <div><dt>Notas</dt><dd><?php echo $contacto['notas'] ? nl2br(escapar($contacto['notas'])) : 'Sin notas'; ?></dd></div>
    </dl>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
