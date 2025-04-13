<?php

echo "\xEF\xBB\xBF";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=especies.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../../models/m_especie.php"; 

$instancia = new especie();
$especies = $instancia->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Cantidad</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($especies as $u): ?>
      <tr>
        <td><?php echo $u['id_especie']; ?></td>
        <td><?php echo $u['nombre'] ?></td>
        <td><?php echo $u['cantidad']; ?></td>
        <td><?php echo $u['estado']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>