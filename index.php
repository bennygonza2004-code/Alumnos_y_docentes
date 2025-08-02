<?php
// Encabezados CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Cargar archivos con rutas reales según nombres de carpetas
require_once realpath(__DIR__ . '/Config/conexion.php');
require_once realpath(__DIR__ . '/Controles/AlumnoController.php');
require_once realpath(__DIR__ . '/Controles/CatedraticoController.php');

// Obtener conexión
$conexion = getConexion();

// Método, tipo y datos
$method = $_SERVER['REQUEST_METHOD'];
$tipo = $_GET['tipo'] ?? '';
$data = json_decode(file_get_contents("php://input"), true);

// Enrutar según tipo
if ($tipo === 'alumno') {
    $controller = new AlumnoController($conexion);
    $resultado = $controller->manejar($method, $data);
    echo json_encode($resultado);
} elseif ($tipo === 'catedratico') {
    $controller = new CatedraticoController($conexion);
    $resultado = $controller->manejar($method, $data);
    echo json_encode($resultado);
} else {
    echo json_encode(["error" => "Parámetro 'tipo' no válido"]);
}