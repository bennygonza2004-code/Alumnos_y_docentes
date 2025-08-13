<?php
require_once __DIR__ . '/../Interfaces/RepositoryInterfaces.php';

class CatedraticoRepository implements CatedraticoRepositoryInterface {
    private $db;
    public function __construct($conexion) { $this->db = $conexion; }

    public function obtenerTodos() {
        return $this->db->query("SELECT * FROM catedraticos ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
    }

    public function insertar($c) {
        $stmt = $this->db->prepare(
            "INSERT INTO catedraticos (nombre, especialidad, correo) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $c['nombre'], $c['especialidad'], $c['correo']);
        return $stmt->execute();
    }

    public function actualizar($c) {
        $stmt = $this->db->prepare(
            "UPDATE catedraticos SET nombre=?, especialidad=?, correo=? WHERE id=?"
        );
        $stmt->bind_param("sssi", $c['nombre'], $c['especialidad'], $c['correo'], $c['id']);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM catedraticos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
