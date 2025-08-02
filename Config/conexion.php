<?php
function getConexion() {
    $conexion = new mysqli("localhost", "root", "", "alumnos_docentes");
    if ($conexion->connect_error) {
        die(json_encode(["error" => "Conexión fallida: " . $conexion->connect_error]));
    }
    return $conexion;
}