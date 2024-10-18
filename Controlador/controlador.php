<?php
session_start();
function inserir(){
    require_once '../Model/connexio.php';
    
    //Guardem el contingut introduït per l'usuari
    $titol = $_POST['titol'];
    $cos = $_POST['cos'];

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

function modificar(){
    require_once '../Model/connexio.php';
    
    //Guardem el contingut introduït per l'usuari
    $id = $_POST['id'];
    $titol = $_POST['titol'];
    $cos = $_POST['cos'];

    //Evitem code injection
    $id = htmlspecialchars($id);
    $titol = htmlspecialchars($titol);
    $cos = htmlspecialchars($cos);

    //Guardem els valors de l'usuari
    $_SESSION['id'] = $id;
    $_SESSION['titol'] = $titol;
    $_SESSION['cos'] = $cos;

    //Generem una llista buida on guardarem els diferents errors de l'usuari
    $errors = [];

    //Comprovem que l'ID no està buit
    if (empty($id)) {
        array_push($errors, "ERROR - ID NO POT ESTAR BUIT!!");
    }
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

    //En cas de no tenir cap error, actualitzem les dades a la BBDD
    if (empty($errors)) {

        $preparacio = $connexio->prepare('SELECT * FROM articles WHERE ID=:id;');
        $preparacio->execute(array(':id' => $id));
        $resultatSelect = $preparacio->fetchAll();
        //Abans d'actualitzar les dades comprovem que l'ID existeix
        if (count($resultatSelect) == 0) {
            //Generem el missatge d'error
            $missatge = "<p class='error'>AQUEST ID NO EXISTEIX!</p>";
        } else {
            //Actualitzem les dades
            $preparacio = $connexio->prepare("UPDATE articles SET Titol='$titol', Cos='$cos' WHERE ID='$id';");
            $preparacio->execute();
            $missatge = "<p class='ok'>DADES ACTUALITZADES A LA BBDD CORRECTAMENT</p>";
        }
        //Passem el missatge a la Vista
        session_start();
        $_SESSION['missatgeM'] = $missatge;
        header("Location: ../Vistes/modificar.php");
        exit();
    } else {
        //Mostrem els errors
        $missatge = tractarErrors($errors);
        mostrarMissatge("modificar", $missatge);
    }
}

function eliminar(){
    require_once '../Model/connexio.php';
    
    //Guardem el contingut introduït per l'usuari
    $id = $_POST['id'];

    //Evitem code injection
    $id = htmlspecialchars($id);

    //Generem una llista buida on guardarem els diferents errors de l'usuari
    $errors = [];

    //Comprovem que l'ID no està buit
    if (empty($id)) {
        array_push($errors, "ERROR - ID NO POT ESTAR BUIT!!");
    }
    
    //En cas de no tenir cap error, actualitzem les dades a la BBDD
    if (empty($errors)) {
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE id='$id';");
        $preparacio->execute();
        $resultatSelect = $preparacio->fetchAll();
        //Abans d'actualitzar les dades comprovem que l'ID existeix
        if (count($resultatSelect) == 0) {
            //Generem el missatge d'error
            $missatge = "<p class='error'>AQUEST ID NO EXISTEIX!</p>";
        } else {
            //Eliminem el registre
            $preparacio = $connexio->prepare("DELETE FROM articles WHERE id='$id';");
            $preparacio->execute();
            $missatge = "<p class='ok'>DADES ELIMINADES CORRECTAMENT</p>";
            
        }
        //Passem el missatge a la Vista
        session_start();
        $_SESSION['missatgeE'] = $missatge;
        header("Location: ../Vistes/eliminar.php");
        exit();
        
    } else {
        //Mostrem els errors
        $missatge = tractarErrors($errors);
        mostrarMissatge("eliminar", $missatge);
    }
}

function consultar(){
    require_once '../Model/connexio.php';
    
    //Guardem el contingut introduït per l'usuari
    $id = $_POST['id'];

    //Evitem code injection
    $id = htmlspecialchars($id);

    //Generem una llista buida on guardarem els diferents errors de l'usuari
    $errors = [];

    //Comprovem que l'ID no està buit
    if (empty($id)) {
        array_push($errors, "ERROR - ID NO POT ESTAR BUIT!!");
    }

    //En cas de no tenir cap error, mostrem les dades
    if (empty($errors)) {
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE id='$id';");
        $preparacio->execute();
        $resultatSelect = $preparacio->fetchAll();

        //Comprovem que les dades existeixen
        if (count($resultatSelect) == 0) {
            //Generem el missatge d'error
            $missatge = "<p class='error'>ERROR - AQUEST ID NO EXISTEIX!</p>";
            session_start();
            $_SESSION['missatgeC'] = $missatge;
            header("Location: ../Vistes/consultar.php");
            exit();
        } else {
            //Recollim les dades de la BBDD i les passem a la Vista
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE id='$id';");
            $preparacio->execute();
            $resultats = $preparacio->fetchAll();
            //Muntem la capçalera de la taula
            $missatge =  "<br><table class='center'>\n<tr class='center'>\n<th class='center'>ID</th>\n<th class='center'>Titol</th>\n<th class='center'>Cos</th></tr>";
            //Tractem les dades per mostrar-les correctament a la taula
            foreach ($resultats as $row) {
                $missatge = $missatge .  "<tr class='center'><th class='center'>" . $row['ID'] . "</th><th class='center'>" . $row['Titol'] . "</th><th class='center'>" . $row['Cos'] . "</th></tr>";
            }
            //Tanquem la taula i la a la Vista
            $missatge = $missatge . "</table>";
            session_start();
            $_SESSION['taula'] = $missatge;
            header("Location: ../Vistes/consultar.php");
            exit();
        }
    } else {
        //Mostrem els errors
        $missatge = tractarErrors($errors);
        mostrarMissatge("consultar", $missatge);
    }
}
/*
function mostrar() {
    require_once '../Model/connexio.php';

    //Definim el número de registres per pàgina (rpp)
    $rpp = 5;

    //Obtenim el número actual de pàgina amb Session, en cas de no haver-hi serà 1
    $paginaActual = isset($_SESSION['paginaActual']) ? (int)$_SESSION['paginaActual'] : 1;

    //Referència del ùltim registre mostrat
    $offset = ($paginaActual - 1) * $rpp;

    //Calculem el número de pàgines que necesitarem
    $totalArticulos = $connexio->query("SELECT COUNT(*) FROM articles")->fetchColumn();
    $totalPaginas = ceil($totalArticulos / $rpp);

    //Preparem la consulta select
    $preparacio = $connexio->prepare("SELECT * FROM articles LIMIT :limit OFFSET :offset;");
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();

    //Creem la taula HTML
    $missatge =  "<table class='center'>\n<tr class='center'>\n<th class='center'>Titol</th>\n<th class='center'>Cos</th></tr>";
    $resultats = $preparacio->fetchAll();
    foreach ($resultats as $row) {
        $missatge .= "<tr class='center'></th><th class='center'>" . $row['Titol'] . "</th><th class='center'>" . $row['Cos'] . "</th></tr>";
    }
    $missatge .= "</table>";


    //Generem la paginació
    $missatge .= "<div class='pagination-container'>";
    $missatge .= "<div class='pagination'>";

    //Mostrem fletxa enrere
    if ($paginaActual > 1) {
        $missatge .= "<a href='?page=" . ($paginaActual - 1) . "'><-</a> ";
    }

    //Generem els "botons" de les pàgines
    for ($i = 1; $i <= $totalPaginas; $i++) {
        if ($i == $paginaActual) {
            $missatge .= "<span class='current-page'>$i</span> ";
        } else {
            $missatge .= "<a href='?page=$i'>$i</a> ";
        }
    }

    //Mostrem fletxa endavant
    if ($paginaActual < $totalPaginas) {
        $missatge .= "<a href='?page=" . ($paginaActual + 1) . "'>-></a>";
    }

    $missatge .= "</div>";
    $missatge .= "</div>";

    //Passem la taula a la Vista
    session_start();
    $_SESSION['taula'] = $missatge;
    header("Location: ../Vistes/mostrar.php?page=" . $paginaActual);
    exit();
}
*/
function mostrarAnonim() {
    require_once '../Model/connexio.php';

    //Definim el número de registres per pàgina (rpp)
    $rpp = 5;

    //Calculem el número de pàgines que necesitarem
    $totalArticulos = $connexio->query("SELECT COUNT(*) FROM articles")->fetchColumn();
    $totalPaginas = ceil($totalArticulos / $rpp);

    //Obtenim el número actual de pàgina amb Session, en cas de no haver-hi serà 1
    $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    if($paginaActual > $totalPaginas){
        $paginaActual = 1;
    } else if (!is_int($paginaActual)){
        $paginaActual = 1;
    }

    //Referència del ùltim registre mostrat
    $offset = ($paginaActual - 1) * $rpp;

    //Preparem la consulta select
    $preparacio = $connexio->prepare("SELECT * FROM articles LIMIT :limit OFFSET :offset;");
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();

    //Creem la taula HTML
    $missatge =  "<div class='container text-center'>\n<div class='row row-cols-3'>\n";
    $resultats = $preparacio->fetchAll();
    if(count($resultats) > 0){
        foreach ($resultats as $row) {
            $missatge .= "<div class='col mt-3'><div class='card' style='width: 18rem;'>\n<div class='card-body'>\n
                        <h5 class='card-title'>" .  $row['Titol'] . "</h5>\n<p class='card-text'>" . $row['Cos'] . "</p>\n
                        \n<button type='button' class='btn btn-warning'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                        </svg></button>
                        <button type='button' class='btn btn-danger mx-1'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                        </svg></button></div>\n</div>\n</div>\n";
        }
        $missatge .= "</div>";
    
        //Mostrem fletxa enrere
        if ($paginaActual > 1) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=". ($paginaActual - 1) .">Previous</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>Previous</a>\n</li>";
        }
    
        //Generem els "botons" de les pàgines
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaActual) {
                $paginacio .= "<li class='page-item active' aria-current='page'>
                                <a class='page-link' href='?page=$i'>$i</a></li>";
            } else {
                $paginacio .= "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
        }
    
        //Mostrem fletxa endavant
        if ($paginaActual < $totalPaginas) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=". ($paginaActual + 1) .">Next</a>\n</li>";
        } else{
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>Next</a>\n</li>";
        }
    
        //Passem la taula a la Vista
        session_start();
        $_SESSION['taula'] = $missatge;
        $_SESSION['paginacio'] = $paginacio;
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
        exit();
    } else{
        //Passem la taula a la Vista
        session_start();
        $_SESSION['taula'] = "<p>No tens cap producte disponible</p>";
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
        exit();
    }
    
}

