<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../Estils/css.css">
    </head>
    <body>
        <form method="POST" action="../Controlador/controlador.php">
            <div class="form-container">
                <h1 class="form-title">Pràctica 02</h1>
            </div>
            <h2>Introduir Article</h2>
            <label>Titol: </label>
            <input type="text" name="titol" value="<?php echo isset($_SESSION['titol']) ? htmlspecialchars($_SESSION['titol']) : ''; ?>">
            <label>Cos: </label>
            <input type="text" name="cos" value="<?php echo isset($_SESSION['cos']) ? htmlspecialchars($_SESSION['cos']) : ''; ?>"><br><br>
            <input type="submit" value="Enviar" name="inserir"><br><br>
            <input type="submit" value="Enrere" name="enrere">
            <?php
            //Mostrem missatge
            if (isset($_SESSION['missatgeI'])) {
                echo $_SESSION['missatgeI'];
                unset($_SESSION['missatgeI']);
                exit();
            }
            ?>
        </form>
    </body>
</html>