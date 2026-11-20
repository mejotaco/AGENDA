<?php
require_once __DIR__ . '/config/app.php';

$paginaActiva = 'arreglos';
$titulo = 'Arreglos';

$colores = ['Rojo', 'Verde', 'Azul'];
$estudiante = [
    'nombre' => 'Ana Torres',
    'edad' => 20,
    'ciudad' => 'Guatemala',
];
$servicios = [
    ['nombre' => 'Desarrollo en PHP', 'activo' => true],
    ['nombre' => 'Mantenimiento de HTML', 'activo' => false],
    ['nombre' => 'Diseño con CSS', 'activo' => true],
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>
<section class="cards">
    <article class="card">
        <h1 class="page-title">Arreglos</h1>
        <p>Un arreglo permite guardar varios valores en una sola variable. El arreglo indexado usa posiciones numéricas, el asociativo usa claves con nombre y el multidimensional contiene otros arreglos en su interior.</p>
    </article>
    <article class="card">
        <h2>Arreglo indexado recorrido con foreach</h2>
        <ul class="topic-list">
            <?php foreach ($colores as $color): ?>
                <li><span class="value"><?php echo escapar($color); ?></span></li>
            <?php endforeach; ?>
        </ul>
    </article>
    <article class="card">
        <h2>Arreglo asociativo recorrido con foreach</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiante as $clave => $valor): ?>
                    <tr>
                        <td><code class="code"><?php echo escapar($clave); ?></code></td>
                        <td><span class="value"><?php echo escapar($valor); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
    <article class="card">
        <h2>Arreglo multidimensional con condición dentro del foreach</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicios as $servicio): ?>
                    <tr>
                        <td><?php echo escapar($servicio['nombre']); ?></td>
                        <td>
                            <?php if ($servicio['activo']): ?>
                                <span class="badge badge-activo">Activo</span>
                            <?php else: ?>
                                <span class="badge badge-inactivo">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo escapar($servicio['activo'] ? 'Disponible en el proyecto actual' : 'No disponible en el proyecto actual'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
