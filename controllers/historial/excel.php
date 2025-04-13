<?php
  echo "\xEF\xBB\xBF";
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=historial_clinico.xls");
  header("Pragma: no-cache");
  header("Expires: 0");

  include '../../models/m_historial.php';


  $instancia = new historial();
  $respuesta = $instancia->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>Id</th>
      <th>fecha</th>
      <th>Animal</th>
      <th>Especie</th>
      <th>Descripcion</th>
      <th>Tratamiento</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respuesta as $f) { ?>
    <tr>
      <td><?php echo $f['id_historial'];?></td>
      <td><?php echo $f['fecha']; ?></td>
      <td><?php echo $f['animal']; ?></td>
      <td><?php echo $f['especie']; ?></td>
      <td><?php echo $f['descripcion']; ?></td>
      <td><?php echo $f['tratamiento'] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>