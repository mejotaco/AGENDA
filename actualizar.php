<?php
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('index.php');
}

$id = validarId($_POST['id'] ?? null);
if ($id === null) {
    $_SESSION['error'] = 'Contacto no valido.';
    redirigir('index.php');
}

$stmt = $pdo->prepare('SELECT * FROM contactos WHERE id = :id');
$stmt->execute([':id' => $id]);
$contacto = $stmt->fetch();

if (!$contacto) {
    $_SESSION['error'] = 'El contacto a actualizar no existe.';
    redirigir('index.php');
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

$nuevaFoto = null;
$hayFoto = isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE;

if ($hayFoto) {
    $archivo = $_FILES['foto'];
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        $errores[] = 'No se pudo subir la foto, intenta de nuevo.';
    } elseif ($archivo['size'] > 2 * 1024 * 1024) {
        $errores[] = 'La foto no puede superar los 2 MB.';
    } else {
        $info = @getimagesize($archivo['tmp_name']);
        $permitidos = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif'];
        if ($info === false || !isset($permitidos[$info['mime']])) {
            $errores[] = 'La foto debe ser una imagen JPG, PNG o GIF.';
        } else {
            $nuevaFoto = uniqid('contacto_', true) . '.' . $permitidos[$info['mime']];
        }
    }
}

if (!empty($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['antiguos'] = [
        'id' => $id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'telefono' => $telefono,
        'email' => $email,
        'direccion' => $direccion,
        'notas' => $notas,
    ];
    redirigir('editar.php?id=' . $id);
}

if ($hayFoto) {
    if (!move_uploaded_file($archivo['tmp_name'], __DIR__ . '/uploads/' . $nuevaFoto)) {
        $_SESSION['error'] = 'No se pudo guardar el archivo de la foto.';
        redirigir('editar.php?id=' . $id);
    }
    $rutaVieja = __DIR__ . '/uploads/' . $contacto['foto'];
    if (is_file($rutaVieja)) {
        @unlink($rutaVieja);
    }
}

try {
    $datos = [
        ':nombre'    => $nombre,
        ':apellido'  => $apellido,
        ':telefono'  => $telefono,
        ':email'     => $email !== '' ? $email : null,
        ':direccion' => $direccion !== '' ? $direccion : null,
        ':notas'     => $notas !== '' ? $notas : null,
        ':id'        => $id,
    ];

    if ($hayFoto) {
        $sql = 'UPDATE contactos SET nombre = :nombre, apellido = :apellido, telefono = :telefono,
                foto = :foto, email = :email, direccion = :direccion, notas = :notas WHERE id = :id';
        $datos[':foto'] = $nuevaFoto;
    } else {
        $sql = 'UPDATE contactos SET nombre = :nombre, apellido = :apellido, telefono = :telefono,
                email = :email, direccion = :direccion, notas = :notas WHERE id = :id';
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($datos);
} catch (PDOException $e) {
    error_log('Error al actualizar contacto: ' . $e->getMessage());
    $_SESSION['error'] = 'No se pudo actualizar el contacto, intentalo mas tarde.';
    redirigir('editar.php?id=' . $id);
}

$_SESSION['mensaje'] = 'Contacto actualizado correctamente.';
redirigir('ver.php?id=' . $id);
