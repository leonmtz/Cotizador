<?php
session_start();
include '../config.php';
require __DIR__ . '/fpdf/fpdf.php'; // Utiliza una ruta absoluta basada en el directorio del script actual

// Recoger los datos del formulario
$cliente = $_POST['cliente'] ?? '';
$tipo_pasto = $_POST['tipo_pasto'] ?? '';
$metros = $_POST['metros'] ?? '';
$total_precio = $_POST['total_precio'] ?? '';
$id_usuario = $_POST['id_usuario'] ?? '';

// Verificar que todos los campos necesarios están presentes
if (empty($cliente) || empty($tipo_pasto) || empty($metros) || empty($total_precio) || empty($id_usuario)) {
    die(json_encode(['success' => false, 'message' => 'Faltan datos en el formulario.']));
}

// Convertir total_precio a un número flotante
$total_precio = filter_var($total_precio, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

// Guardar el registro en la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]));
}

// Corregir la consulta SQL
$sql = "INSERT INTO cotizaciones (cliente, tipo_pasto, metros, total_precio, id_usuario, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die(json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conn->error]));
}

// Bind de los parámetros
$stmt->bind_param("ssiss", $cliente, $tipo_pasto, $metros, $total_precio, $id_usuario);

if ($stmt->execute()) {

    // Generar el PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Cotización', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Cliente: ' . $cliente, 0, 1);
    $pdf->Cell(0, 10, 'Tipo de Pasto: ' . $tipo_pasto, 0, 1);
    $pdf->Cell(0, 10, 'Cantidad de Metros: ' . $metros, 0, 1);
    $pdf->Cell(0, 10, 'Total: ' . $total_precio, 0, 1);

    // Obtener la fecha actual en formato YYYYMMDD
    $date = date('Ymd');

    // Corregir la ruta del archivo PDF para incluir la fecha y asegurar que la carpeta exista
    $pdfDir = __DIR__ . '/../PDF/'; // Ruta al directorio PDF desde el controlador
    if (!file_exists($pdfDir)) {
        mkdir($pdfDir, 0777, true); // Crear la carpeta si no existe
    }

    $pdfPath = $pdfDir . 'cotizacion_' . $cliente . '_' . $date . '.pdf';
    $pdf->Output('F', $pdfPath);

    // Enviar la URL del PDF como respuesta
    $pdfRelativePath = 'app/Controller/PDF/' . 'cotizacion_' . $cliente . '_' . $date . '.pdf'; // Ruta relativa para la vista
    echo json_encode([
        'success' => true,
        'message' => 'Cotización generada exitosamente.',
        'pdf_url' => $pdfRelativePath
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar la cotización: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
