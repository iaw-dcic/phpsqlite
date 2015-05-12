<?php

include_once './auxiliares/login.php';
include_once './auxiliares/db.php';

if (isset($_POST['agregar'])) {
    $mail = $_POST['mail'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $db = new DB();
    $db->agregarContacto($mail, $apellido, $nombre, $direccion, $telefono);
}

redirect("./");

?> 
