<?php
session_start();
header("Content-Type: application/json");

include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["usuario"]) && isset($data["password"])) {
    $usuario = $data["usuario"];
    $password = $data["password"];

    // Consultar el usuario en la base de datos
    $sql = "SELECT id, password, rol FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Usuario autenticado, establecer sesión
            $_SESSION["usuario"] = $usuario;
            $_SESSION["rol"] = $row["rol"];
            $_SESSION["id"] = $row["id"];
            echo json_encode(["message" => "Autenticación satisfactoria"]);
        } else {
            echo json_encode(["error" => "Contraseña incorrecta"]);
        }
    } else {
        echo json_encode(["error" => "Usuario no encontrado"]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}

$conn->close();
?>
