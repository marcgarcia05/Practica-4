<?php
require_once '../Model/articles.php';

function mostrarAnonim($paginaActual){
    session_start();
    //Registre per pagina
    $rpp = 5;

    $totalArticulos = obtenirTotalArticles();
    $totalPaginas = ceil($totalArticulos / $rpp);
    //Si la pàgina que ens han passat és més gran que l'última pàgina que tenim disponible mostrarem la pàgina 1
    if ($paginaActual > $totalPaginas) {
        $paginaActual = 1;
    }

    $offset = ($paginaActual - 1) * $rpp;
    $resultats = obtenirArticlesPaginats($offset, $rpp);

    //Comprovem que hi han productes
    if (count($resultats) > 0) {
        $missatge =  "<div class='container text-center position-flex'>\n<div class='row row-cols-3 mx-auto'>\n";
        //Generem els productes
        foreach ($resultats as $row) {
            $missatge .= "<div class='col mt-3'><div class='card' style='width: 18rem;'>\n<div class='card-body'>\n
                            <h5 class='card-title'>" .  $row['Titol'] . "</h5>\n<p class='card-text'>" . $row['Cos'] . "</p>\n
                            \n</div>\n</div>\n</div>\n";
        }
        $missatge .= "</div>\n</div>";

        $paginacio = "";
        //Boto enrere
        $enrere = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                    <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/></svg>";
        //Boto següent
        $seguent = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'>
                    <path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>";
        //Mostrem fletxa enrere
        if ($paginaActual > 1) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=" . ($paginaActual - 1) . ">". $enrere ."</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $enrere ."</a>\n</li>";
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
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=" . ($paginaActual + 1) . ">". $seguent ."</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $seguent ."</a>\n</li>";
        }
        //Passem la taula a la Vista
        $_SESSION['articles'] = $missatge;
        $_SESSION['paginacio'] = $paginacio;
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
    } else {
        //Passem la taula a la Vista
        $_SESSION['articles'] = "<p>No tens cap producte disponible</p>";
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
    }

    header("Location: ../Vistes/index.view.php?page=$paginaActual");
}

function mostrar($paginaActual, $userID){
    session_start();
    //Registre per pagina
    $rpp = 5;

    $totalArticulos = obtenirTotalArticlesUsuari($userID);
    $totalPaginas = ceil($totalArticulos / $rpp);

    //Si la pàgina que ens han passat és més gran que l'última pàgina que tenim disponible mostrarem la pàgina 1
    if ($paginaActual > $totalPaginas) {
        $paginaActual = 1;
    }

    $offset = ($paginaActual - 1) * $rpp;
    $resultats = obtenirArticlesUsuariPaginats($offset, $rpp, $userID);

    //Comprovem que hi han productes
    $missatge =  "<div class='container text-center'>\n<div class='row row-cols-3'>\n";
    if (count($resultats) > 0) {
        //Generem els productes amb els botons de editar i eliminar
        foreach ($resultats as $row) {
            $missatge .= "<div class='col mt-3'><div class='card' style='width: 18rem;'>\n<div class='card-body'>\n
                            <h5 class='card-title'>" .  $row['Titol'] . "</h5>\n<p class='card-text'>" . $row['Cos'] . "</p>\n
                            \n<form action='#' method='post'>
                            <button formAction='../Controlador/modificar.php' type='submit' name='mostrarModificar' value='" . $row['ID'] . "' class='btn btn-warning'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                            </svg></button>
                            <button formAction='../Controlador/eliminar.php' type='submit' name='eliminar' value='" . $row['ID'] . "' class='btn btn-danger mx-1'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                            </svg></button></form></div>\n</div>\n</div>\n";
        }
        $missatge .= "</div>";
        $paginacio = "";
        //Boto enrere
        $enrere = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                    <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/></svg>";
        //Boto següent
        $seguent = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'>
                    <path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>";
        //Mostrem fletxa enrere
        if ($paginaActual > 1) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=" . ($paginaActual - 1) . ">". $enrere ."</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $enrere ."</a>\n</li>";
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
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=?page=" . ($paginaActual + 1) . ">". $seguent ."</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $seguent ."</a>\n</li>";
        }
        //Passem la taula a la Vista
        $_SESSION['articles'] = $missatge;
        $_SESSION['paginacio'] = $paginacio;
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
    } else {
        //Passem la taula a la Vista
        $_SESSION['articles'] = "<p>No tens cap producte disponible</p>";
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
    }

    header("Location: ../Vistes/index.view.php?page=$paginaActual");
}

function validarDades($titol, $cos, $id)
{
    $errors = [];
    if (empty($id)) {
        array_push($errors, "ERROR - ID NO POT ESTAR BUIT!!");
    }
    if (empty($titol)) {
        array_push($errors, "ERROR - TITOL NO POT ESTAR BUIT!!");
    }
    if (empty($cos)) {
        array_push($errors, "ERROR - COS NO POT ESTAR BUIT!!");
    }
    return $errors;
}

function tractarErrors($errors)
{
    $missatge = "<br><div class='alert alert-danger'>";
    foreach ($errors as $error) {
        $missatge .= "<p>$error</p>";
    }
    $missatge .= "</div>";
    return $missatge;
}

function mostrarMissatge($crud, $missatge)
{
    session_start();
    $_SESSION['missatge'] = $missatge;
    header("Location: ../Vistes/$crud.view.php");
}
