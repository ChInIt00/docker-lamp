<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Película - Bideoklub</title>
    <link rel="stylesheet" href="../../css/styles.css"> <!-- Enlace a tu archivo CSS -->
</head>
<body>
    <header>
        <div class="logo">
            <a href="user_menu.php">
                <img src="../../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
            </a>
        </div>
        <h1>Agregar Nueva Película</h1>
        <nav>
            <ul>
                <li><a href="/php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero"> 
    <main>
        <form id="item_add_form" action="../../php/add_item_process.php" method="POST">
            <label for="izenburua">Título:</label>
            <input type="text" id="izenburua" name="izenburua" required>

            <label for="zuzendaria">Director:</label>
            <input type="text" id="zuzendaria" name="zuzendaria" required>

            <label for="estrenaldi_urtea">Año:</label>
            <input type="text" id="estrenaldi_urtea" name="estrenaldi_urtea" required>

            <label for="generoa">Género:</label>
            <input type="text" id="generoa" name="generoa" required>

            <button type="submit" id="item_add_submit">Agregar Película</button>
        </form>
    </main>
    </div>

    <footer>
        <p>&copy; 2024 Bideoklub. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
