<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'agenda');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    error_log('Error de conexion: ' . $e->getMessage());
    http_response_code(500);
    exit('No se pudo conectar con la base de datos.');
}

function escapar($texto) {
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function redirigir($url) {
    header('Location: ' . $url);
    exit;
}

function validarId($id) {
    $id = filter_var($id, FILTER_VALIDATE_INT);
    return $id !== false && $id > 0 ? $id : null;
}
