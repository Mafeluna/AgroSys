<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "SELECT*FROM Especie WHERE estado=1;";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  // Consulta para la gráfica
$consultaGrafica = "SELECT nombre AS especie, cantidad FROM Especie WHERE estado = 'Activo'";
$resultadoGrafica = $conexion->prepare($consultaGrafica);
$resultadoGrafica->execute();

$labels = [];
$data = [];

while ($fila = $resultadoGrafica->fetch(PDO::FETCH_ASSOC)) {
    $labels[] = $fila['especie'];
    $data[] = $fila['cantidad'];
}

  // Generar la gráfica con QuickChart
  $labels_json = json_encode($labels);
  $data_json = json_encode($data);

  $chartUrl = "https://quickchart.io/chart?c=" . urlencode('{
    type: "bar",
    data: {
      labels: ' . $labels_json . ',
      datasets: [{
        label: "Cantidad por Especie",
        data: ' . $data_json . ',
        backgroundColor: ["#4e79a7", "#f28e2b", "#e15759", "#76b7b2", "#59a14f"]
      }]
    },
    options: {
      plugins: {
        legend: { display: true }
      }
    }
  }');

  $tempImgPath = "../../temp/especies_cantidad.png";
  $imageContent = file_get_contents($chartUrl);
  file_put_contents($tempImgPath, $imageContent);

  // Crear el PDF
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, 'Listado de Especies', 0, 1, 'C');
  $pdf->Ln(5);

  $pdf->Image('../../images/logo.jpg', 10, 10, 30);
  $pdf->Ln(15);

  // Cabecera de la tabla
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(30, 10, 'ID', 1);
  $pdf->Cell(60, 10, 'Nombre', 1);
  $pdf->Cell(40, 10, 'Cantidad', 1);
  $pdf->Cell(40, 10, 'Estado', 1);
  $pdf->Ln();

  // Datos de la tabla
  $pdf->SetFont('Arial', '', 12);
  while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
      $pdf->Cell(30, 10, $fila['id_especie'], 1);
      $pdf->Cell(60, 10, utf8_decode($fila['nombre']), 1);
      $pdf->Cell(40, 10, $fila['cantidad'], 1);
      $pdf->Cell(40, 10, $fila['estado'], 1);
      $pdf->Ln();
  }

    // Gráfico
  $pdf->Ln(10);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, 'Grafica de Cantidad por Especie', 0, 1, 'C');
  $pdf->Ln(5);
  $pdf->Image($tempImgPath, 30, $pdf->GetY(), 150, 80);

  // Mostrar el PDF en el navegador
  $pdf->Output();
?>