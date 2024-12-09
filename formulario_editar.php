<?php
require_once 'conexion.php'; // Asegúrate de que este archivo contiene tu clase de conexión a la base de datos
require_once 'estudiante.php';
if (!isset($_POST['id'])) {
    echo "ID del estudiante no proporcionado.";
    exit;
}

$id_estudiante = intval($_POST['id']); // Asegúrate de sanitizar el ID recibido
try {
    $db = new Conexion(); // Crear una instancia de la clase conexión
    $conn = $db->conectar();

    // Preparar y ejecutar la consulta
    $query = $conn->prepare("SELECT * FROM estudiantes WHERE id = ?");
    $query->bind_param("i", $id_estudiante);
    $query->execute();

    $resultado = $query->get_result();
    if ($resultado->num_rows > 0) {
        $estudiante = $resultado->fetch_assoc(); // Obtener los datos del estudiante
    } else {
        echo "Estudiante no encontrado.";
        exit;
    }
} catch (Exception $e) {
    echo "Error al cargar los datos del estudiante: " . $e->getMessage();
    exit;
}
$fechaNacimiento = new DateTime($estudiante['fecha_nacimiento']);
$hoy = new DateTime();
$edad = $hoy->diff($fechaNacimiento)->y;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="stylese.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Estudiante</h1>
        </header>
        <main>
            <form action="controlador_estudiantes.php" method="POST" class="form">
                <input type="hidden" name="accion" value="Actualizar">
                <input type="hidden" name="id" value="<?php echo $estudiante['id']; ?>">
                
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" readonly value="<?php echo $estudiante['cedula']; ?>" required>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $estudiante['nombre']; ?>" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $estudiante['apellido']; ?>" required>

                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $estudiante['fecha_nacimiento']; ?>" required>

                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="M" <?php echo $estudiante['sexo'] === 'M' ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo $estudiante['sexo'] === 'F' ? 'selected' : ''; ?>>Femenino</option>
                </select>

                <label for="direccion">Dirección:</label>
                <textarea id="direccion" name="direccion" rows="3" required><?php echo $estudiante['direccion']; ?></textarea>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo $estudiante['telefono']; ?>" required>


                <label for="carrera">Carrera:</label>
                <select id="carrera" name="carrera" required>
                    <option value="Ingeniería" <?php echo $estudiante['carrera'] === 'Ingeniería' ? 'selected' : ''; ?>>Ingeniería</option>
                    <option value="Medicina" <?php echo $estudiante['carrera'] === 'Medicina' ? 'selected' : ''; ?>>Medicina</option>
                    <option value="Derecho" <?php echo $estudiante['carrera'] === 'Derecho' ? 'selected' : ''; ?>>Derecho</option>
                </select>

                <label for="trayecto">Trayecto:</label>
                <select id="trayecto" name="trayecto" required>
                    <option value="1" <?php echo $estudiante['trayecto'] === '1' ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo $estudiante['trayecto'] === '2' ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo $estudiante['trayecto'] === '3' ? 'selected' : ''; ?>>3</option>
                    <option value="3" <?php echo $estudiante['trayecto'] === '3' ? 'selected' : ''; ?>>3</option>
                </select>

                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo $estudiante['correo']; ?>" required>

                <button type="submit" class="btn">Guardar Cambios</button>
                <button type="button" class="btn" onclick="window.location.href='listado_estudiantes.php'">Volver</button>

            </form>
        </main>
        <footer>
        <p>&copy; UPTP "Luis Mariano Rivera" Trayecto 2 2024</p>
        </footer>
    </div>
</body>
</html>
