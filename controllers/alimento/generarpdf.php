<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = 'SELECT Alimento.id_alimento,Alimento.descripcion,Especie.nombre as "especie",Alimento.cantidad,Alimento.tipo_medida FROM Alimento INNER JOIN Especie ON Alimento.especie = Especie.id_especie WHERE Alimento.estado=1;';
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  // Ejecutar consulta para la gráfica
$graficaSQL = "SELECT descripcion, SUM(cantidad) AS total_cantidad, tipo_medida FROM Alimento GROUP BY descripcion, tipo_medida";
$graficaStmt = $conexion->prepare($graficaSQL);
$graficaStmt->execute();
$dataGrafica = $graficaStmt->fetchAll(PDO::FETCH_ASSOC);

// Preparar datos para la gráfica
$labels = [];
$valores = [];
foreach ($dataGrafica as $fila) {
    $etiqueta = $fila['descripcion'] . " (" . $fila['tipo_medida'] . ")";;
    $labels[] = $etiqueta;
    $valores[] = (float)$fila['total_cantidad'];
}

$labels_json = json_encode($labels);
$valores_json = json_encode($valores);

// Crear URL para QuickChart (gráfico de barras)
$chartUrl = "https://quickchart.io/chart?c=" . urlencode('{
  type: "bar",
  data: {
    labels: ' . $labels_json . ',
    datasets: [{
      label: "Cantidad Total por Alimento",
      data: ' . $valores_json . ',
      backgroundColor: "rgba(54, 162, 235, 0.6)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1
    }]
  },
  options: {
    indexAxis: "y",
    scales: {
      x: {
        beginAtZero: true
      }
    }
  }
}');

// Descargar imagen temporalmente
$tempImgPath = "../../temp/grafico_alimentos.png";
$imageContent = file_get_contents($chartUrl);
file_put_contents($tempImgPath, $imageContent);


  // Crear el PDF
  $pdf = new FPDF();
  $pdf->AddPage();

  $pdf->Image('../../images/logo.jpg', 10, 10, 30);
  $pdf->Ln(15);

  // Título
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, 'Listado de Alimentos', 0, 1, 'C');
  $pdf->Ln(5);

  // Cabecera de la tabla
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(25, 10, 'ID', 1);
  $pdf->Cell(50, 10, 'Descripcion', 1);
  $pdf->Cell(40, 10, 'Especie', 1);
  $pdf->Cell(30, 10, 'Cantidad', 1);
  $pdf->Cell(40, 10, 'Tipo Medida', 1);
  $pdf->Ln();

  // Cuerpo de la tabla
  $pdf->SetFont('Arial', '', 12);
  while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
      $pdf->Cell(25, 10, $fila['id_alimento'], 1);
      $pdf->Cell(50, 10, utf8_decode($fila['descripcion']), 1);
      $pdf->Cell(40, 10, utf8_decode($fila['especie']), 1);
      $pdf->Cell(30, 10, $fila['cantidad'], 1);
      $pdf->Cell(40, 10, $fila['tipo_medida'], 1);
      $pdf->Ln();
  }

  $pdf->AddPage(); // Nueva página para la gráfica
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, utf8_decode('Gráfica de Cantidad Total por Alimento'), 0, 1, 'C');
  $pdf->Ln(5);
  $pdf->Image($tempImgPath, 10, $pdf->GetY(), 190); // Ancho casi completo
  $pdf->Ln(10);

  // Salida del PDF
  $pdf->Output();

?>