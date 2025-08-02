<?php
// Rutas ajustadas a tu estructura personalizada
require_once __DIR__ . '/../Servicio/CatedraticoService.php';
require_once __DIR__ . '/../Repositorio/CatedraticoRepository.php';

class CatedraticoController {
    private $servicio;

    // Constructor: inyecta dependencias usando el repositorio
    public function __construct($conexion) {
        $repositorio = new CatedraticoRepository($conexion);
        $this->servicio = new CatedraticoService($repositorio);
    }

    // Enrutamiento del método HTTP
    public function manejar($method, $data) {
        switch ($method) {
            case 'GET':
                return $this->servicio->obtenerCatedraticos();
            case 'POST':
                return ["success" => $this->servicio->agregarCatedraticos($data)];
            case 'PUT':
                return ["success" => $this->servicio->actualizarCatedratico($data)];
            case 'DELETE':
                return isset($data['id']) ? ["success" => $this->servicio->eliminarCatedratico($data['id'])] : ["error" => "ID no proporcionado"];
            default:
                return ["error" => "Método no soportado"];
        }
    }
}