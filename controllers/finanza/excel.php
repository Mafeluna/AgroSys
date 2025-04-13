<?php
  echo "\xEF\xBB\xBF";
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=finanzas.xls");
  header("Pragma: no-cache");
  header("Expires: 0");

  include '../../models/m_finanzas.php';


  $instancia = new finanza();
  $respuesta = $instancia->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>Id transaccion</th>
      <th>Tipo</th>
      <th>monto</th>
      <th>descripcion</th>
      <th>fecha</th>
      <th>Registrada por</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respuesta as $f) { ?>
    <tr>
      <td><?php echo $f['id_transaccion'];?></td>
      <td><?php echo $f['tipo']; ?></td>
      <td><?php echo $f['monto']; ?></td>
      <td><?php echo $f['descripcion']; ?></td>
      <td><?php echo $f['fecha']; ?></td>
      <td><?php echo $f['nombre'] . " " . $f['apellido']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>