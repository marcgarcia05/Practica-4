<?php
include '../Controlador/timeout.php';
if(isset($_SESSION['username'])){
    echo "<nav class='navbar navbar-dark bg-primary'>
    <a class='navbar-brand mx-2' href='#'>Benvingut/da " . $_SESSION['username'] . "</a>
    <form action='../Controlador/logout.php' method='post' class='form-inline justify-content-arround'>
        <button class='btn btn-outline-light mx-2' type='submit' name='logout' value='logout'>Logout</button>
    </form>
</nav>";
} else{
    echo"<nav class='navbar navbar-dark bg-primary'>
    <a class='navbar-brand mx-2' href='#'>Pràctica 04</a>
    <form action='#' method='post' class='form-inline justify-content-arround'>
        <button formAction='../Vistes/login.view.php' class='btn btn-outline-light mx-2' type='submit' name='login' value='signin'>Login</button>
        <button formAction='../Vistes/signup.view.php' class='btn btn-outline-light mx-2' type='submit' name='signup' value='signup'>SignUp</button>
    </form>
</nav>";
}
?>