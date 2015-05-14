<?php

define('loginForm', 1);
include_once './auxiliares/login.php';

if (checkLogin())
    redirect("./");

function getErrorLogin() {
    return isset($_SESSION['errorLogin'])? $_SESSION['errorLogin'] : "";
}

include './vistas/template.phtml';
include './vistas/login.phtml';
?>
