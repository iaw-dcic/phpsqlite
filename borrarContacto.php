<?php

include_once './auxiliares/login.php';
include_once './auxiliares/db.php';

$resultado = 0;
$mail = '';

if (isset($_GET['mail'])) {
    $mail = $_GET['mail'];
    $db = new DB();
    $resultado = $db->eliminarContacto($mail);
}

Header ( "Content-type: text/xml" ); 	
echo "<resultado>";
echo " <mail>".getID($mail)."</mail>";
echo " <eliminado>".$resultado."</eliminado>";
echo "</resultado>";
