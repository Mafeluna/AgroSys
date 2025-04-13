<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = '
  SELECT historial_clinico.id_historial, historial_clinico.fecha, Animal.nombre as "animal",Especie.nombre as "especie" ,historial_clinico.descripcion,historial_clinico.tratamiento 
    FROM Especie 
    INNER JOIN Animal ON Especie.id_especie = Animal.especie 
    INNER JOIN Historial_clinico ON Historial_clinico.animal=Animal.id_animal 
    WHERE Historial_clinico.estado=1
    ORDER BY Historial_clinico.id_historial;
  ';
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);


    // Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();

// Logo (opcional)
$pdf->Image('../../images/logo.jpg', 10, 10, 30);
$pdf->Ln(15);

// Título
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Listado de Historial Medico: ', 0, 1, 'C');
$pdf->Ln(5);

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C');
$pdf->Cell(20, 10, 'Fecha', 1, 0, 'C');
$pdf->Cell(15, 10, 'Animal', 1, 0, 'C');
$pdf->Cell(15, 10, 'Especie', 1, 0, 'C');
$pdf->Cell(60, 10, 'Descripcion', 1, 0, 'C');
$pdf->Cell(75, 10, 'Tratamiento', 1, 0, 'C');
$pdf->Ln();

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
foreach($tabla as $fila){
  $pdf->Cell(10, 10, $fila['id_historial'], 1, 0, 'C');
  $pdf->Cell(20, 10, $fila['fecha'], 1, 0, 'C');
  $pdf->Cell(15, 10, $fila['animal'], 1, 0, 'C');
  $pdf->Cell(15, 10, $fila['especie'], 1, 0, 'C');
  $pdf->Cell(60, 10, utf8_decode($fila['descripcion']), 1, 0, 'C');
  $pdf->Cell(75, 10, utf8_decode($fila['tratamiento']), 1, 0, 'C');
  $pdf->Ln();
}

//grafica
$consultaGrafica = "
SELECT 
    e.nombre AS especie,
    COUNT(h.id_historial) AS cantidad_historiales
FROM 
    Historial_clinico h
JOIN 
    Animal a ON h.animal = a.id_animal
JOIN 
    Especie e ON a.especie = e.id_especie
GROUP BY 
    e.id_especie, e.nombre;
";
$resultadoGrafica = $conexion->prepare($consultaGrafica);
$resultadoGrafica->execute();
$grafica = $resultadoGrafica->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$data = [];

foreach($grafica as $value){
  $labels[] = $value['especie'];
  $data[] = $value['cantidad_historiales'];
}

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

$tempImgPath = "../../temp/historial_chart.png";
$imageContent = file_get_contents($chartUrl);
file_put_contents($tempImgPath, $imageContent);

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Grafica Cantidad historiales por Especie', 0, 1, 'C');
$pdf->Ln(5);
$pdf->Image($tempImgPath, 30, $pdf->GetY(), 150, 80);

$pdf->Output();

?>