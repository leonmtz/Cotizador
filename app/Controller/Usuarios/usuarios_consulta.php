<?php

session_start();
include '../config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.fecha_registro, 
           a.email AS alta_usuario_email,
           r.rol AS rol_nombre
    FROM users u
    LEFT JOIN users a ON u.alta_usuario = a.id
    LEFT JOIN rol r ON u.id_rol = r.id
";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["apellidos"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . ($row["alta_usuario_email"] ? $row["alta_usuario_email"] : 'N/A') . "</td>
                <td>" . ($row["rol_nombre"] ? $row["rol_nombre"] : 'N/A') . "</td>
                <td>" . $row["fecha_registro"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron usuarios.</td></tr>";
}

// Cerrar la conexión
$conn->close();
