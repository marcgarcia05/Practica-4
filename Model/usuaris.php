<?php
require_once 'connexio.php';

function inserirUsuari($nom, $email, $password) {
    global $connexio;
    $preparacio = $connexio->prepare("INSERT INTO usuaris (Nom_usuari, Contrasenya, Email) VALUES (:Nom_usuari, :Contrasenya, :Email);");
    $preparacio->execute([':Nom_usuari' => $nom, ':Contrasenya' => $password, 'Email' => $email]);
}

function getUsuari($email){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM usuaris WHERE Email = ?");
    $preparacio->bindParam(1, $email);
    $preparacio->execute();
    $resultatSelect = $preparacio->fetch(PDO::FETCH_ASSOC);
    return $resultatSelect;
}


function comprovarUsuari($email){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM usuaris WHERE Email = ?");
    $preparacio->bindParam(1, $email);
    $preparacio->execute();
    $resultatSelect = $preparacio->fetchAll();

    //Comprovem si les dades existeixen
    if (count($resultatSelect) == 1) {
        return true;
    } else {
        return false;
    }
}

?>