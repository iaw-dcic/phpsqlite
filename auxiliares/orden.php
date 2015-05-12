<?php

function getColumna() {
    return isset($_GET['col']) ? $_GET['col'] : "apellido";
}

function getOrden() {
    return isset($_GET['ord']) ? $_GET['ord'] : "asc";
}

function isOrderedBy($columna) {
    return (getColumna() == $columna);
}

function inverseOrder($order) {
    if ($order == "asc")
        return "desc";
    else
        return "asc";
}

function getOrder($columna) {
    if (isOrderedBy($columna))
        return inverseOrder(getOrden());
    else
        return "asc";
}
