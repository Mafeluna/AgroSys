<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>AgroSys | Alimentos</title>
        <link rel="shortcut icon" href="../../images/logo.jpg" type="image/x-icon" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script
        type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
        ></script>
        <script
        nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
    <body class="w-full h-screen flex items-center justify-center">
      <?php
        include_once "conexion.php";

        $id_alimento = $_POST['id_alimento'];
        $descripcion = $_POST['descripcion'];
        $cantidad = $_POST['cantidad'];

        $sql = "CALL ActualizarAlimento('$id_alimento','$descripcion','$cantidad');";

        if ($conn->query($sql)) {
            $script = "
              Swal.fire({
                  icon: 'success',
                  title: 'Modificacion Exitosa',
                  text: 'Los datos han sido actualizados exitosamente',
                  confirmButtonText: 'Aceptar'
              }).then(function() {
                  window.location.href = '../../views/alimentos.php?section=alimentos';
              });
              ";
        } else {
            echo "Error al actualizar registro: " . $conn->error;
        }

        $conn->close();
      ?>
    <script>
      <?php echo $script ?>
    </script>
  </body>
</html>