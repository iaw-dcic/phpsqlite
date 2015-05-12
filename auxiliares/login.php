<?php

session_start();
if (!isLoggedIn()) {
    defined('index') or defined('loginForm') or redirect("./");
}

function redirect($url) {
    header("Location: $url");
    die();
}

function isLoggedIn() {
    return isset($_SESSION['userid']);
}

function checkLogin() {
    if (!isset($_POST['username']))
        return false;

    $db = new DB();
    if ($db->validarUsuario($_POST['username'], $_POST['password'])) {
        $_SESSION['userid'] = $_POST['username'];
        unset($_SESSION['errorLogin']);
        return true;
    }
    else
        $_SESSION['errorLogin'] = "Usuario o Clave incorrectas.";

    return false;
}

function hayError() {
    return isset($_SESSION['errorLogin']);
}

function getError() {
    return $_SESSION['errorLogin'];
}

function printUserData() {
    if (isLoggedIn()) {
        echo "<li><a href='logout.php' title='Logout' style='text-transform: uppercase'>";
        echo $_SESSION['userid'];
        echo "</a></li>";
    } else {
        echo "<li><a href='login.php'>Ingresar</a></li>";
    }
}

?>