<?php
class AlumnoService {
    private $repo;

    public function __construct($repo) {
        $this->repo = $repo;
    }

    public function obtenerAlumnos() {
        return $this->repo->obtenerTodos();
    }

    public function agregarAlumnos($data) {
        $alumnos = isset($data[0]) ? $data : [$data];
        foreach ($alumnos as $alumno) {
            if (!isset($alumno['nombre'], $alumno['carnet'], $alumno['carrera'], $alumno['fecha_ingreso'])) {
                return false;
            }
            $this->repo->insertar($alumno);
        }
        return true;
    }

    public function actualizarAlumno($alumno) {
        if (!isset($alumno['id'], $alumno['nombre'], $alumno['carnet'], $alumno['carrera'], $alumno['fecha_ingreso'])) {
            return false;
        }
        return $this->repo->actualizar($alumno);
    }

    public function eliminarAlumno($id) {
        return $this->repo->eliminar($id);
    }
}