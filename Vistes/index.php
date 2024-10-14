<?php
session_start();
if (!isset($_SESSION['taula'])) {
    header("Location: ../Controlador/controlador.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Pràctica 04</a>
        <form action="" class="form-inline justify-content-arround">
            <button class="btn btn-outline-light" type="submit" name="form" value="login">Login</button>
            <button class="btn btn-outline-light" type="submit" name="form" value="signup">Registrar-se</button>
        </form>
    </nav>
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
                    exit();
                } ?>
            </ul>
        </nav>
    </div>
</body>

</html>