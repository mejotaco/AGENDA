<?php
require_once __DIR__ . '/config/app.php';

$paginaActiva = 'variables';
$titulo = 'Variables y tipos de datos';

$nombre = 'Ana Torres';
$edad = 20;
$promedio = 8.75;
$esEstudiante = true;
$materias = ['PHP', 'HTML', 'CSS'];

$fechaActual = date('d/m/Y H:i:s');
$cantidadMaterias = count($materias);

$tipos = [
    ['tipo' => 'string', 'variable' => '$nombre', 'valor' => $nombre, 'uso' => 'Almacena texto, como nombres, mensajes o etiquetas.'],
    ['tipo' => 'int', 'variable' => '$edad', 'valor' => $edad, 'uso' => 'Almacena números enteros, como edades o cantidades.'],
    ['tipo' => 'float', 'variable' => '$promedio', 'valor' => $promedio, 'uso' => 'Almacena números con decimales, como promedios o medidas.'],
    ['tipo' => 'boolean', 'variable' => '$esEstudiante', 'valor' => var_export($esEstudiante, true), 'uso' => 'Almacena verdadero o falso para representar estados.'],
    ['tipo' => 'array', 'variable' => '$materias', 'valor' => implode(', ', $materias), 'uso' => 'Agrupa varios valores bajo una misma variable.'],
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>
<section class="cards">
    <article class="card">
        <h1 class="page-title">Variables y tipos de datos</h1>
        <p>Una variable se crea en PHP escribiendo el signo <code class="code">$</code> seguido de un nombre y asignándole un valor con <code class="code">=</code>. Por ejemplo: <code class="code">$nombre = 'Ana Torres';</code>.</p>
        <p>PHP es de tipado dinámico: no se declara el tipo de forma explícita, sino que se infiere del valor asignado. Cada tipo responde a una necesidad distinta: texto, números enteros, decimales, estados verdaderos o falsos y conjuntos de valores.</p>
    </article>
    <article class="card">
        <h2>Valores ejecutados en esta página</h2>
        <p>La fecha y hora actual se obtienen con <code class="code">date()</code>: <strong class="value"><?php echo escapar($fechaActual); ?></strong></p>
        <p>El arreglo <code class="code">$materias</code> contiene <strong class="value"><?php echo escapar($cantidadMaterias); ?></strong> elementos, calculados con <code class="code">count()</code>.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Variable</th>
                    <th>Valor mostrado con echo</th>
                    <th>Función del tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tipos as $dato): ?>
                    <tr>
                        <td><span class="type"><?php echo escapar($dato['tipo']); ?></span></td>
                        <td><code class="code"><?php echo escapar($dato['variable']); ?></code></td>
                        <td><span class="value"><?php echo escapar($dato['valor']); ?></span></td>
                        <td><?php echo escapar($dato['uso']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
