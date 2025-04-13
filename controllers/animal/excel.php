<?php
echo "\xEF\xBB\xBF";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_animales.xls");
header("Pragma: no-cache");
header("Expires: 0");


include "../../models/m_animal.php";

$animal = new animal();
$animales = $animal->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Codigo</th>
      <th>Especie</th>
      <th>Peso (Kg)</th>
      <th>Registrado por</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($animales as $a): ?>
      <tr>
        <td><?php echo $a['id_animal']; ?></td>
        <td><?php echo $a['nombre']; ?></td>
        <td><?php echo $a['especie']; ?></td>
        <td><?php echo $a['peso']; ?></td>
        <td><?php echo $a['nombre_user'] . " " . $a['apellido_user']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>