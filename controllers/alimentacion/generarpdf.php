<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "CALL ConsultaGeneralAlimentacion()";
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
  $pdf->Cell(40, 10, 'Especie', 1, 0, 'C');
  $pdf->Cell(50, 10, 'Alimento', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
  $pdf->Cell(40, 10, 'Fecha', 1, 1, 'C');

  // Cuerpo de la tabla
  $pdf->SetFont('Arial', '', 10);
  while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(20, 10, $fila['id_alimentacion'], 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode($fila['especie']), 1, 0, 'C');
    $pdf->Cell(50, 10, utf8_decode($fila['alimento']), 1, 0, 'C');
    $pdf->Cell(30, 10, $fila['cantidad'], 1, 0, 'C');
    $pdf->Cell(40, 10, $fila['fecha'], 1, 1, 'C');
  }

  $pdf->Output();
?>