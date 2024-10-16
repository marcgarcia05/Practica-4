<?php
session_start();
$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if (!isset($_SESSION['taula'])) {
    header("Location: ../Controlador/controlador.php?page=" . $paginaActual);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estils/login.css">
</head>
<body>
    <?php
    include('navbar.view.php');
    ?>
    <div class="mt-3 text-center">
    <?php
    //Mostrem missatge
    if (isset($_SESSION['taula'])) {
        echo $_SESSION['taula'];
        unset($_SESSION['taula']);
    }
    ?>
    </div>
    <div class="mt-3">
        <nav>
            <ul class="pagination justify-content-center">
                <?php
                //Mostrem paginació
                if (isset($_SESSION['paginacio'])) {
                    echo $_SESSION['paginacio'];
                    unset($_SESSION['paginacio']);
                }
                $_GET['pagina'] = $_GET['page'];
                ?>
            </ul>
        </nav>
    </div>
</body>
</html>