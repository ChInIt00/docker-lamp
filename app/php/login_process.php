<?php
include 'db_connect.php'; // Incluir la conexión a la base de datos

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar los datos de entrada para evitar inyecciones SQL
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pasahitza']);

    // Buscar el usuario por email
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Comparar la contraseña en texto plano
        if ($password === $row['pasahitza']) {
            // Iniciar sesión exitosa, guardar la sesión del usuario
            session_start();
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['nombre'] = $row['izen_abizenak'];

            // Redirigir al menú de usuario o página principal
            header("Location: ../orriak/user_menu/user_menu.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró un usuario con ese email.";
    }
}

mysqli_close($conn);
?>
