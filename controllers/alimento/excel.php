<?php
  echo "\xEF\xBB\xBF";
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=reporte_alimentos.xls");

  include '../../models/m_alimento.php';

  $instancia = new alimento();
  $datos = $instancia->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Cantidad</th>
      <th>Unidad de Medida</th>
      <th>Especie</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datos as $f) { ?>
    <tr>
      <td><?php echo $f['id_alimento']; ?></td>
      <td><?php echo $f['descripcion']; ?></td>
      <td><?php echo $f['cantidad']; ?></td>
      <td><?php echo $f['tipo_medida']; ?></td>
      <td><?php echo $f['especie']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>