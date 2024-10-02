<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Bideoklub</title>
</head>
<body>
    <header>
        <h1>Registro de Usuario</h1>
    </header>

    <main>
        <form id="register_form" action="/php/register_process.php" method="POST">
            <label for="DNI">DNI:</label>
            <input type="text" id="DNI" name="DNI" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="telefonoa">Teléfono:</label>
            <input type="text" id="telefonoa" name="telefonoa" required>

            <label for="jaiotze_data">Fecha de Nacimiento:</label>
            <input type="date" id="jaiotze_data" name="jaiotze_data" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="pasahitza">Contraseña:</label>
            <input type="password" id="pasahitza" name="pasahitza" required>

            <button type="submit" id="register_submit">Registrar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Bideoklub. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
