<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../Estils/css.css">
    </head>
    <body>
        <form method="post" action="../Controlador/controlador.php">
            <div class="form-container">
                <h1 class="form-title">Pràctica 02</h1>
            </div>
            <h2>Eliminar Article</h2>
            <label>ID: </label>
            <input type="text" name="id"><br><br>
            <input type="submit" value="Enviar" name="eliminar"><br><br>
            <input type="submit" value="Enrere" name="enrere">
            <?php
            //Mostrem missatge
            if (isset($_SESSION['missatgeE'])) {
                echo $_SESSION['missatgeE'];
                unset($_SESSION['missatgeE']);
                exit();
            }
            ?>
        </form>
    </body>
</html>