<?php
session_start();
//Declarem les variables
$form = "";

//Generem una llista buida on guardarem els diferents errors de l'usuari
$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //Guardem el contingut introduït per l'usuari
    $form = $_POST['form'];

    //Evitem code injection
    $form = htmlspecialchars($form);

    if ($form == 'Inserir'){
        header('Location: ./Vistes/inserir.php');
    } elseif ($form == 'Modificar'){
        header('Location: ./Vistes/modificar.php');
    } elseif ($form == 'Eliminar'){
        header('Location: ./Vistes/eliminar.php');
    } elseif ($form == 'Consultar'){
        header('Location: ./Vistes/consultar.php');
    } elseif ($form == 'Mostrar tot'){
        $_SESSION['mostrar'] = $form;
        header('Location: ./Vistes/mostrar.php');
    } else {
        header('Location: ./Vistes/');
    }
} else {
    header('Location: ./Controlador/controlador.php');
}
session_destroy();
?>
