<?php
require_once __DIR__ . '/../Interfaces/ServiceInterfaces.php';
require_once __DIR__ . '/../Interfaces/RepositoryInterfaces.php';
require_once __DIR__ . '/../Validadores/CatedraticoValidator.php';

class CatedraticoService implements CatedraticoServiceInterface {
    private $repo;      // CatedraticoRepositoryInterface
    private $validator; // CatedraticoValidator

    public function __construct(CatedraticoRepositoryInterface $repo, CatedraticoValidator $validator) {
        $this->repo = $repo;
        $this->validator = $validator;
    }

    public function obtenerCatedraticos() {
        return $this->repo->obtenerTodos();
    }

    public function agregarCatedraticos($data) {
        $lista = isset($data[0]) ? $data : [$data];
        foreach ($lista as $c) {
            $errores = $this->validator->validateCreate($c);
            if ($errores) return ["success" => false, "errores" => $errores];
            if (!$this->repo->insertar($c)) return ["success" => false];
        }
        return ["success" => true];
    }

    public function actualizarCatedratico($c) {
        $errores = $this->validator->validateUpdate($c);
        if ($errores) return ["success" => false, "errores" => $errores];
        return ["success" => (bool)$this->repo->actualizar($c)];
    }

    public function eliminarCatedratico($id) {
        return ["success" => (bool)$this->repo->eliminar($id)];
    }
}
