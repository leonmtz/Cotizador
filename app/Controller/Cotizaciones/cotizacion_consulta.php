<?php

session_start();
include '../config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener las cotizaciones
$sql = "SELECT c.id, c.cliente, c.tipo_pasto, c.metros, c.total_precio, u.nombre AS usuario_nombre, c.fecha_registro
        FROM cotizaciones c
        LEFT JOIN users u ON c.id_usuario = u.id
";

$result = $conn->query($sql);




// Verificar si hay resultados
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $fechaCompleta = $row["fecha_registro"];

        // Convierte la cadena a un timestamp
        $timestamp = strtotime($fechaCompleta);

        // Formatea el timestamp para mostrar solo la fecha
        $fechaSolo = date("Ymd", $timestamp);
        $pdfPath = '/Cotizador/app/Controller/PDF/' . 'cotizacion_' . $row["cliente"] . '_' . $fechaSolo . '.pdf'; // Ruta relativa del PDF
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["cliente"] . "</td>
                <td>" . $row["tipo_pasto"] . "</td>
                <td>" . $row["metros"] . " "."Metros"."</td>
                <td>" . $row["total_precio"] . "</td>
                <td>" . ($row["usuario_nombre"] ? $row["usuario_nombre"] : 'N/A') . "</td>
                <td>" . $row["fecha_registro"] . "</td>
                <td><a href='" . $pdfPath . "' target='_blank'>Ver PDF</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No se encontraron cotizaciones.</td></tr>";
}

// Cerrar la conexión
$conn->close();
