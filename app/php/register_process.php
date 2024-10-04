<?php
include 'db_connect.php'; // Incluir la conexión a la base de datos

// Función para validar el formato del DNI
function validarDNI($dni) {
    $patron = "/^\d{8}-[A-Z]$/";  // Patrón para 12345678-X
    return preg_match($patron, $dni);
}

// Función para validar que el nombre solo contiene letras
function validarNombre($nombre) {
    return preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre);  // Solo letras y espacios
}

// Función para validar el teléfono (9 dígitos)
function validarTelefono($telefono) {
    return preg_match("/^\d{9}$/", $telefono);  // Exactamente 9 dígitos
}

// Función para validar el email
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y escapar los datos del formulario
    $dni = mysqli_real_escape_string($conn, $_POST['DNI']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefonoa']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['jaiotze_data']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pasahitza']);

    // Validar el formato del DNI antes de continuar
    if (!validarDNI($dni)) {
        echo "Error: El formato del DNI no es válido. Formato: 12345678-X <a href='/orriak/register.php'>Intentar de nuevo</a>";
        exit();
    }

    // Validar el nombre (solo letras)
    if (!validarNombre($nombre)) {
        echo "Error: El nombre solo debe contener letras. <a href='/orriak/register.php'>Intentar de nuevo</a>";
        exit();
    }

    // Validar el teléfono (9 dígitos)
    if (!validarTelefono($telefono)) {
        echo "Error: El número de teléfono debe tener 9 dígitos. <a href='/orriak/register.php'>Intentar de nuevo</a>";
        exit();
    }

    // Validar el formato del email
    if (!validarEmail($email)) {
        echo "Error: El formato del correo electrónico no es válido. <a href='/orriak/register.php'>Intentar de nuevo</a>";
        exit();
    }

    // Intentar insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (DNI, izen_abizenak, telefonoa, jaiotze_data, email, pasahitza) 
            VALUES ('$dni', '$nombre', '$telefono', '$fecha_nacimiento', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro exitoso. <a href='/orriak/login.php'>Iniciar sesión</a>";
    } else {
        // Verificar si el error es por duplicación del DNI (error 1062)
        if (mysqli_errno($conn) == 1062) {
            echo "Error: El DNI '$dni' ya está registrado. <a href='/orriak/register.php'>Intentar de nuevo</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);

?>
