<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u719790210_cotizador";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
//echo "Conexión exitosa";
?>