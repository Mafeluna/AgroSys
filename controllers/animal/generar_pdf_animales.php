<?php
include "../../models/conexion.php";
require '../../libs/fpdf186/fpdf.php';

if (!isset($_GET['especie'])) {
    die("No se ha definido la especie.");
}
$especie = filter_input(INPUT_GET, 'especie', FILTER_SANITIZE_STRING);

$consulta = 'SELECT Animal.id_animal,Animal.nombre,Especie.nombre as "especie",Animal.peso,Animal.fecha_ingreso, Usuario.nombre as "nombre_user",Usuario.apellido as "apellido_user"  FROM Usuario  INNER JOIN Animal ON Animal.registrado_por = Usuario.id_usuario INNER JOIN Especie ON Animal.especie = Especie.id_especie WHERE Animal.estado=1 AND Especie.nombre = ?;';
$stmt = $conexion->prepare($consulta);
$stmt->bindParam(1, $especie, PDO::PARAM_STR);
$stmt->execute();
//grafica-------------------------------------------------------------
$animales = $stmt->fetchAll(PDO::FETCH_ASSOC);
$pdf = new FPDF();
$pdf->AddPage();

$queryChart = "SELECT 
    MONTH(A.fecha_ingreso) AS mes,
    COUNT(*) AS cantidad
FROM Animal A
JOIN Especie E ON A.especie = E.id_especie
WHERE A.estado = 'Activo' AND E.nombre = :especie
GROUP BY MONTH(A.fecha_ingreso)
ORDER BY mes;";
$stmtChart = $conexion->prepare($queryChart);
$stmtChart->bindParam(':especie', $especie, PDO::PARAM_STR);
$stmtChart->execute();
$dataChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

// Preparar arreglos para etiquetas y datos
$labels = [];
$data = [];
foreach ($dataChart as $row) {
    // Guardamos el número del mes y la cantidad
    $labels[] = $row['mes'];
    $data[]   = $row['cantidad'];
}

// Convertir el número de mes a nombre corto (ej. "Ene", "Feb", etc.)
$labelsFormatted = array_map(function($mes) {
    $dateObj = DateTime::createFromFormat('!m', $mes);
    return $dateObj->format('M');
}, $labels);

// Generar la URL para la gráfica usando QuickChart (gráfica de líneas)
$labels_json = json_encode($labelsFormatted);
$data_json   = json_encode($data);

$chartUrl = "https://quickchart.io/chart?c=" . urlencode('{
  type: "line",
  data: {
    labels: ' . $labels_json . ',
    datasets: [{
      label: "Cantidad de Ingresos por Mes",
      data: ' . $data_json . ',
      fill: false,
      borderColor: "blue",
      tension: 0.1
    }]
  },
  options: {
    plugins: {
      legend: { display: true }
    }
  }
}');

// Definir la ruta temporal para guardar la imagen
$tempImgPath = "../../temp/animales_line_chart.png";
$imageContent = file_get_contents($chartUrl);
file_put_contents($tempImgPath, $imageContent);
//--------------------------------------------------------------
// Logo
$pdf->Image('../../images/logo.jpg', 10, 10, 30);
$pdf->Ln(15);

// Título
$pdf->SetFont('Arial', 'B', 14);
$titulo = "Animales de la especie: " . ucfirst($especie);
$pdf->Cell(0, 10, utf8_decode($titulo), 0, 1, 'C');
$pdf->Ln(5);

// Definir cabecera de la tabla (ajusta según tus campos)
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(20, 10, 'Codigo', 1);
$pdf->Cell(30, 10, 'Especie', 1);
$pdf->Cell(30, 10, 'Peso (Kg)', 1);
$pdf->Cell(40, 10, 'Fecha Ingreso', 1);
$pdf->Cell(50, 10, 'Registrado por', 1);
$pdf->Ln();

// Mostrar los datos de la tabla
$pdf->SetFont('Arial', '', 12);
foreach ($animales as $fila) {
    $pdf->Cell(20, 10, $fila['id_animal'], 1);
    $pdf->Cell(20, 10, utf8_decode($fila['nombre']), 1);
    $pdf->Cell(30, 10, utf8_decode($fila['especie']), 1);
    $pdf->Cell(30, 10, $fila['peso'], 1);
    $pdf->Cell(40, 10, $fila['fecha_ingreso'], 1);
    $pdf->Cell(50, 10, utf8_decode($fila['nombre_user']." ".$fila['apellido_user']), 1);
    $pdf->Ln();
}

// Insertar la gráfica
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Grafica de Ingreso por Mes', 0, 1, 'C');
$pdf->Ln(5);
$pdf->Image($tempImgPath, 30, $pdf->GetY(), 150, 80);

// Definir ruta y nombre de archivo para guardar el PDF
$nombreArchivo = "Animales_" . strtolower($especie) . "_" . date('Ymd_His') . ".pdf";
// Por ejemplo, guarda en "reportes/animales/"
$rutaArchivo = "./reportes/" . $nombreArchivo;

// Guarda el PDF en disco (modo 'F' para archivo)
$pdf->Output('F', $rutaArchivo);

$urlPdf = "./reportes/" . $nombreArchivo;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Redirigiendo...</title>
  <script>
    // Abrir en una nueva pestaña
    window.open("<?php echo $urlPdf; ?>", "_blank");
    // Redirigir la pestaña actual
    window.location.href = "../../views/animales.php";


  </script>
</head>
<body>
</body>
</html>