<?php
require_once 'conexion.php';
require_once 'estudiante.php';

try {
    $db = new Conexion(); // Crea la instancia de la clase
    $conexion = $db->conectar(); // Obtén la conexión

    // Prepara y ejecuta la consulta para obtener los estudiantes
    $query = $conexion->prepare("SELECT * FROM estudiantes");
    $query->execute();
    $resultado = $query->get_result();

    $estudiantes = [];
    while ($fila = $resultado->fetch_assoc()) {
        $estudiantes[] = $fila; // Agrega cada fila al array
    }

    $db->cerrar(); // Cierra la conexión
} catch (Exception $e) {
    echo "Error al cargar los estudiantes: " . $e->getMessage();
    exit;
}

// Función para calcular la edad
function calcularEdad($fechaNacimiento) {
    $fechaActual = new DateTime();
    $fechaNacimiento = new DateTime($fechaNacimiento);
    $edad = $fechaActual->diff($fechaNacimiento)->y;
    return $edad;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Estudiantes</title>
    <link rel="stylesheet" href="tabla1.css">
    <link rel="stylesheet" href="stylese.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Listado de Estudiantes</h1>
    </header>
    <main>
        <?php if (isset($_GET['mensaje'])): ?>
            <p style="color: green;"><?php echo htmlspecialchars($_GET['mensaje']); ?></p>
        <?php endif; ?>
        <button  class="btn" onclick="window.location.href='formulario_estudiante.php'">Registrar nuevo estudiante</button>
        <button  class="btn" onclick="window.location.href='index.php'">Ir al Inicio</button><br><br>

        <div class="tabla-wrapper">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Carrera</th>
                        <th>Trayecto</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estudiantes as $est): ?>
                        <?php $edad = calcularEdad($est['fecha_nacimiento']); // Calculamos la edad ?>
                        <tr>
                            <td><?php echo $est['id']; ?></td>
                            <td><?php echo $est['cedula']; ?></td>
                            <td><?php echo $est['nombre']; ?></td>
                            <td><?php echo $est['apellido']; ?></td>
                            <td><?php echo $est['fecha_nacimiento']; ?></td>
                            <td><?php echo $edad; ?></td> <!-- Mostramos la edad calculada -->
                            <td><?php echo $est['sexo']; ?></td>
                            <td><?php echo $est['carrera']; ?></td>
                            <td><?php echo $est['trayecto']; ?></td>
                            <td><?php echo $est['direccion']; ?></td>
                            <td><?php echo $est['telefono']; ?></td>
                            <td><?php echo $est['correo']; ?></td>
                            <td>
                                <form method="post" action="formulario_editar.php">
                                    <input type="hidden" name="id" value="<?php echo $est['id']; ?>">
                                    <input type="submit" value="Editar">
                                </form>
                                <form method="post" action="controlador_estudiantes.php">
                                    <input type="hidden" name="id" value="<?php echo $est['id']; ?>">
                                    <input type="hidden" name="accion" value="Eliminar">
                                    <input type="submit" value="Eliminar">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy; UPTP "Luis Mariano Rivera" Trayecto 2 2024</p>
    </footer>
</div>
</body>
</html>
