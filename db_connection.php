<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "servicios_web";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos: " . $conn->connect_error]));
}
?>
