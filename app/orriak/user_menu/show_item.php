<?php
session_start();
include '../../php/db_connect.php'; 

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: /php/login.php");
    exit();
}

$item_id = $_GET['item'];
$query = mysqli_query($conn, "SELECT * FROM pelikulak WHERE id = '$item_id'");
$item = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Película - Bideoklub</title>
    <link rel="stylesheet" href="../../css/styles.css"> <!-- Enlace a tu archivo CSS -->
    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar esta película? Esta acción no se puede deshacer.');
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="user_menu.php">
                <img src="../../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
            </a>
        </div>
        <h1>Información de la Película</h1>
        <nav>
            <ul>
                <li><a href="/php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero">
        <main>
            <div class="movie-info">
                <h1><?php echo $item['izenburua']; ?></h>
                <p>Director: <?php echo $item['zuzendaria']; ?></p>
                <p>Año: <?php echo $item['estrenaldi_urtea']; ?></p>
                <p>Género: <?php echo $item['generoa']; ?></p>
            </div>
            
            <div class="button-container">
                <a href="modify_item.php?item=<?php echo $item_id; ?>" class="btn">Aldatu</a>
                <!-- Formulario para eliminar la película con confirmación -->
                <form action="delete_item.php?item=<?php echo $item_id; ?>" method="POST" onsubmit="return confirmDelete();" style="display:inline;">
                    <button type="submit" id="item_delete_submit" class="btn">Ezabatu</button>
                </form>
            </div>
            
        </main>
    </div>
    
    <footer>
        <p>&copy; 2024 Bideoklub. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
