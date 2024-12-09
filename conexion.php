<?php
class Conexion {
    private $host = 'localhost';
    private $usuario = 'root';  // Cambia esto por tu usuario de base de datos
    private $password = '1704';     // Cambia esto por tu contraseña de base de datos
    private $baseDatos = 'luis'; // Cambia esto por el nombre de tu base de datos
    private $conexion;

    public function conectar() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);

        // Comprobar conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        return $this->conexion;
    }

    public function cerrar() {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}
?>
