<?php
if (!isset($titulo)) {
    $titulo = 'Mini Proyecto 1 — PHP';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escapar($titulo); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
