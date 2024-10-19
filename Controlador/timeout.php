<?php
function timeout(){
// Iniciar la sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$session_timeout = 2400;

// Verifica si la sesión tiene un tiempo de última actividad
if (isset($_SESSION['last_activity'])) {
    // Calcula el tiempo que ha pasado desde la última actividad
    $inactive_time = time() - $_SESSION['last_activity'];
    
    // Si el tiempo de inactividad supera el tiempo máximo permitido
    if ($inactive_time > $session_timeout) {
        // Destruye la sesión
        session_unset();   // Limpia las variables de sesión
        session_destroy(); // Destruye la sesión
        header("Location: ../Vistes/index.view.php"); // Redirige a la página de login u otra página
        exit();
    }
}

// Actualiza el tiempo de última actividad
$_SESSION['last_activity'] = time();
}
?>
