<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Crear una conexión cURL para enviar los datos al servicio PHP
    $url = "http://localhost/auth_service.php"; // Asegúrate de que la URL sea correcta
    $data = json_encode(["usuario" => $usuario, "password" => $password]);

    // Configuración de cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    // Ejecutar la solicitud
    $response = curl_exec($ch);
    $response_data = json_decode($response, true);
    curl_close($ch);

    // Verificar si la respuesta es exitosa
    if (isset($response_data["message"])) {
        // Autenticación exitosa
        header("Location: dashboard.php");
        exit;
    } else {
        // Si hay un error, mostrarlo
        echo "Error: " . (isset($response_data["error"]) ? $response_data["error"] : "Error desconocido");
    }
}
?>

<!-- Formulario de inicio de sesión -->
<form method="POST" action="login.php">
    Usuario: <input type="text" name="usuario" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <button type="submit">Iniciar sesión</button>
</form>
