<?php

define('loginForm', 1);
include_once './auxiliares/db.php';
include_once './auxiliares/login.php';


if (checkLogin())
    redirect("./");

function getErrorLogin() {
    return isset($_SESSION['errorLogin'])? $_SESSION['errorLogin'] : "";
}

include './vistas/login.phtml';
?>
