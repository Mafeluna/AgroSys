<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "SELECT*FROM Usuario WHERE estado=1;";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  //datos grafica----------------------------------------------
  $consultaGrafica = "SELECT rol, COUNT(*) AS total FROM Usuario GROUP BY rol;";
$resultadoGrafica = $conexion->prepare($consultaGrafica);
$resultadoGrafica->execute();

$labels = [];
$data = [];

$arregloGrafica = $resultadoGrafica->fetchAll(PDO::FETCH_ASSOC);
foreach ($arregloGrafica as $fila) {
  $labels[] = $fila['rol'];
  $data[] = $fila['total'];
}
//------------------------------------------------------------

//Crear URL para la gráfica con QuickChart
$labels_json = json_encode($labels);
$data_json = json_encode($data);

$chartUrl = "https://quickchart.io/chart?c=" . urlencode('{
  type: "bar",
  data: {
    labels: ' . $labels_json . ',
    datasets: [{
      label: "Usuarios por Rol",
      data: ' . $data_json . ',
      backgroundColor: ["#4e79a7", "#f28e2b", "#e15759", "#76b7b2"]
    }]
  },
  options: {
    plugins: {
      legend: { display: true }
    }
  }
}');

$tempImgPath = "../../temp/usuarios_por_rol.png";
$imageContent = file_get_contents($chartUrl);
file_put_contents($tempImgPath, $imageContent);


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
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Grafica Usuarios por Rol', 0, 1, 'C');
$pdf->Ln(5);
$pdf->Image($tempImgPath, 30, $pdf->GetY(), 150, 80);

// Salida del PDF
$pdf->Output();
?>