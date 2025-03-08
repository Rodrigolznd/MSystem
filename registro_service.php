<?php
header("Content-Type: application/json");

include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["usuario"]) && isset($data["password"])) {
    $usuario = $data["usuario"];
    $password = password_hash($data["password"], PASSWORD_BCRYPT); // Encriptar la contraseña

    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, 'usuario')"; // Asignar rol 'usuario'
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $password);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Usuario registrado con éxito"]);
    } else {
        echo json_encode(["error" => "Error al registrar el usuario: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}

$conn->close();
?>
