<?php
// Iniciar la sesión al principio del archivo
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

if ($row) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Procesar el formulario de modificación
        $dni = mysqli_real_escape_string($conn, $_POST['dni']);
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
        $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Actualizar el usuario en la base de datos
        $sql = "UPDATE usuarios SET DNI='$dni', izen_abizenak='$nombre', telefonoa='$telefono', jaiotze_data='$fecha_nacimiento', email='$email' WHERE id_user='$id_user'";

        if (mysqli_query($conn, $sql)) {
            echo "Usuario actualizado exitosamente.
            <a href='user_menu.php'>Volver al menú del usuario</a>";
        } else {
            echo "Error actualizando usuario: " . mysqli_error($conn);
        }
    }

    // Mostrar el formulario de modificación
    echo "<h1>Modificar Usuario</h1>";
    echo "<form method='post'>";
    echo "DNI: <input type='text' name='dni' value='" . $row['DNI'] . "' required><br>";
    echo "Nombre: <input type='text' name='nombre' value='" . $row['izen_abizenak'] . "' required><br>";
    echo "Teléfono: <input type='text' name='telefono' value='" . $row['telefonoa'] . "' required><br>";
    echo "Fecha de Nacimiento: <input type='date' name='fecha_nacimiento' value='" . $row['jaiotze_data'] . "' required><br>";
    echo "Email: <input type='email' name='email' value='" . $row['email'] . "' required><br>";
    echo "<button type='submit'>Actualizar</button>";
    echo "</form>";
} else {
    echo "No se encontró el usuario.";
}

mysqli_close($conn);
?>
