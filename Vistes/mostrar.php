<?php
session_start();
if (!isset($_SESSION['taula'])) {
    $_SESSION['mostrar'] = true;
    header("Location: ../Controlador/controlador.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <h1 class="form-title">Pràctica 02</h1>
    <h2>Mostrar Articles</h2>
    <form method="POST" action="../Vistes/">
        <input type="submit" value="Enrrere" name="enrrere">
    </form>
    <?php
    //Mostrem missatge
    if (isset($_SESSION['taula'])) {
        echo $_SESSION['taula'];
        unset($_SESSION['taula']);
        exit();
    }
    ?>
    <?php
    //Mostrem paginació 
    echo $_SESSION['paginacio'];
    //Guardem pagina actual
    $_SESSION['paginaActual'] = $_GET['page']
    ?>
</body>

</html>