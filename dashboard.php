<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// Obtener el rol del usuario
$rol = $_SESSION["rol"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="menu">
            <div class="logo-container">
                <img src="logo.png" alt="Logo" class="logo">
            </div>
            <div>
                <nav>
                    <!-- Solo mostrar los enlaces de acuerdo al rol -->
                    <?php if ($rol == "admin" || $rol == "usuario"): ?>
                    <div>
                        <a href="registro.php" class="link" id="registro-link" style="background-color: rgb(192, 192, 192);">
                            <img src="registro.png" alt="Registro" class="icon">
                            <span class="title">Registro de usuarios</span>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <a href="inventario.php" class="link" style="background-color: rgb(192, 192, 192);">
                        <img src="inventario.png" alt="Inventario" class="icon">
                        <span class="title">Inventario</span>
                    </a>
                    
                    <a href="facturacion.php" class="link" style="background-color: rgb(192, 192, 192);">
                        <img src="factura.png" alt="Facturación" class="icon">
                        <span class="title">Facturación</span>
                    </a>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="main-container">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario"]); ?> (<?php echo ucfirst($rol); ?>)</h1>
        <p>Aquí puedes acceder a las diferentes opciones del sistema:</p>
        
        <!-- Enlaces visibles según el rol -->
        <?php if ($rol == "admin"): ?>
            <div class="acciones">
                <a href="registro.php">Administrar usuarios</a>
                <a href="inventario.php">Ver inventario</a>
                <a href="facturacion.php">Ver facturación</a>
            </div>
        <?php elseif ($rol == "usuario"): ?>
            <div class="acciones">
                <a href="inventario.php">Ver inventario</a>
                <a href="facturacion.php">Ver facturación</a>
            </div>
        <?php else: ?>
            <p>No tienes acceso a ninguna sección del sistema.</p>
        <?php endif; ?>
    </div>

    <footer>
        <a href="logout.php">Cerrar sesión</a>
    </footer>
</body>
</html>
