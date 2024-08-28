<?php

session_start();
include '../config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT id, nombre, apellidos, email, fecha_registro FROM users";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["apellidos"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["fecha_registro"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron usuarios.</td></tr>";
}

// Cerrar la conexión
$conn->close();
