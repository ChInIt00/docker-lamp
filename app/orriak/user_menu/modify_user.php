<?php
session_start();
include '../../php/db_connect.php'; // Ajustar la ruta correcta a la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al login
    header("Location: /php/login.php");
    exit();
}

// Obtener el ID del usuario directamente desde la sesión
$id_user = $_SESSION['user_id'];

// Consultar la base de datos
$sql = "SELECT * FROM usuarios WHERE id_user='$id_user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="../../css/styles.css"> <!-- Enlace a tu archivo CSS -->
</head>
<body>
    <header>
        <div class="logo">
            <a href="user_menu.php">
                <img src="../../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
            </a>
        </div>
        <h2>Modificar Usuario</h2>
        <nav>
            <ul>
                <li><a href="/php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero"> 
        <main>
                <?php if ($row): ?>
                    <form method="post" action="../ modify_user_process.php" class="modify-user-form"> <!-- Action apuntando a modify_user_process.php -->
                        <input type="hidden" name="id_user" value="<?= $row['id_user']; ?>"> <!-- Para pasar el ID del usuario -->
                        <div>
                            <label for="dni">DNI:</label>
                            <input type="text" name="dni" value="<?= $row['DNI']; ?>" required>
                        </div>
                        <div>
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" value="<?= $row['izen_abizenak']; ?>" required>
                        </div>
                        <div>
                            <label for="telefono">Teléfono:</label>
                            <input type="text" name="telefono" value="<?= $row['telefonoa']; ?>" required>
                        </div>
                        <div>
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" value="<?= $row['jaiotze_data']; ?>" required>
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="<?= $row['email']; ?>" required>
                        </div>
                        <button type="submit">Actualizar</button>
                    </form>
                <?php else: ?>
                    <p>No se encontró el usuario.</p>
                <?php endif; ?>

        </main>
    </div>

    <footer>
        <p>&copy; 2024 Videoclub. Todos los derechos reservados.</p>
    </footer>

    <?php mysqli_close($conn); ?>
</body>
</html>
