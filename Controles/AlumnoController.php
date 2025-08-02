<?php
// Cargar el servicio y el repositorio desde las carpetas reales
require_once __DIR__ . '/../Servicio/AlumnoService.php';
require_once __DIR__ . '/../Repositorio/AlumnoRepository.php';

class AlumnoController {
    private $servicio;

    // El constructor recibe la conexión y crea las instancias necesarias
    public function __construct($conexion) {
        $repositorio = new AlumnoRepository($conexion);
        $this->servicio = new AlumnoService($repositorio);
    }

    // Maneja los métodos HTTP según corresponda
    public function manejar($method, $data) {
        switch ($method) {
            case 'GET':
                return $this->servicio->obtenerAlumnos();
            case 'POST':
                return ["success" => $this->servicio->agregarAlumnos($data)];
            case 'PUT':
                return ["success" => $this->servicio->actualizarAlumno($data)];
            case 'DELETE':
                return isset($data['id']) ? ["success" => $this->servicio->eliminarAlumno($data['id'])] : ["error" => "ID no proporcionado"];
            default:
                return ["error" => "Método no soportado"];
        }
    }
}