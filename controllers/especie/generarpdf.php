<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "CALL ConsultaGeneralEspecie()";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  

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

  // Mostrar el PDF en el navegador
  $pdf->Output();
?>