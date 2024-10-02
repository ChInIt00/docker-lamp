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
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo $_SESSION['user_email']; ?></h1>
    </header>

    <main>
        <h2>Opciones disponibles:</h2>
        <ul>
            <li><a href="modify_user.php">Modificar mis datos</a></li>
            <li><a href="add_item.php">Añadir una película</a></li>
            <li><a href="view_movies.php">Ver todas las películas</a></li>
            <li><a href="/php/logout.php">Cerrar sesión</a></li>
        </ul>
    </main>
</body>
</html>
