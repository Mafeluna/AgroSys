<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "CALL ConsultaGeneralAlimento()";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

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

  // Salida del PDF
  $pdf->Output();

?>