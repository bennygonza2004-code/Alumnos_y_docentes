<?php
class CatedraticoRepository {
    private $db;

    // Recibe la conexión a la base de datos
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Obtener todos los catedráticos
    public function obtenerTodos() {
        return $this->db->query("SELECT * FROM catedraticos ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
    }

    // Insertar un nuevo catedrático
    public function insertar($catedratico) {
        $stmt = $this->db->prepare("INSERT INTO catedraticos (nombre, especialidad, correo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $catedratico['nombre'], $catedratico['especialidad'], $catedratico['correo']);
        return $stmt->execute();
    }

    // Actualizar un catedrático existente
    public function actualizar($catedratico) {
        $stmt = $this->db->prepare("UPDATE catedraticos SET nombre = ?, especialidad = ?, correo = ? WHERE id = ?");
        $stmt->bind_param("sssi", $catedratico['nombre'], $catedratico['especialidad'], $catedratico['correo'], $catedratico['id']);
        return $stmt->execute();
    }

    // Eliminar un catedrático por ID
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM catedraticos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
