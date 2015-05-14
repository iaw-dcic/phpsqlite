<?php

define('loginForm', 1);
include_once './auxiliares/db.php';
include_once './auxiliares/login.php';


if (checkLogin())
    redirect("./");

function getErrorLogin() {
    return hayError() ? getError() : "";
}

include './vistas/template.phtml';
include './vistas/login.phtml';
?>
