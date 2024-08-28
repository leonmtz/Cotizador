<?php
// Archivo: usuarios_roles.php

session_start();
include '../config.php';
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los roles
$sql = "SELECT id, rol FROM rol"; // Asegúrate de que la tabla 'roles' y sus columnas sean correctas
$result = $conn->query($sql);

$options = '<option value="" disabled selected>-- Seleccionar un rol --</option>';

if ($result->num_rows > 0) {
    // Generar options para cada rol
    while($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
    }
} else {
    $options .= '<option value="" disabled>No hay roles disponibles</option>';
}

$conn->close();
?>
