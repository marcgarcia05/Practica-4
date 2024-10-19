<?php
require_once '../Model/articles.php';
session_start();
function eliminar(){
    eliminarArticle($_POST['eliminar']);
    $missatge = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>DADES ELIMINADES CORRECTAMENT<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>";
    header("Location: ../Vistes/index.view.php");
}
if(isset($_POST['eliminar'])){
    eliminar();
}
?>