<?php
class AlumnoRepository {
    private $db;

    // Recibe la conexión desde el controlador
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Obtener todos los alumnos
    public function obtenerTodos() {
        return $this->db->query("SELECT * FROM alumnos ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
    }

    // Insertar un nuevo alumno
    public function insertar($alumno) {
        $stmt = $this->db->prepare("INSERT INTO alumnos (nombre, carnet, carrera, fecha_ingreso) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $alumno['nombre'], $alumno['carnet'], $alumno['carrera'], $alumno['fecha_ingreso']);
        return $stmt->execute();
    }

    // Actualizar alumno existente
    public function actualizar($alumno) {
        $stmt = $this->db->prepare("UPDATE alumnos SET nombre=?, carnet=?, carrera=?, fecha_ingreso=? WHERE id=?");
        $stmt->bind_param("ssssi", $alumno['nombre'], $alumno['carnet'], $alumno['carrera'], $alumno['fecha_ingreso'], $alumno['id']);
        return $stmt->execute();
    }

    // Eliminar alumno por ID
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM alumnos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}