function mostrar($userid) {
    require_once '../Model/connexio.php';

    //Definim el número de registres per pàgina (rpp)
    $rpp = 5;

    //Calculem el número de pàgines que necesitarem
    $totalArticulos = $connexio->query("SELECT COUNT(*) FROM articles")->fetchColumn();
    $totalPaginas = ceil($totalArticulos / $rpp);

    //Obtenim el número actual de pàgina amb Session, en cas de no haver-hi serà 1
    $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    if($paginaActual > $totalPaginas){
        $paginaActual = 1;
    } else if (!is_int($paginaActual)){
        $paginaActual = 1;
    }

    //Referència del ùltim registre mostrat
    $offset = ($paginaActual - 1) * $rpp;

    //Preparem la consulta select
    $preparacio = $connexio->prepare("SELECT * FROM articles LIMIT :limit OFFSET :offset;");
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();

    //Creem la taula HTML
    $missatge =  "<div class='container text-center'>\n<div class='row row-cols-3'>\n";
    $resultats = $preparacio->fetchAll();
    if(count($resultats) > 0){
        foreach ($resultats as $row) {
            //$missatge .= "<tr><th>" . $row['Titol'] . "</th><th>" . $row['Cos'] . "</th></tr>";
            $missatge .= "<div class='col'><div class='card' style='width: 18rem;'>\n<div class='card-body'>\n
                        <h5 class='card-title'>" .  $row['Titol'] . "</h5>\n<p class='card-text'>" . $row['Cos'] . "</p>\n
                        \n</div>\n</div>\n</div>\n";
        }
        $missatge .= "</div>\n</div>";
    
        //Mostrem fletxa enrere
        if ($paginaActual > 1) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=". ($paginaActual - 1) .">Previous</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>Previous</a>\n</li>";
        }
    
        //Generem els "botons" de les pàgines
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaActual) {
                $paginacio .= "<li class='page-item active' aria-current='page'>
                                <a class='page-link' href='?page=$i'>$i</a></li>";
            } else {
                $paginacio .= "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
        }
    
        //Mostrem fletxa endavant
        if ($paginaActual < $totalPaginas) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=". ($paginaActual + 1) .">Next</a>\n</li>";
        } else{
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>Next</a>\n</li>";
        }
    
        //Passem la taula a la Vista
        session_start();
        $_SESSION['taula'] = $missatge;
        $_SESSION['paginacio'] = $paginacio;
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
        exit();
    } else{
        //Passem la taula a la Vista
        session_start();
        $_SESSION['taula'] = "<p>No tens cap producte disponible</p>";
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
        exit();
    }
    
}

