<?php
  echo "\xEF\xBB\xBF";
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=produccion.xls");
  header("Pragma: no-cache");
  header("Expires: 0");

  include '../../models/m_produccion.php';
  

  $instancia = new produccion();
  $respuesta = $instancia->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Tipo de produccion</th>
      <th>Cantidad</th>
      <th>Unidad de medida</th>
      <th>fecha</th>
      <th>Especie</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respuesta as $f) { ?>
    <tr>
      <td><?php echo $f['id_produccion']; ?></td>
      <td><?php echo $f['tipo_produccion']; ?></td>
      <td><?php echo $f['cantidad']; ?></td>
      <td><?php echo $f['tipo_medida']; ?></td>
      <td><?php echo $f['fecha']; ?></td>
      <td><?php echo $f['nombre']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>