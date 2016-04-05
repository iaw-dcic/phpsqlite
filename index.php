<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

define('index', 1);
include_once './auxiliares/login.php';
include_once './auxiliares/db.php';
include_once './auxiliares/orden.php';

function getColumnas() {
    $columnas = array("mail", "apellido", "nombre", "direccion", "telefono");
    $result = array();

    foreach ($columnas as $columna) {
        $titulo = $columna;
        $orden = getOrdenSiguiente($columna);
        $ordenUrl = "./?col=" . $columna . "&ord=" . $orden;
        array_push($result, crearColumna($titulo, $ordenUrl));
    }
    return $result;
}

function crearColumna($nombre, $ordenUrl) {
    return array(
        'nombre' => $nombre,
        'ordenUrl' => $ordenUrl
    );
}

function getContactos() {

    $db = new DB();
    $contactos = $db->obtenerContactos(getColumnaActual(), getOrdenActual());

    $result = array();

    foreach ($contactos as $contacto) {

        $file = "fotos/" . $contacto[0] . ".jpg";
        if (!file_exists($file))
            $file = 'fotos/nopicture.jpg';
        
        $uploadUrl = isLoggedIn() ? './subir.php?mail=' . $contacto[0] : null;
        $deleteUrl = isLoggedIn() ? './borrarContacto.php?mail=' . $contacto[0] : null;

        array_push($result, array(
            'mail' => $contacto[0],
            'apellido' => $contacto[1],
            'nombre' => $contacto[2],
            'direccion' => $contacto[3],
            'telefono' => $contacto[4],
            'foto' => $file,
            'uploadUrl' => $uploadUrl,
            'deleteUrl' => $deleteUrl
        ));
    }

    return $result;
}

include './vistas/principal.phtml';
?>
