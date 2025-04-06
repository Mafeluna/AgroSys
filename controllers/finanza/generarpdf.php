<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "CALL ConsultaGeneralFinanzas()";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  

  // Crear el PDF
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, 'Listado de Finanzas', 0, 1, 'C');
  $pdf->Ln(5);

  //poniendo el metodo de agregar logo
  $pdf->Image('../../images/logo.jpg', 10, 10, 30);
  $pdf->Ln(15);

  // Encabezados de la tabla
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
  $pdf->Cell(25, 10, 'Tipo', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Monto', 1, 0, 'C');
  $pdf->Cell(65, 10, 'Descripción', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Fecha', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Registrado por', 1, 1, 'C');

  // Cuerpo de la tabla
  $pdf->SetFont('Arial', '', 10);
  while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(20, 10, $fila['id_transaccion'], 1, 0, 'C');
    $pdf->Cell(25, 10, ucfirst($fila['tipo']), 1, 0, 'C');
    $pdf->Cell(30, 10, '$' . number_format($fila['monto'], 2), 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode($fila['descripcion']), 1, 0, 'C');
    $pdf->Cell(30, 10, $fila['fecha'], 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($fila['nombre']), 1, 1, 'C');
  }

  $pdf->Output();
?>