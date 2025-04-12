<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "
  SELECT Produccion.id_produccion,Produccion.tipo_produccion,Produccion.cantidad,Produccion.tipo_medida,Produccion.fecha,Especie.nombre 
    FROM Especie INNER JOIN Produccion ON Especie.id_especie=Produccion.especie WHERE Produccion.estado='Activo' ORDER BY Produccion.id_produccion;
  ";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  

  // Crear el PDF
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, 'Listado de Produccion', 0, 1, 'C');
  $pdf->Ln(5);

  $pdf->Image('../../images/logo.jpg', 10, 10, 30);
  $pdf->Ln(15);

  // Encabezados de la tabla
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
  $pdf->Cell(50, 10, 'Tipo', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
  $pdf->Cell(40, 10, 'Fecha', 1, 0, 'C');
  $pdf->Cell(50, 10, 'Especie', 1, 1, 'C');

  // Cuerpo de la tabla
  $pdf->SetFont('Arial', '', 10);
  while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(20, 10, $fila['id_produccion'], 1, 0, 'C');
    $pdf->Cell(50, 10, utf8_decode($fila['tipo_produccion']), 1, 0, 'C');
    $pdf->Cell(30, 10, $fila['cantidad'], 1, 0, 'C');
    $pdf->Cell(40, 10, $fila['fecha'], 1, 0, 'C');
    $pdf->Cell(50, 10, utf8_decode($fila['nombre']), 1, 1, 'C');
  }

  //grafica
  $consultaGrafica = "
  SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, SUM(cantidad) AS total_mes
  FROM Produccion
  WHERE estado = 'Activo'
  GROUP BY mes
  ORDER BY mes;
  ";
  $queryGrafica = $conexion->prepare($consultaGrafica);
  $queryGrafica->execute();
  $datos = $queryGrafica->fetchAll(PDO::FETCH_ASSOC);

  $labels = [];
  $data = [];

  foreach($datos as $valor){
    $labels[] = $valor['mes'];
    $data[] = $valor['total_mes'];
  }

  $labels_json = json_encode($labels);
  $data_json   = json_encode($data);

  $chartUrl = "https://quickchart.io/chart?c=" . urlencode('{
    type: "line",
    data: {
      labels: ' . $labels_json . ',
      datasets: [{
        label: "Cantidad de Ingresos por Mes",
        data: ' . $data_json . ',
        fill: false,
        borderColor: "blue",
        tension: 0.1
      }]
    },
    options: {
      plugins: {
        legend: { display: true }
      }
    }
  }');

  // Definir la ruta temporal para guardar la imagen
  $tempImgPath = "../../temp/produccion_line_chart.png";
  $imageContent = file_get_contents($chartUrl);
  file_put_contents($tempImgPath, $imageContent);

  // Insertar la gráfica
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(0, 10, 'Grafica Produccion Mensual', 0, 1, 'C');
  $pdf->Ln(5);
  $pdf->Image($tempImgPath, 30, $pdf->GetY(), 150, 80);

  $pdf->Output();
?>
