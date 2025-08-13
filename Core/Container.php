<?php
require_once __DIR__ . '/../Repositorio/AlumnoRepository.php';
require_once __DIR__ . '/../Repositorio/CatedraticoRepository.php';
require_once __DIR__ . '/../Servicio/AlumnoService.php';
require_once __DIR__ . '/../Servicio/CatedraticoService.php';
require_once __DIR__ . '/../Validadores/AlumnoValidator.php';
require_once __DIR__ . '/../Validadores/CatedraticoValidator.php';
require_once __DIR__ . '/../Controles/AlumnoController.php';
require_once __DIR__ . '/../Controles/CatedraticoController.php';

class Container {
    private $db;
    public function __construct($conexion) { $this->db = $conexion; }

    public function alumnoController() {
        $repo = new AlumnoRepository($this->db);
        $service = new AlumnoService($repo, new AlumnoValidator());
        return new AlumnoController($service);
    }

    public function catedraticoController() {
        $repo = new CatedraticoRepository($this->db);
        $service = new CatedraticoService($repo, new CatedraticoValidator());
        return new CatedraticoController($service);
    }
}
