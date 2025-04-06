<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "CALL ConsultaGeneralUsuario()";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  // Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();

// Logo (opcional)
$pdf->Image('../../images/logo.jpg', 10, 10, 30);
$pdf->Ln(15);

// Título
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Listado de Usuarios', 0, 1, 'C');
$pdf->Ln(5);

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(25, 10, 'Nombre', 1);
$pdf->Cell(25, 10, 'Apellido', 1);
$pdf->Cell(30, 10, 'Documento', 1);
$pdf->Cell(60, 10, 'Email', 1);
$pdf->Cell(40, 10, 'Rol', 1);
$pdf->Ln();

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
  $pdf->Cell(10, 10, $fila['id_usuario'], 1);
  $pdf->Cell(25, 10, utf8_decode($fila['nombre']), 1);
  $pdf->Cell(25, 10, utf8_decode($fila['apellido']), 1);
  $pdf->Cell(30, 10, $fila['documento'], 1);
  $pdf->Cell(60, 10, utf8_decode($fila['email']), 1);
  $pdf->Cell(40, 10, utf8_decode($fila['rol']), 1);
  $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>