<?php
function inserir(){
    require_once '../Model/connexio.php';
    
    //Guardem el contingut introduït per l'usuari
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    //Evitem code injection
    $nom = htmlspecialchars($nom);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $password2 = htmlspecialchars($password2);

    //Generem una llista buida on guardarem els diferents errors de l'usuari
    $errors = [];

    //Comprovem que el nom no està buit
    if (empty($nom)) {
        array_push($errors, "ERROR - TITOL NO POT ESTAR BUIT!!");
        //Comprovem que el nom no conté caràcters estranys
    } elseif (!preg_match("/^[a-zA-Z]+$/", $nom)) {
        array_push($errors, "ERROR - TITOL NOMES POT CONTENIR LLETRES!!");
    }
    //Comprovem que el correu no està buit
    if (empty($email)){
        array_push($errors, "ERROR - CORREU NO POT ESTAR BUIT!!");
        //Comprovem que el correu té un format correcte
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "ERROR - EL FORMAT DEL CORREU NO ES CORRECTE!!");
    }
    //Comprovem la fortaleza de la password
    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    if($password == $password2){
        array_push($errors, "ERROR - LES CONTRAS NO COINCIDEIXEN!!");
    } else if(preg_match($password_regex, $password) == 0){
        array_push($errors, "ERROR - TITOL NOMES POT CONTENIR LLETRES!!");
    }
    

    //En cas de no tenir cap error, afegim les dades a la BBDD
    if (empty($errors)) {
        $preparacio = $connexio->prepare("insert articles (Titol, Cos) VALUES ('$titol', '$cos');");
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
}
?>