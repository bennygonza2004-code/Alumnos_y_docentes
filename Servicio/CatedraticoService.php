<?php
class CatedraticoService {
    private $repo;

    public function __construct($repo) {
        $this->repo = $repo;
    }

    public function obtenerCatedraticos() {
        return $this->repo->obtenerTodos();
    }

    public function agregarCatedraticos($data) {
        $catedraticos = isset($data[0]) ? $data : [$data];
        foreach ($catedraticos as $cat) {
            if (!isset($cat['nombre'], $cat['especialidad'], $cat['correo'])) {
                return false;
            }
            $this->repo->insertar($cat);
        }
        return true;
    }

    public function actualizarCatedratico($cat) {
        if (!isset($cat['id'], $cat['nombre'], $cat['especialidad'], $cat['correo'])) {
            return false;
        }
        return $this->repo->actualizar($cat);
    }

    public function eliminarCatedratico($id) {
        return $this->repo->eliminar($id);
    }
}