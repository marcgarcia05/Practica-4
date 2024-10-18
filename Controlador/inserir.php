<?php
require_once '../Model/connexio.php';

//Guardem el contingut introduït per l'usuari
$titol = $_POST['titol'];
$cos = $_POST['cos'];
$usuariID = $_SESSION['userID'];

//Evitem code injection
$titol = htmlspecialchars($titol);
$cos = htmlspecialchars($cos);

//Guardem els valors de l'usuari
$_SESSION['titol'] = $titol;
$_SESSION['cos'] = $cos;

//Generem una llista buida on guardarem els diferents errors de l'usuari
$errors = [];

//Comprovem que el nom no està buit
if (empty($titol)) {
    array_push($errors, "ERROR - TITOL NO POT ESTAR BUIT!!");
    //Comprovem que el nom no conté caràcters estranys
} elseif (!preg_match("/^[a-zA-Z]+$/", $titol)) {
    array_push($errors, "ERROR - TITOL NOMES POT CONTENIR LLETRES!!");
}
//Comprovem que el text no està buit
if (empty($cos)) {
    array_push($errors, "ERROR - COS NO POT ESTAR BUIT!!");
}

//En cas de no tenir cap error, afegim les dades a la BBDD
if (empty($errors)) {
    $preparacio = $connexio->prepare("insert articles (Titol, Cos, User_ID) VALUES ('$titol', '$cos', '$usuariID');");
    $preparacio->execute();
    //Mostrem el missatge
    $missatge = "<p class='ok'>DADES INTRODUIDES CORRECTAMENT!!</p>";
    session_start();
    $_SESSION['missatgeI'] = $missatge;
    header("Location: ../Vistes/inserir.php");
    exit();
} else {
    //Mostrem els errors
    $missatge = tractarErrors($errors);
    mostrarMissatge("inserir", $missatge);
}
