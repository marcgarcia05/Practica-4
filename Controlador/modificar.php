<?php
function modificar() {
    $id = htmlspecialchars($_POST['id']);
    $titol = htmlspecialchars($_POST['titol']);
    $cos = htmlspecialchars($_POST['cos']);
    
    $_SESSION['id'] = $id;
    $_SESSION['titol'] = $titol;
    $_SESSION['cos'] = $cos;

    $errors = validarDades($titol, $cos, $id);
    if (empty($errors)) {
        if (count(existeixArticle($id)) == 0) {
            $_SESSION['missatgeM'] = "<p class='error'>AQUEST ID NO EXISTEIX!</p>";
        } else {
            modificarArticle($id, $titol, $cos);
            $_SESSION['missatgeM'] = "<p class='ok'>DADES ACTUALITZADES CORRECTAMENT!</p>";
        }
        header("Location: ../Vistes/modificar.php");
    } else {
        mostrarMissatge("modificar", tractarErrors($errors));
    }
}
?>