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
    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar esta película? Esta acción no se puede deshacer.');
        }
    </script>
</head>
<body>
    <header>
        <h1>Información de la Película</h1>
    </header>

    <main>
        <h2><?php echo $item['izenburua']; ?></h2>
        <p>Director: <?php echo $item['zuzendaria']; ?></p>
        <p>Año: <?php echo $item['estrenaldi_urtea']; ?></p>
        <p>Género: <?php echo $item['generoa']; ?></p>
        <a href="modify_item.php?item=<?php echo $item_id; ?>">Modificar Película</a>
        <!-- Formulario para eliminar la película con confirmación -->
        <form action="delete_item.php?item=<?php echo $item_id; ?>" method="POST" onsubmit="return confirmDelete();">
            <button type="submit" id="item_delete_submit">Eliminar Película</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Bideoklub. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
