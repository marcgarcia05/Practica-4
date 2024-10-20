<?php

// Establecer tiempo máximo de inactividad (40 minutos = 2400 segundos)
$tiempo_inactividad_maximo = 60 * 40; // 40 minutos en segundos

// Verificar si el usuario está autenticado (por ejemplo, si existe $_SESSION['usuario'])
if (isset($_SESSION['username'])) {
    // Verificar si existe la variable de la última actividad
    if (isset($_SESSION['ultima_actividad'])) {
        // Calcular el tiempo transcurrido desde la última actividad
        $tiempo_transcurrido = time() - $_SESSION['ultima_actividad'];
        
        // Si el tiempo transcurrido es mayor que el tiempo máximo permitido
        if ($tiempo_transcurrido > $tiempo_inactividad_maximo) {
            // Destruir la sesión y redirigir al usuario a la página de inicio o login
            session_unset();     // Limpiar todas las variables de sesión
            session_destroy();   // Destruir la sesión
            setcookie("logout", "<div class='alertes alert alert-warning d-flex align-items-center' role='alert'>ATENCIÓ - LA SESSIO A EXPIRAT!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>", time() + 5);
            // Redirigir al usuario a la página de inicio con sesión cerrada
            header("Location: ../Controlador/index.php");
            exit();
        }
    }

    // Actualizar el tiempo de la última actividad
    $_SESSION['ultima_actividad'] = time();
}
?>
