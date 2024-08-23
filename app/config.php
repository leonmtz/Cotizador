<?php
$servername = "localhost"; // Cambia esto si tu servidor no es 'localhost'
$username = "u719790210_user_admin"; // Tu nombre de usuario
$password = "1wYcMbz=E"; // Tu contraseña
$dbname = "u719790210_cotizador"; // Tu nombre de base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>