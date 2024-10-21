<?php
include 'mostrar.php';
session_start();
//Controlem si la sessió esta iniciada, i controlem la pagina
if (isset($_SESSION['username'])){
    if (isset($_GET['page'])){
        $paginaActual = (int)$_GET['page'];
        if($paginaActual == 0){
            $paginaActual = 1;
        }
    } else{
        $paginaActual = 1;
    }
    mostrar($paginaActual, $_SESSION['userID']);
} else{
    if (isset($_GET['page'])){
        $paginaActual = (int)$_GET['page'];
        if($paginaActual == 0){
            $paginaActual = 1;
        }
    } else{
        $paginaActual = 1;
    }
    mostrarAnonim($paginaActual);
}
?>
