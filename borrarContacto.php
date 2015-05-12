<?php

include_once './auxiliares/login.php';
include_once './auxiliares/db.php';

if (isset($_GET['mail'])) {
    $mail = $_GET['mail'];
    $db = new DB();
    $resultado = $db->eliminarContacto($mail);
    echo $resultado.' '.$mail;
}
redirect("./");
?> 
