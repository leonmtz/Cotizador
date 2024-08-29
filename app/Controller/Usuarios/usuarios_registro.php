<?php

session_start();
include '../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contra = $_POST['contra'];
    $contra_confirmar = $_POST['contra_confirmar'];
    $rol = $_POST['rol'];
    $usuario_alta = $_POST['usuario_alta'];

    // Verificar que las contraseñas coincidan
    if ($contra !== $contra_confirmar) {
        $response['message'] = 'Las contraseñas no coinciden.';
        echo json_encode($response);
        exit();
    }

    // Validar otros campos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($contra) || empty($contra_confirmar) || empty($rol) || empty($usuario_alta)) {
        $response['message'] = 'Todos los campos son obligatorios.';
        echo json_encode($response);
        exit();
    }

    // Encriptar la contraseña
    $hashedPassword = password_hash($contra, PASSWORD_BCRYPT);
    $hashedPasswordConfirm = password_hash($contra_confirmar, PASSWORD_BCRYPT);

    // Inserción en la base de datos
    $sql = "INSERT INTO users (nombre, apellidos, email, password, confirm_password, id_rol, alta_usuario, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?, now())";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $response['message'] = 'Error al preparar la consulta: ' . $conn->error;
        echo json_encode($response);
        exit();
    }

    $stmt->bind_param("sssssii", $nombre, $apellido, $email, $hashedPassword, $hashedPasswordConfirm, $rol, $usuario_alta);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Usuario registrado exitosamente.';
    } else {
        $response['message'] = 'Error al ejecutar la consulta: ' . $stmt->error;
        // Agregar registro de errores en la base de datos si es necesario
    }

    $stmt->close();
} else {
    $response['message'] = 'Método de solicitud no permitido.';
}

// Cerrar la conexión
$conn->close();

echo json_encode($response);



?>
