<?php
require_once __DIR__ . '/../Interfaces/RepositoryInterfaces.php';

class AlumnoRepository implements AlumnoRepositoryInterface {
    private $db;
    public function __construct($conexion) { $this->db = $conexion; }

    public function obtenerTodos() {
        return $this->db->query("SELECT * FROM alumnos ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
    }

    public function insertar($alumno) {
        $stmt = $this->db->prepare(
            "INSERT INTO alumnos (nombre, carnet, carrera, fecha_ingreso) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $alumno['nombre'], $alumno['carnet'], $alumno['carrera'], $alumno['fecha_ingreso']);
        return $stmt->execute();
    }

    public function actualizar($alumno) {
        $stmt = $this->db->prepare(
            "UPDATE alumnos SET nombre=?, carnet=?, carrera=?, fecha_ingreso=? WHERE id=?"
        );
        $stmt->bind_param("ssssi", $alumno['nombre'], $alumno['carnet'], $alumno['carrera'], $alumno['fecha_ingreso'], $alumno['id']);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM alumnos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
