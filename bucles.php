<?php
require_once __DIR__ . '/config/app.php';

$paginaActiva = 'bucles';
$titulo = 'Bucles';

$base = 7;
$tareas = [
    'Revisar la teoría de variables',
    'Practicar las estructuras condicionales',
    'Completar la tabla de multiplicar',
    'Leer sobre el funcionamiento de las sesiones',
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>
<section class="cards">
    <article class="card">
        <h1 class="page-title">Bucles</h1>
        <p>Un bucle repite instrucciones sin escribirlas varias veces. <code class="code">for</code> conviene cuando se conoce el número de repeticiones, <code class="code">while</code> repite mientras su condición sea verdadera y <code class="code">foreach</code> recorre los elementos de un arreglo.</p>
    </article>
    <article class="card">
        <h2>Tabla de multiplicar generada con for</h2>
        <p>Tabla del <span class="value"><?php echo escapar($base); ?></span>, construida dinámicamente con un bucle <code class="code">for</code>:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Iteración</th>
                    <th>Operación</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><code class="code"><?php echo $i . ' × ' . $base; ?></code></td>
                        <td><span class="value"><?php echo $i * $base; ?></span></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </article>
    <article class="card">
        <h2>Secuencia generada con while</h2>
        <ul class="topic-list">
            <?php $contador = 1; ?>
            <?php while ($contador <= 5): ?>
                <li>Iteración <span class="value"><?php echo $contador; ?></span> del bucle <code class="code">while</code>.</li>
                <?php $contador++; ?>
            <?php endwhile; ?>
        </ul>
    </article>
    <article class="card">
        <h2>Lista de tareas recorrida con foreach</h2>
        <ol class="topic-list">
            <?php foreach ($tareas as $indice => $tarea): ?>
                <li><span class="badge"><?php echo $indice + 1; ?></span> <?php echo escapar($tarea); ?></li>
            <?php endforeach; ?>
        </ol>
    </article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
