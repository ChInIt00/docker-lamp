<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: /php/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú del Usuario</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="user_menu.php">
                <img src="../../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
            </a>
        </div>
        <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
        <nav>
            <ul>
                <li><a href="/php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="hero"> 
        <main>
            <!--<h2>Opciones disponibles:</h2> -->
            <ul class="button-list"> <!-- Añadir una clase aquí -->
                <li><a href="modify_user.php" class="button">Modificar mis datos</a></li>
                <li><a href="add_item.php" class="button">Añadir una película</a></li>
                <li><a href="items.php" class="button">Ver todas las películas</a></li>
                <li><a href="/php/logout.php" class="button">Cerrar sesión</a></li>
            </ul>
        </main>
    </div>
</body>
</html>
