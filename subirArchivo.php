<?php

include_once './auxiliares/login.php';

if ($_FILES["file"]["type"] == "")
    redirect("./");

$error = null;

// Controlar si son los tipos de archivo autorizados
if (($_FILES["file"]["type"] == "image/jpeg") && ($_FILES["file"]["size"] < 20000)) { // menor a 20k
    if ($_FILES["file"]["error"] > 0) {
        $error = "Error: " . $_FILES["file"]["error"];
    } else {
        $carpeta_archivos = "fotos/";
        $file = $_POST['mail'] . ".jpg";
        move_uploaded_file($_FILES["file"]["tmp_name"], $carpeta_archivos . $file);
        redirect("./");
    }
}
else
    if ($_FILES["file"]["type"] == "image/jpeg") 
        $error = "Error: Supera el tamaño máximo de 20k.";
    else 
        $error = "Error: Formato no soportado: " . $_FILES["file"]["type"];


include './vistas/subirArchivo.phtml';

?> 
