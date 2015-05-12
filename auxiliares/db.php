<?php

class DB {

    var $db;
    
    function DB() {
        $path = str_replace("auxiliares", "", dirname(__FILE__));
        $dbase = $path . "db/contactos.sqlite";

        try {
            $this->db = new PDO('sqlite:' . $dbase);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    function obtenerContactos() {
        $columna = getColumna();
        return $this->db->query("SELECT * FROM contactos ORDER BY " . $columna . " " . getOrder($columna))->fetchAll();
    }

    function eliminarContacto($mail) {
        return $this->db->exec("DELETE FROM contactos WHERE mail='$mail'");
    }

    function agregarContacto($mail, $apellido, $nombre, $direccion, $telefono) {
        return $this->db->exec("INSERT INTO contactos VALUES ('$mail', '$apellido', '$nombre', '$direccion', '$telefono')");
    }

    function validarUsuario($user, $pass) {
        $user = strtolower($user);

        $usuario = $this->db->query("SELECT clave FROM usuarios WHERE usuario='$user'")->fetch();
        return strcmp($usuario['clave'], md5($pass)) == 0;
    }
}

?>