<?php
echo "\xEF\xBB\xBF";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=alimentaion.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../../models/m_alimentacion.php"; 

$instancia = new alimentacion();
$respuesta = $instancia->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>Id</th>
      <th>Alimento</th>
      <th>Especie</th>
      <th>Cantidad</th>
      <th>Unidad de Medida</th>
      <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach($respuesta as $a): ?>
      <tr>
        <td><?php echo $a['id_alimentacion']; ?></td>
        <td><?php echo $a['alimento']; ?></td>
        <td><?php echo $a['especie']; ?></td>
        <td><?php echo $a['cantidad']; ?></td>
        <td><?php echo $a['tipo_medida']; ?></td>
        <td><?php echo $a['fecha']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
