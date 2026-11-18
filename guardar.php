<?php
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('crear.php');
}

$nombre    = trim($_POST['nombre'] ?? '');
$apellido  = trim($_POST['apellido'] ?? '');
$telefono  = trim($_POST['telefono'] ?? '');
$email     = trim($_POST['email'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$notas     = trim($_POST['notas'] ?? '');

$errores = [];

if ($nombre === '') {
    $errores[] = 'El nombre es obligatorio.';
}
if ($apellido === '') {
    $errores[] = 'El apellido es obligatorio.';
}
if ($telefono === '') {
    $errores[] = 'El telefono es obligatorio.';
} elseif (!preg_match('/^[0-9+\-\s]{7,20}$/', $telefono)) {
    $errores[] = 'El telefono solo puede contener numeros, espacios, + y -.';
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El formato del email no es valido.';
}

$foto = null;
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
    $errores[] = 'La foto es obligatoria.';
} elseif ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    $errores[] = 'No se pudo subir la foto, intenta de nuevo.';
} else {
    $archivo = $_FILES['foto'];
    if ($archivo['size'] > 2 * 1024 * 1024) {
        $errores[] = 'La foto no puede superar los 2 MB.';
    }
    $info = @getimagesize($archivo['tmp_name']);
    $permitidos = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif'];
    if ($info === false || !isset($permitidos[$info['mime']])) {
        $errores[] = 'La foto debe ser una imagen JPG, PNG o GIF.';
    } else {
        $foto = uniqid('contacto_', true) . '.' . $permitidos[$info['mime']];
    }
}

if (!empty($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['antiguos'] = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'telefono' => $telefono,
        'email' => $email,
        'direccion' => $direccion,
        'notas' => $notas,
    ];
    redirigir('crear.php');
}

if (!move_uploaded_file($archivo['tmp_name'], __DIR__ . '/uploads/' . $foto)) {
    $_SESSION['error'] = 'No se pudo guardar el archivo de la foto.';
    redirigir('crear.php');
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO contactos (nombre, apellido, telefono, foto, email, direccion, notas)
         VALUES (:nombre, :apellido, :telefono, :foto, :email, :direccion, :notas)'
    );
    $stmt->execute([
        ':nombre'    => $nombre,
        ':apellido'  => $apellido,
        ':telefono'  => $telefono,
        ':foto'      => $foto,
        ':email'     => $email !== '' ? $email : null,
        ':direccion' => $direccion !== '' ? $direccion : null,
        ':notas'     => $notas !== '' ? $notas : null,
    ]);
} catch (PDOException $e) {
    error_log('Error al crear contacto: ' . $e->getMessage());
    $_SESSION['error'] = 'No se pudo guardar el contacto, intentalo mas tarde.';
    redirigir('crear.php');
}

$_SESSION['mensaje'] = 'Contacto creado correctamente.';
redirigir('index.php');
