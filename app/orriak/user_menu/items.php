<?php
session_start();
include '../../php/db_connect.php'; 

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: /php/login.php");
    exit();
}

// Ejecutar la consulta para obtener todas las películas
$query = mysqli_query($conn, "SELECT * FROM pelikulak");

if (!$query) {
    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas - Bideoklub</title>
</head>
<body>
    <header>
        <h1>Nuestras Películas</h1>
    </header>

    <main>
        <?php
        // Mostrar cada película
        while ($row = mysqli_fetch_array($query)) {
            echo "<div class='pelicula'>";
            echo "<h3><a href='show_item.php?item={$row['id']}'>{$row['izenburua']}</a></h3>";
            echo "<p>Director: {$row['zuzendaria']}</p>";
            /*echo "<p>Año: {$row['estrenaldi_urtea']}</p>";
            echo "<p>Género: {$row['generoa']}</p>";*/
            echo "</div>";
        }
        ?>
        <a href="add_item.php">Agregar Nueva Película</a>
    </main>

    <footer>
        <p>&copy; 2024 Bideoklub. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
