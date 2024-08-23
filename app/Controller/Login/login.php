<?php
// Iniciar sesión
session_start();

// Incluir archivo de configuración
include '../config.php';

header('Content-Type: application/json');

// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consultar la base de datos
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($password == $user['password']){
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Correo electrónico o contraseña incorrectos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
}

$stmt->close();
$conn->close();
?>
