<?php
require_once __DIR__ . '/config/db.php';

$busqueda = trim($_GET['q'] ?? '');

$sql = 'SELECT id, nombre, apellido, telefono, foto, email FROM contactos';
$parametros = [];

if ($busqueda !== '') {
    $sql .= ' WHERE nombre LIKE :q OR apellido LIKE :q OR telefono LIKE :q OR email LIKE :q';
    $parametros[':q'] = '%' . $busqueda . '%';
}
$sql .= ' ORDER BY nombre ASC, apellido ASC';

$stmt = $pdo->prepare($sql);
$stmt->execute($parametros);
$contactos = $stmt->fetchAll();

$titulo = 'Listado de contactos';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<div class="toolbar">
    <h1 class="page-title">Contactos (<?php echo count($contactos); ?>)</h1>
    <div class="actions">
        <form class="search-form" action="index.php" method="get">
            <input type="text" name="q" value="<?php echo escapar($busqueda); ?>" placeholder="Buscar por nombre, apellido, telefono o email">
            <button class="btn btn-light" type="submit">Buscar</button>
            <?php if ($busqueda !== ''): ?>
                <a class="btn btn-light" href="index.php">Limpiar</a>
            <?php endif; ?>
        </form>
        <a class="btn" href="crear.php">+ Nuevo contacto</a>
    </div>
</div>

<?php if (empty($contactos)): ?>
    <div class="empty">
        <p><?php echo $busqueda !== '' ? 'No se encontraron contactos para "' . escapar($busqueda) . '".' : 'Aun no hay contactos registrados.'; ?></p>
        <p><a class="btn" href="crear.php" style="margin-top:12px;">Crear el primero</a></p>
    </div>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contactos as $c): ?>
            <tr>
                <td><img class="thumb" src="uploads/<?php echo escapar($c['foto']); ?>" alt="Foto de <?php echo escapar($c['nombre']); ?>"></td>
                <td><?php echo escapar($c['nombre'] . ' ' . $c['apellido']); ?></td>
                <td><?php echo escapar($c['telefono']); ?></td>
                <td><?php echo $c['email'] ? escapar($c['email']) : '-'; ?></td>
                <td>
                    <div class="actions">
                        <a class="btn btn-light" href="ver.php?id=<?php echo (int) $c['id']; ?>">Ver</a>
                        <a class="btn" href="editar.php?id=<?php echo (int) $c['id']; ?>">Editar</a>
                        <form action="eliminar.php" method="post" onsubmit="return confirm('¿Seguro que deseas eliminar este contacto?');">
                            <input type="hidden" name="id" value="<?php echo (int) $c['id']; ?>">
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
