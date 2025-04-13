<?php

echo "\xEF\xBB\xBF";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=usuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../../models/m_usuario.php"; 

$instancia = new Usuario();
$usuarios = $instancia->consultaGeneral();
?>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Documento</th>
      <th>Email</th>
      <th>Rol</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Fecha de Registro</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($usuarios as $u): ?>
      <tr>
        <td><?php echo $u['id_usuario']; ?></td>
        <td><?php echo $u['nombre'] . ' ' . $u['apellido']; ?></td>
        <td><?php echo $u['documento']; ?></td>
        <td><?php echo $u['email']; ?></td>
        <td><?php echo $u['rol']; ?></td>
        <td><?php echo $u['telefono']; ?></td>
        <td><?php echo $u['direccion']; ?></td>
        <td><?php echo $u['fecha_registro']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>