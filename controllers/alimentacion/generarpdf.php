<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = '
  SELECT 
        Alimentacion.id_alimentacion,
        Especie.nombre AS "especie",
        Alimento.descripcion AS "alimento",
        Alimentacion.cantidad,
        Alimento.tipo_medida,
        Alimentacion.fecha
    FROM Alimentacion
    INNER JOIN Alimento ON Alimento.id_alimento = Alimentacion.alimento
    INNER JOIN Especie ON Especie.id_especie = Alimentacion.especie
    WHERE Alimentacion.estado = "Activo"
    ORDER BY Alimentacion.id_alimentacion ASC;
  ';
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(0, 10, utf8_decode('Reporte de Alimentación'), 0, 1, 'C');
  $pdf->Ln(5);

  $pdf->Image('../../images/logo.jpg', 10, 10, 30);
  $pdf->Ln(15);

  // Encabezados de la tabla
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Especie', 1, 0, 'C');
  $pdf->Cell(40, 10, 'Alimento', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Unidad Medida', 1, 0, 'C');
  $pdf->Cell(40, 10, 'Fecha', 1, 1, 'C');

  // Cuerpo de la tabla
  $pdf->SetFont('Arial', '', 10);
  while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(20, 10, $fila['id_alimentacion'], 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($fila['especie']), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode($fila['alimento']), 1, 0, 'C');
    $pdf->Cell(30, 10, $fila['cantidad'], 1, 0, 'C');
    $pdf->Cell(30, 10, $fila['tipo_medida'], 1, 0, 'C');
    $pdf->Cell(40, 10, $fila['fecha'], 1, 1, 'C');
  }

  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, utf8_decode('Gráfico: Consumo por Especie'), 0, 1, 'C');
  $pdf->Ln(5);

  // CONSULTA PARA GRAFICA
  $consultaGrafica = "
    SELECT 
      E.nombre AS especie,
      SUM(A.cantidad) AS total_consumido,
      AL.tipo_medida
    FROM  Alimentacion A
    JOIN Especie E ON A.especie = E.id_especie
    JOIN Alimento AL ON A.alimento = AL.id_alimento
    GROUP BY E.nombre, AL.tipo_medida;
  ";
  $resultadoGrafica = $conexion->prepare($consultaGrafica);
  $resultadoGrafica->execute();

  $labels = [];
  $data = [];

  while ($row = $resultadoGrafica->fetch(PDO::FETCH_ASSOC)) {
    $etiqueta = utf8_decode($row['especie']) . " (" . $row['tipo_medida'] . ")";
    $labels[] = $etiqueta;
    $data[] = (float)$row['total_consumido'];
  }

  // CREAR URL DE QUICKCHART
  $chartConfig = [
    "type" => "bar",
    "data" => [
      "labels" => $labels,
      "datasets" => [[
        "label" => "Total Consumido",
        "data" => $data,
        "backgroundColor" => "rgba(54, 162, 235, 0.6)",
        "borderColor" => "rgba(54, 162, 235, 1)",
        "borderWidth" => 1
      ]]
    ],
    "options" => [
      "indexAxis" => "y",
      "scales" => [
        "x" => [ "beginAtZero" => true ]
      ]
    ]
  ];

  $chartUrl = "https://quickchart.io/chart?c=" . urlencode(json_encode($chartConfig));

  // DESCARGAR IMAGEN TEMPORAL
  $imgPath = "../../temp/grafica.png";
  file_put_contents($imgPath, file_get_contents($chartUrl));

  // VERIFICAR Y AGREGAR AL PDF
  if (file_exists($imgPath)) {
    $pdf->Image($imgPath, 10, 40, 190); // ancho 190 para que entre bien
  } else {
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'No se pudo generar la gráfica.', 0, 1, 'C');
  }

  $pdf->Output();
?>