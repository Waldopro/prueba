<?php
class Estudiante {
    private $conexion;
    public $id;
    public $cedula;
    public $nombre;
    public $apellido;
    public $fechaNacimiento;
    public $sexo;
    public $direccion;
    public $telefono;
    public $correo;
    public $carrera;
    public $trayecto;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar() {
        $query = $this->conexion->prepare("INSERT INTO estudiantes (cedula, nombre, apellido, fecha_nacimiento, sexo, direccion, telefono, correo, carrera, trayecto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssssssss", $this->cedula, $this->nombre, $this->apellido, $this->fechaNacimiento, $this->sexo, $this->direccion, $this->telefono, $this->correo, $this->carrera, $this->trayecto);
        return $query->execute();
    }

    public function actualizar() {
        $query = $this->conexion->prepare("UPDATE estudiantes SET cedula = ?, nombre = ?, apellido = ?, fecha_nacimiento = ?, sexo = ?, direccion = ?, telefono = ?, correo = ?, carrera = ?, trayecto = ? WHERE id = ?");
        $query->bind_param("ssssssssssi", $this->cedula, $this->nombre, $this->apellido, $this->fechaNacimiento, $this->sexo, $this->direccion, $this->telefono, $this->correo, $this->carrera, $this->trayecto, $this->id);
        return $query->execute();
    }

    public function eliminar($id) {
        $query = $this->conexion->prepare("DELETE FROM estudiantes WHERE id = ?");
        $query->bind_param("i", $id);
        return $query->execute();
    }
}
?>
