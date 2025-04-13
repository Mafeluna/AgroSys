<?php
  include "../../models/conexion.php";
  require '../../libs/fpdf186/fpdf.php';

  $consulta = "	SELECT id_transaccion,tipo,monto,descripcion,fecha,nombre FROM Usuario INNER JOIN Finanzas ON id_usuario=registrado_por WHERE Finanzas.estado=1;";
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
  $pdf->Cell(10, 10, 'ID', 1, 0, 'C');
  $pdf->Cell(25, 10, 'Tipo', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Monto', 1, 0, 'C');
  $pdf->Cell(65, 10, 'Descripcion', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Fecha', 1, 0, 'C');
  $pdf->Cell(30, 10, 'Registrado por', 1, 1, 'C');

  // Cuerpo de la tabla
  $pdf->SetFont('Arial', '', 10);
  while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(10, 10, $fila['id_transaccion'], 1, 0, 'C');
    $pdf->Cell(25, 10, ucfirst($fila['tipo']), 1, 0, 'C');
    $pdf->Cell(30, 10, '$' . number_format($fila['monto'], 2), 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode($fila['descripcion']), 1, 0, 'C');
    $pdf->Cell(30, 10, $fila['fecha'], 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($fila['nombre']), 1, 1, 'C');
  }


  // Consulta para obtener totales de ingresos y egresos
  $consultaGrafica = "SELECT 
                          SUM(CASE WHEN tipo = 'ingreso' THEN monto ELSE 0 END) AS total_ingresos,
                          SUM(CASE WHEN tipo = 'egreso' THEN monto ELSE 0 END) AS total_egresos
                      FROM Finanzas
                      WHERE estado = 'Activo'";
  $resultadoGrafica = $conexion->prepare($consultaGrafica);
  $resultadoGrafica->execute();
  $datosGrafica = $resultadoGrafica->fetch(PDO::FETCH_ASSOC);

  // Preparar etiquetas y datos
  $labels = ["Ingresos", "Egresos"];
  $data = [ (float)$datosGrafica['total_ingresos'], (float)$datosGrafica['total_egresos'] ];
  // Crear URL para la gráfica con QuickChart
  $labels_json = json_encode($labels);
  $data_json   = json_encode($data);

  $chartUrl = "https://quickchart.io/chart?c=" . urlencode('{
      type: "bar",
      data: {
        labels: ' . $labels_json . ',
        datasets: [{
          label: "Finanzas (Ingresos vs Egresos)",
          data: ' . $data_json . ',
          backgroundColor: ["#4CAF50", "#F44336"]
        }]
      },
      options: {
        plugins: {
          legend: { display: true }
        }
      }
  }');

  // Ruta temporal para guardar la imagen de la gráfica
  $tempImgPath = "../../temp/finanzas_chart.png";
  $imageContent = file_get_contents($chartUrl);
  file_put_contents($tempImgPath, $imageContent);

  // Insertar la imagen de la gráfica en el PDF
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(0, 10, 'Grafica de Barras: Ingresos vs Egresos', 0, 1, 'C');
  $pdf->Ln(5);
  $pdf->Image($tempImgPath, 20, $pdf->GetY(), 170, 80, 'PNG');

  $pdf->Output();
?>