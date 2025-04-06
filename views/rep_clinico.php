<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=historial_clinico.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../models/m_historial.php";
$instancia2 = new historial();
$respuesta2 = $instancia2->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Fecha</th>
      <th>Animal</th>
      <th>Descripción</th>
      <th>Tratamiento</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($respuesta2 as $valor): ?>
    <tr>
      <td><?php echo $valor['id_historial']; ?></td>
      <td><?php echo $valor['fecha']; ?></td>
      <td><?php echo $valor['animal']; ?></td>
      <td><?php echo $valor['descripcion']; ?></td>
      <td><?php echo $valor['tratamiento']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
