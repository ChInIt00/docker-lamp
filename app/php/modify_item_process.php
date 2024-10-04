<?php
session_start();
include 'db_connect.php'; // Incluir la conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: /php/login.php");
    exit();
}

// Obtener el ID del ítem (película) desde la URL
$item_id = $_GET['item'];

// Verificar si se recibió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = mysqli_real_escape_string($conn, $_POST['izenburua']);
    $director = mysqli_real_escape_string($conn, $_POST['zuzendaria']);
    $anio = mysqli_real_escape_string($conn, $_POST['estrenaldi_urtea']);
    $genero = mysqli_real_escape_string($conn, $_POST['generoa']);

    // Validar los datos (opcional, pero recomendable)
    if (empty($titulo) || empty($director) || empty($anio) || empty($genero)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Actualizar la película en la base de datos
    $sql = "UPDATE pelikulak 
            SET izenburua='$titulo', zuzendaria='$director', estrenaldi_urtea='$anio', generoa='$genero' 
            WHERE id='$item_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Película modificada exitosamente. <a href='../orriak/user_menu/show_item.php?item=$item_id'>Ver detalles</a>";
    } else {
        echo "Error al modificar la película: " . mysqli_error($conn);
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>
