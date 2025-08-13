<?php
// CORS
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

// Carga núcleo
require_once __DIR__ . '/Config/conexion.php';
require_once __DIR__ . '/Core/Container.php';
require_once __DIR__ . '/Core/Router.php';

$conexion = getConexion();
$container = new Container($conexion);
$router    = new Router($container);

// Entrada
$method = $_SERVER['REQUEST_METHOD'];
$tipo   = $_GET['tipo'] ?? '';
$raw    = file_get_contents("php://input");
$data   = json_decode($raw ?: "[]", true);

// Despacho
$result = $router->dispatch($tipo, $method, $data);
echo json_encode($result, JSON_UNESCAPED_UNICODE);
