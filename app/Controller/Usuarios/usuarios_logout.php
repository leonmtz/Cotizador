<?php
// archivo: logout.php

session_start(); // Inicia la sesión

// Eliminar todas las variables de sesión
$_SESSION = array();

// Si se está utilizando una cookie de sesión, eliminarla también
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir a la página de inicio o login
header("Location: /Cotizador/login.php"); // Cambia esta ruta según tu estructura de proyecto
exit();
