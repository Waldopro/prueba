<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="stylese.css"> 
</head>
<body>
    <div class="container">
        <header>
            <h1>Formulario de Estudiantes</h1>
        </header>
        <main>
            <form method="post" action="controlador_estudiantes.php">
                <label for="cedula">Cédula:</label>
                <input type="number" name="cedula" required><br>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required><br>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required><br>

                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" required><br>

                <!-- Eliminado el campo Edad ya que lo calculamos con PHP -->
                <label for="sexo">Sexo:</label>
                <select name="sexo">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select><br>

                <label for="carrera">Carrera:</label>
                <input type="text" name="carrera" required><br>

                <label for="trayecto">Trayecto:</label>
                <select name="trayecto">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br>

                <label for="direccion">Dirección:</label>
                <textarea name="direccion" required></textarea><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono"><br>

                <label for="correo">Correo Electrónico:</label>
                <input type="email" name="correo"><br>

                <input type="submit" class="btn" name="accion" value="Registrar">
                <button type="button" class="btn" onclick="window.history.back()">Volver</button>

            </form>
        </main>
        <footer>
        <p>&copy; UPTP "Luis Mariano Rivera" Trayecto 2 2024</p>
        </footer>
    </div>
</body>
</html>