function tractarErrors($errors){
    $missatge = "<br><div class='alert alert-danger' role='alert'>";
    foreach ($errors as $error) {
        $missatge = $missatge . "<p>" . $error . "</p>";
    }
    $missatge = $missatge . "</div>";
    return $missatge;
}

function mostrarMissatge($crud, $missatge){
    session_start();

    if ($crud == "consultar"){
        $_SESSION['missatgeC'] = $missatge;
        header("Location: ../Vistes/consultar.php");
        exit();
    } elseif($crud == "inserir"){
        $_SESSION['missatgeI'] = $missatge;
        header("Location: ../Vistes/inserir.php");
        exit();
    } elseif($crud == "modificar"){
        $_SESSION['missatgeM'] = $missatge;
        header("Location: ../Vistes/modificar.php");
        exit();
    } elseif($crud == "eliminar"){
        $_SESSION['missatgeE'] = $missatge;
        header("Location: ../Vistes/eliminar.php");
        exit();
    }
    
}

if(isset($_POST['afegir'])){
    header('Location: ../Vistes/inserir.view.php');
} elseif (isset($_POST['login'])) {
    header('Location: ../Vistes/login.view.php');
} elseif (isset($_POST['signup'])) {
    header('Location: ../Vistes/signup.view.php');
} elseif (isset($_POST['logout'])) {
    header('Location: ../Controlador/logout.php');
}

/*elseif (isset($_POST['eliminar'])) {
    include '../VISTES/eliminar.php';
} elseif (isset($_POST['consultar'])) {
    consultar();
    include '../VISTES/consultar.php';
} elseif (isset($_SESSION['mostrar'])){
    mostrar();
    include '../VISTES/mostrar.php';
} elseif (isset($_POST['enrere'])) {
    header('Location: ../');
} */else{
    mostrarAnonim();
}
session_destroy();