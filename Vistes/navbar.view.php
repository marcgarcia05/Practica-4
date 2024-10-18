<?php
include "../Controlador/timeout.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['username'])){
    echo "<nav class='navbar navbar-dark bg-primary'>
    <a class='navbar-brand' href='#'>Benvingut/da " . $_SESSION['username'] . "</a>
    <form action='../Controlador/controlador.php' method='post' class='form-inline justify-content-arround'>
        <button class='btn btn-outline-light' type='submit' name='logout' value='logout'>Logout</button>
    </form>
</nav>";
} else{
    echo"<nav class='navbar navbar-dark bg-primary'>
    <a class='navbar-brand' href='#'>Pràctica 04</a>
    <form action='../Controlador/controlador.php' method='post' class='form-inline justify-content-arround'>
        <button class='btn btn-outline-light' type='submit' name='login' value='signin'>Login</button>
        <button class='btn btn-outline-light' type='submit' name='signup' value='signup'>SignUp</button>
    </form>
</nav>";
}
?>