<?php

function getColumnaActual() {
    return isset($_GET['col']) ? $_GET['col'] : "apellido";
}

function getOrdenActual() {
    return isset($_GET['ord']) ? $_GET['ord'] : "asc";
}



function isOrderedBy($columna) {
    return (getColumnaActual() == $columna);
}

function inverseOrder($order) {
    if ($order == "asc")
        return "desc";
    else
        return "asc";
}

function getOrdenSiguiente($columna) {
    if (isOrderedBy($columna))
        return inverseOrder(getOrdenActual());
    else
        return "asc";
}
