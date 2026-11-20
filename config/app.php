<?php
date_default_timezone_set('America/Mexico_City');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['inicio'])) {
    $_SESSION['inicio'] = time();
}

function escapar($texto)
{
    return htmlspecialchars((string)$texto, ENT_QUOTES, 'UTF-8');
}
