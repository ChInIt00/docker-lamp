<?php
session_start();
include 'db_connect.php'; // Ajustar la ruta si es necesario

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: /php/login.php");
    exit();
}

// Verificar si la conexión es válida
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos enviados desde el formulario
    $izenburua = mysqli_real_escape_string($conn, $_POST['izenburua']);
    $zuzendaria = mysqli_real_escape_string($conn, $_POST['zuzendaria']);
    $estrenaldi_urtea = mysqli_real_escape_string($conn, $_POST['estrenaldi_urtea']);
    $generoa = mysqli_real_escape_string($conn, $_POST['generoa']);

    // Validar que los campos no estén vacíos
    if (empty($izenburua) || empty($zuzendaria) || empty($estrenaldi_urtea) || empty($generoa)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO pelikulak (izenburua, zuzendaria, estrenaldi_urtea, generoa) 
            VALUES ('$izenburua', '$zuzendaria', '$estrenaldi_urtea', '$generoa')";

    if (mysqli_query($conn, $sql)) {
        echo "Película agregada exitosamente. <a href='view_movies.php'>Ver todas las películas</a><br>";
        echo "<a href='../orriak/user_menu/user_menu.php'>Volver al menú del usuario</a>";
    } else {
        echo "Error al agregar la película: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    echo "Método no permitido.";
}
?>
