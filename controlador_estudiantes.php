<?php
require_once 'conexion.php'; // Archivo para la conexión a la base de datos
require_once 'estudiante.php'; // Clase Estudiante

// Crear una conexión a la base de datos
try {
    $db = new Conexion(); // Instancia de conexión
    $conexion = $db->conectar(); // Establece la conexión
} catch (Exception $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

$accion = $_POST['accion'] ?? null;

if ($accion) {
    // Crear una instancia de la clase Estudiante
    $estudiante = new Estudiante($conexion);

    // Registrar un estudiante
    if ($accion === 'Registrar') {
        $estudiante->cedula = $_POST['cedula'];
        $estudiante->nombre = $_POST['nombre'];
        $estudiante->apellido = $_POST['apellido'];
        $estudiante->fechaNacimiento = $_POST['fecha_nacimiento'];
        // Calcular la edad
        $fechaNacimiento = new DateTime($_POST['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        $estudiante->sexo = $_POST['sexo'];
        $estudiante->direccion = $_POST['direccion'];
        $estudiante->telefono = $_POST['telefono'];
        $estudiante->correo = $_POST['correo'];
        $estudiante->carrera = $_POST['carrera'];
        $estudiante->trayecto = $_POST['trayecto'];

        if ($estudiante->registrar()) {
            header("Location: listado_estudiantes.php?mensaje=Registro exitoso");
        } else {
            echo "Error al registrar el estudiante.";
        }
    }

    // Actualizar un estudiante
    if ($accion === 'Actualizar') {
        $estudiante->id = $_POST['id'];
        $estudiante->cedula = $_POST['cedula'];
        $estudiante->nombre = $_POST['nombre'];
        $estudiante->apellido = $_POST['apellido'];
        $estudiante->fechaNacimiento = $_POST['fecha_nacimiento'];
        $fechaNacimiento = new DateTime($_POST['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        $estudiante->sexo = $_POST['sexo'];
        $estudiante->direccion = $_POST['direccion'];
        $estudiante->telefono = $_POST['telefono'];
        $estudiante->correo = $_POST['correo'];
        $estudiante->carrera = $_POST['carrera'];
        $estudiante->trayecto = $_POST['trayecto'];

        if ($estudiante->actualizar()) {
            header("Location: listado_estudiantes.php?mensaje=Actualización exitosa");
        } else {
            echo "Error al actualizar el estudiante.";
        }
    }

    // Eliminar un estudiante
    if ($accion === 'Eliminar') {
        $id = $_POST['id'];

        if ($estudiante->eliminar($id)) {
            header("Location: listado_estudiantes.php?mensaje=Eliminación exitosa");
        } else {
            echo "Error al eliminar el estudiante.";
        }
    }
}
?>
