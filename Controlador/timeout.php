<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Tiempo de expiración de la sesión (40 minutos)
$timeout = 5; // 40 minutos en segundos

// Verificar si existe el timestamp de la última actividad
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calcular el tiempo desde la última actividad
    $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];

    // Verificar si ha pasado el tiempo de expiración
    if ($elapsed_time > $timeout) {
        // Si ha pasado el tiempo, cerrar la sesión
        session_unset(); // Liberar variables de sesión
        session_destroy(); // Destruir la sesión
        header("Location: ../Vistes/index.view.php?message=sessionexpired");
        exit();
    }
}

// Actualizar el timestamp de la última actividad
$_SESSION['LAST_ACTIVITY'] = time(); // Guarda la última actividad
?>
