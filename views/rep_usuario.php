<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=historial_clinico.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../models/m_usuario";
$instancia2 = new historial();
$respuesta2 = $instancia2->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Documento</th>
      <th>email</th>
      <th>Rol</th>
      <th>Telefono</th>
      <th>direccion</th>
      <th>Fecha de registro</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($respuesta2 as $valor): ?>
    <tr>
      <td><?php echo $valor['nombre']." ".$valor['apellido'] ?></td>
      <td><?php echo $valor['documento']?></td>
      <td><?php echo $valor['email']?></td>
      <td> <?php echo $valor['rol']?></td>
      <td> <?php echo $valor['telefono']?></td>
      <td> <?php echo $valor['telefono']?></td>
      <td> <?php echo $valor['telefono']?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
