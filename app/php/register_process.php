<?php
include 'db_connect.php'; // Incluir la conexión a la base de datos

// Procesar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y escapar los datos del formulario para evitar inyección SQL
    $dni = mysqli_real_escape_string($conn, $_POST['DNI']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefonoa']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['jaiotze_data']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pasahitza']);

    // Insertar el nuevo usuario con la contraseña en texto plano
    $sql = "INSERT INTO usuarios (DNI, izen_abizenak, telefonoa, jaiotze_data, email, pasahitza) 
            VALUES ('$dni', '$nombre', '$telefono', '$fecha_nacimiento', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro exitoso. <a href='/orriak/login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
