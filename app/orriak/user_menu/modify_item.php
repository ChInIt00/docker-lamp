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
    <title>Modificar Película - Bideoklub</title>
</head>
<body>
    <header>
        <h1>Modificar Película</h1>
    </header>

    <main>
        <form id="item_modify_form" action="../../php/modify_item_process.php?item=<?php echo $item_id; ?>" method="POST">
            <label for="izenburua">Título:</label>
            <input type="text" id="izenburua" name="izenburua" value="<?php echo $item['izenburua']; ?>" required>

            <label for="zuzendaria">Director:</label>
            <input type="text" id="zuzendaria" name="zuzendaria" value="<?php echo $item['zuzendaria']; ?>" required>

            <label for="estrenaldi_urtea">Año:</label>
            <input type="text" id="estrenaldi_urtea" name="estrenaldi_urtea" value="<?php echo $item['estrenaldi_urtea']; ?>" required>

            <label for="generoa">Género:</label>
            <input type="text" id="generoa" name="generoa" value="<?php echo $item['generoa']; ?>" required>

            <button type="submit" id="item_modify_submit">Modificar Película</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Bideoklub. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
