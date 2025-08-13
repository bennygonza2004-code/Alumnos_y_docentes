<?php
require_once __DIR__ . '/../Interfaces/ServiceInterfaces.php';
require_once __DIR__ . '/../Interfaces/RepositoryInterfaces.php';
require_once __DIR__ . '/../Validadores/AlumnoValidator.php';

class AlumnoService implements AlumnoServiceInterface {
    private $repo;      // AlumnoRepositoryInterface
    private $validator; // AlumnoValidator

    public function __construct(AlumnoRepositoryInterface $repo, AlumnoValidator $validator) {
        $this->repo = $repo;
        $this->validator = $validator;
    }

    public function obtenerAlumnos() {
        return $this->repo->obtenerTodos();
    }

    public function agregarAlumnos($data) {
        $lista = isset($data[0]) ? $data : [$data];
        foreach ($lista as $a) {
            $errores = $this->validator->validateCreate($a);
            if ($errores) return ["success" => false, "errores" => $errores];
            if (!$this->repo->insertar($a)) return ["success" => false];
        }
        return ["success" => true];
    }

    public function actualizarAlumno($a) {
        $errores = $this->validator->validateUpdate($a);
        if ($errores) return ["success" => false, "errores" => $errores];
        return ["success" => (bool)$this->repo->actualizar($a)];
    }

    public function eliminarAlumno($id) {
        return ["success" => (bool)$this->repo->eliminar($id)];
    }
}
