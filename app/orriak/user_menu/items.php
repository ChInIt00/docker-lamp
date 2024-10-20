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
    <title>Filmeak - Bideoklub</title>
    <link rel="stylesheet" href="../../css/styles.css"> 
</head>
<body>
    <header>
        <div class="logo">
            <a href="user_menu.php">
                <img src="../../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
            </a>
        </div>
        <h1>Gure Filmeak</h1>
        <nav>
            <ul>
                <li><a href="/php/logout.php">Saioa Itxi</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero">
        <main>
            <div class="table-container"> <!-- Contenedor para la tabla -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th> 
                            <th>Izenburua</th>
                            <th>Zuzenendaria</th> 
                            <th>Estrenaldi Urtea</th>
                            <th>Generoa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mostrar cada película
                        while ($row = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>"; // Mostrar el ID de la película
                            echo "<td><a href='show_item.php?item={$row['id']}'>{$row['izenburua']}</a></td>";
                            echo "<td>{$row['zuzendaria']}</td>"; // Mostrar el director de la película
                            echo "<td>{$row['estrenaldi_urtea']}</td>";
                            echo "<td>{$row['generoa']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add_item.php" class="btn">Film berria gehitu</a>
            </div>
        </main>
    </div>
    
    <footer>
        <p>&copy; 2024 Bideokluba.</p>
    </footer>
</body>
</html>
