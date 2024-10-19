<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    // Estructura HTML mínima para que funcione el JavaScript
    echo '<html><head>';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '</head><body>';

    // Validar el formato del DNI antes de continuar
    if (!validarDNI($dni)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El formato del DNI no es válido. Formato: 12345678-X.',
                    confirmButtonText: 'Intentar de nuevo'
                }).then(function() {
                        window.location = '../orriak/register.php'; 
                });
              </script>";
        exit();
    }

    // Validar el nombre (solo letras)
    if (!validarNombre($nombre)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El nombre solo debe contener letras.',
                    confirmButtonText: 'Intentar de nuevo'
                }).then(function() {
                        window.location = '../orriak/register.php'; 
                });
              </script>";
        exit();
    }

    // Validar el teléfono (9 dígitos)
    if (!validarTelefono($telefono)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El número de teléfono debe tener 9 dígitos.',
                    confirmButtonText: 'Intentar de nuevo'
                }).then(function() {
                        window.location = '../orriak/register.php'; 
                });
              </script>";
        exit();
    }

    // Validar el formato del email
    if (!validarEmail($email)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El formato del correo electrónico no es válido.',
                    confirmButtonText: 'Intentar de nuevo'
                }).then(function() {
                        window.location = '../orriak/register.php'; 
                });
              </script>";
        exit();
    }

    // Intentar insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (DNI, izen_abizenak, telefonoa, jaiotze_data, email, pasahitza) 
            VALUES ('$dni', '$nombre', '$telefono', '$fecha_nacimiento', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    text: '¡Te has registrado correctamente!',
                    confirmButtonText: 'Iniciar sesión'
                }).then(function() {
                        window.location = '../orriak/login.php'; 
                });
              </script>";
    } else {
        // Verificar si el error es por duplicación del DNI (error 1062)
        if (mysqli_errno($conn) == 1062) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de registro',
                        text: 'El DNI \"$dni\" ya está registrado.',
                        confirmButtonText: 'Intentar de nuevo'
                    }).then(function() {
                        window.location = '../orriak/register.php'; 
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de la base de datos',
                        text: '" . mysqli_error($conn) . "',
                        confirmButtonText: 'Intentar de nuevo'
                    }).then(function() {
                        window.location = '../orriak/register.php'; 
                    });
                  </script>";
        }
    }

    echo '</body></html>';
}

mysqli_close($conn);
?>
